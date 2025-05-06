<?php

namespace App\Modules\Moodle\Services;

use App\Modules\Moodle\Models\MoodleCertificate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View; // Added for rendering Blade templates
use Illuminate\Support\Facades\File; // Added for file operations
use Exception;

class CertificateGeneratorService
{
    protected $apiService;
    protected $courseService;
    protected $userService;
    protected $storagePath;
    protected $template;
    protected $signatureImage;

    public function __construct(
        MoodleApiService $apiService,
        MoodleCourseService $courseService,
        MoodleUserService $userService
    ) {
        $this->apiService = $apiService;
        $this->courseService = $courseService;
        $this->userService = $userService;
        $this->storagePath = config('moodle.certificates.path', storage_path('app/certificates'));
        $this->template = config('moodle.certificates.template', 'default');
        $this->signatureImage = config('moodle.certificates.signature_image', '');

        if (!File::exists($this->storagePath)) {
            File::makeDirectory($this->storagePath, 0755, true);
        }

        $this->ensureDefaultTemplateExists();
    }

    public function generateCertificate($userId, $courseId, array $options = [])
    {
        try {
            if (!$userId) throw new Exception("User ID is required");
            if (!$courseId) throw new Exception("Course ID is required");

            $user = $this->userService->getUser($userId);
            $course = $this->courseService->getCourse($courseId);

            if (!$user) throw new Exception("User not found with Moodle ID: {$userId}");
            if (!$course) throw new Exception("Course not found with Moodle ID: {$courseId}");

            $completionStatus = $this->courseService->getCourseCompletionStatus($courseId, $userId);
            if (!isset($completionStatus['completionstatus']['completed']) || !$completionStatus['completionstatus']['completed']) {
                if (!($options['force_generation'] ?? false)) {
                    throw new Exception("User has not completed the course");
                }
            }

            $completionTime = $completionStatus['completionstatus']['timecompleted'] ?? time();
            $completionDate = date('d/m/Y', isset($options['completion_date']) ? strtotime($options['completion_date']) : $completionTime);
            $certificateId = $options['certificate_id'] ?? 'CERT-' . uniqid();

            $certificatePath = $this->createPdfCertificateWithWeasyPrint($user, $course, $completionDate, $certificateId, $options);

            MoodleCertificate::create([
                'user_id' => $userId,
                'course_id' => $courseId,
                'file_path' => basename($certificatePath),
                'certificate_id' => $certificateId,
                'generated_at' => now()
            ]);

            return $certificatePath;
        } catch (Exception $e) {
            Log::error("Certificate Generation Error: {" . $e->getMessage() . "}", [
                'userId' => $userId,
                'courseId' => $courseId,
                'options' => $options,
                'exception' => $e
            ]);
            throw new Exception("Error generating certificate: {" . $e->getMessage() . "}");
        }
    }

    protected function createPdfCertificateWithWeasyPrint($user, $course, $completionDate, $certificateId, $options)
    {
        $data = [
            'user' => $user,
            'course' => $course,
            'completionDate' => $completionDate,
            'certificateId' => $certificateId,
            'signatureImagePath' => $this->signatureImage && File::exists($this->signatureImage) ? $this->signatureImage : null,
            'verificationUrl' => route('moodle.certificates.verify.get', $certificateId),
            'options' => $options
        ];

        $templateName = $options['template'] ?? $this->template;
        $templateView = 'moodle::certificates.templates.' . $templateName;
        if (!View::exists($templateView)) {
            Log::warning("Template not found: {$templateView}, falling back to default.");
            $templateView = 'moodle::certificates.templates.default';
            if (!View::exists($templateView)) {
                throw new Exception("Default certificate template view not found");
            }
        }

        try {
            $htmlContent = View::make($templateView, $data)->render();
        } catch (Exception $e) {
            throw new Exception("Error rendering template: {" . $e->getMessage() . "}");
        }

        $tmpHtmlPath = tempnam(sys_get_temp_dir(), 'cert_html_') . '.html';
        if (File::put($tmpHtmlPath, $htmlContent) === false) {
            throw new Exception("Could not write temporary HTML file: {$tmpHtmlPath}");
        }

        $filename = 'certificate_' . ($user['username'] ?? $user['id']) . '_' . ($course['shortname'] ?? $course['id']) . '_' . time() . '.pdf';
        $pdfFilePath = $this->storagePath . '/' . $filename;

        $cssPath = $options['css_path'] ?? null;
        $command = 'weasyprint ' . escapeshellarg($tmpHtmlPath) . ' ' . escapeshellarg($pdfFilePath);
        if ($cssPath && File::exists($cssPath)) {
            $command = 'weasyprint -s ' . escapeshellarg($cssPath) . ' ' . escapeshellarg($tmpHtmlPath) . ' ' . escapeshellarg($pdfFilePath);
        }

        exec($command, $output, $returnCode);

        if ($returnCode !== 0 || !File::exists($pdfFilePath)) {
            throw new Exception("WeasyPrint failed to generate PDF. Command: {$command}");
        }

        File::delete($tmpHtmlPath);

        return $pdfFilePath;
    }

    protected function ensureDefaultTemplateExists()
    {
        $viewPath = resource_path('views/vendor/moodle/certificates/templates/default.blade.php');

        if (!File::exists($viewPath)) {
            $stubPath = __DIR__ . '/../resources/stubs/default.blade.php';

            if (!File::exists($stubPath)) {
                Log::warning("Default certificate stub not found at: {$stubPath}");
                return;
            }

            File::ensureDirectoryExists(dirname($viewPath));
            File::copy($stubPath, $viewPath);

            Log::info("Default certificate template published to: {$viewPath}");
        }
    }
}
