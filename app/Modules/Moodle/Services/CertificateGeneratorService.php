<?php

namespace App\Modules\Moodle\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;
use TCPDF;

class CertificateGeneratorService
{
    /**
     * The MoodleApiService instance
     *
     * @var \App\Modules\Moodle\Services\MoodleApiService
     */
    protected $apiService;

    /**
     * The MoodleCourseService instance
     *
     * @var \App\Modules\Moodle\Services\MoodleCourseService
     */
    protected $courseService;

    /**
     * The MoodleUserService instance
     *
     * @var \App\Modules\Moodle\Services\MoodleUserService
     */
    protected $userService;

    /**
     * Certificate storage path
     *
     * @var string
     */
    protected $storagePath;

    /**
     * Certificate template
     *
     * @var string
     */
    protected $template;

    /**
     * Signature image path
     *
     * @var string
     */
    protected $signatureImage;

    /**
     * Create a new CertificateGeneratorService instance.
     *
     * @param \App\Modules\Moodle\Services\MoodleApiService $apiService
     * @param \App\Modules\Moodle\Services\MoodleCourseService $courseService
     * @param \App\Modules\Moodle\Services\MoodleUserService $userService
     * @return void
     */
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
        
        // Ensure storage directory exists
        if (!file_exists($this->storagePath)) {
            mkdir($this->storagePath, 0755, true);
        }
    }

    /**
     * Generate a certificate for a user who completed a course
     *
     * @param int $userId Moodle user ID
     * @param int $courseId Moodle course ID
     * @param array $options Additional options for certificate
     * @return string|null Path to the generated certificate
     */
    public function generateCertificate($userId, $courseId, array $options = [])
    {
        try {
            if (!$userId) {
                throw new Exception("User ID is required");
            }
            
            if (!$courseId) {
                throw new Exception("Course ID is required");
            }
            
            // Get user and course data
            $user = $this->userService->getUser($userId);
            $course = $this->courseService->getCourse($courseId);
            
            if (!$user) {
                throw new Exception("User not found");
            }
            
            if (!$course) {
                throw new Exception("Course not found");
            }
            
            // Check if user has completed the course
            $completionStatus = $this->courseService->getCourseCompletionStatus($courseId, $userId);
            
            if (!isset($completionStatus['completionstatus']['completed']) || !$completionStatus['completionstatus']['completed']) {
                throw new Exception("User has not completed the course");
            }
            
            // Generate certificate
            $certificatePath = $this->createPdfCertificate($user, $course, $completionStatus, $options);
            
            return $certificatePath;
        } catch (Exception $e) {
            Log::error("Certificate Generation Error: {$e->getMessage()}", [
                'userId' => $userId,
                'courseId' => $courseId,
                'options' => $options,
                'exception' => $e
            ]);
            
            throw new Exception("Error generating certificate: {$e->getMessage()}");
        }
    }

    /**
     * Create a PDF certificate
     *
     * @param array $user User data
     * @param array $course Course data
     * @param array $completionStatus Completion status data
     * @param array $options Additional options
     * @return string Path to the generated PDF
     */
    protected function createPdfCertificate($user, $course, $completionStatus, $options)
    {
        // Initialize TCPDF
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        
        // Set document information
        $pdf->SetCreator('Moodle Module');
        $pdf->SetAuthor('Laravel Moodle Module');
        $pdf->SetTitle('Course Completion Certificate');
        $pdf->SetSubject('Certificate for ' . $course['fullname']);
        
        // Remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        
        // Set margins
        $pdf->SetMargins(15, 15, 15);
        
        // Add a page
        $pdf->AddPage();
        
        // Set font
        $pdf->SetFont('helvetica', '', 12);
        
        // Certificate title
        $pdf->SetFont('helvetica', 'B', 24);
        $pdf->Cell(0, 20, 'CERTIFICADO DE FINALIZACIÓN', 0, 1, 'C');
        
        // Certificate content
        $pdf->SetFont('helvetica', '', 14);
        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'Este certificado acredita que:', 0, 1, 'C');
        
        // User name
        $pdf->SetFont('helvetica', 'B', 20);
        $pdf->Cell(0, 15, $user['firstname'] . ' ' . $user['lastname'], 0, 1, 'C');
        
        // Course information
        $pdf->SetFont('helvetica', '', 14);
        $pdf->Ln(5);
        $pdf->Cell(0, 10, 'Ha completado satisfactoriamente el curso:', 0, 1, 'C');
        
        $pdf->SetFont('helvetica', 'B', 18);
        $pdf->Cell(0, 15, $course['fullname'], 0, 1, 'C');
        
        // Completion date
        $pdf->SetFont('helvetica', '', 14);
        $pdf->Ln(5);
        
        $completionDate = isset($completionStatus['completionstatus']['timecompleted']) 
            ? date('d/m/Y', $completionStatus['completionstatus']['timecompleted']) 
            : date('d/m/Y');
            
        $pdf->Cell(0, 10, 'Fecha de finalización: ' . $completionDate, 0, 1, 'C');
        
        // Certificate ID
        $certificateId = uniqid('CERT-');
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'ID del Certificado: ' . $certificateId, 0, 1, 'C');
        
        // Add signature if available
        if (!empty($this->signatureImage) && file_exists($this->signatureImage)) {
            $pdf->Image($this->signatureImage, 120, 180, 60, 0, '', '', '', false, 300);
            $pdf->Ln(30);
            $pdf->Cell(0, 10, '____________________________', 0, 1, 'C');
            $pdf->Cell(0, 10, 'Firma Autorizada', 0, 1, 'C');
        } else {
            $pdf->Ln(40);
            $pdf->Cell(0, 10, '____________________________', 0, 1, 'C');
            $pdf->Cell(0, 10, 'Firma Autorizada', 0, 1, 'C');
        }
        
        // QR code with verification URL if TCPDF has the feature
        if (method_exists($pdf, 'write2DBarcode')) {
            $verificationUrl = url('/verify-certificate/' . $certificateId);
            $pdf->write2DBarcode($verificationUrl, 'QRCODE,M', 20, 160, 40, 40);
            $pdf->SetXY(20, 205);
            $pdf->Cell(40, 10, 'Verificar Certificado', 0, 1, 'C');
        }
        
        // Generate filename
        $filename = 'certificate_' . $user['id'] . '_' . $course['id'] . '_' . time() . '.pdf';
        $filepath = $this->storagePath . '/' . $filename;
        
        // Save PDF
        $pdf->Output($filepath, 'F');
        
        return $filepath;
    }

    /**
     * Verify a certificate by ID
     *
     * @param string $certificateId Certificate ID
     * @return bool|array
     */
    public function verifyCertificate($certificateId)
    {
        // In a real implementation, this would query a database of issued certificates
        // For now, we'll just return false as this is a placeholder
        return false;
    }

    /**
     * Get a list of certificates for a user
     *
     * @param int $userId Moodle user ID
     * @return array
     */
    public function getUserCertificates($userId)
    {
        try {
            if (!$userId) {
                throw new Exception("User ID is required");
            }
            
            // Get user enrollments
            $enrollments = app(MoodleEnrollmentService::class)->getUserEnrollments($userId);
            $certificates = [];
            
            foreach ($enrollments as $enrollment) {
                try {
                    // Check if user has completed the course
                    $completionStatus = $this->courseService->getCourseCompletionStatus($enrollment['id'], $userId);
                    
                    if (isset($completionStatus['completionstatus']['completed']) && $completionStatus['completionstatus']['completed']) {
                        // Get certificate file if it exists
                        $pattern = $this->storagePath . '/certificate_' . $userId . '_' . $enrollment['id'] . '_*.pdf';
                        $files = glob($pattern);
                        
                        $certificateFile = !empty($files) ? basename(end($files)) : null;
                        
                        $certificates[] = [
                            'course_id' => $enrollment['id'],
                            'course_name' => $enrollment['fullname'],
                            'completion_date' => isset($completionStatus['completionstatus']['timecompleted']) 
                                ? date('Y-m-d', $completionStatus['completionstatus']['timecompleted']) 
                                : null,
                            'certificate_file' => $certificateFile,
                        ];
                    }
                } catch (Exception $e) {
                    // Log error but continue with other enrollments
                    Log::error("Error checking completion for course: {$e->getMessage()}", [
                        'userId' => $userId,
                        'courseId' => $enrollment['id'],
                        'exception' => $e
                    ]);
                }
            }
            
            return $certificates;
        } catch (Exception $e) {
            Log::error("Error getting user certificates: {$e->getMessage()}", [
                'userId' => $userId,
                'exception' => $e
            ]);
            
            throw new Exception("Error getting user certificates: {$e->getMessage()}");
        }
    }

    /**
     * Download a certificate
     *
     * @param string $filename Certificate filename
     * @return string Full path to certificate file
     */
    public function downloadCertificate($filename)
    {
        $filepath = $this->storagePath . '/' . $filename;
        
        if (!file_exists($filepath)) {
            throw new Exception("Certificate file not found");
        }
        
        return $filepath;
    }
}
