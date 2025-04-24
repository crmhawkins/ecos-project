<?php

namespace App\Modules\Moodle\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Moodle\Services\MoodleUserService;
use App\Modules\Moodle\Services\MoodleCourseService;
use App\Modules\Moodle\Services\MoodleEnrollmentService;
use App\Modules\Moodle\Services\CertificateGeneratorService;
use Illuminate\Http\Request;
use Exception;

class StudentController extends Controller
{
    /**
     * The MoodleUserService instance
     *
     * @var \App\Modules\Moodle\Services\MoodleUserService
     */
    protected $userService;

    /**
     * The MoodleCourseService instance
     *
     * @var \App\Modules\Moodle\Services\MoodleCourseService
     */
    protected $courseService;

    /**
     * The MoodleEnrollmentService instance
     *
     * @var \App\Modules\Moodle\Services\MoodleEnrollmentService
     */
    protected $enrollmentService;

    /**
     * The CertificateGeneratorService instance
     *
     * @var \App\Modules\Moodle\Services\CertificateGeneratorService
     */
    protected $certificateService;

    /**
     * Create a new StudentController instance.
     *
     * @param \App\Modules\Moodle\Services\MoodleUserService $userService
     * @param \App\Modules\Moodle\Services\MoodleCourseService $courseService
     * @param \App\Modules\Moodle\Services\MoodleEnrollmentService $enrollmentService
     * @param \App\Modules\Moodle\Services\CertificateGeneratorService $certificateService
     * @return void
     */
    public function __construct(
        MoodleUserService $userService,
        MoodleCourseService $courseService,
        MoodleEnrollmentService $enrollmentService,
        CertificateGeneratorService $certificateService
    ) {
        $this->userService = $userService;
        $this->courseService = $courseService;
        $this->enrollmentService = $enrollmentService;
        $this->certificateService = $certificateService;
        
        // Apply auth middleware
        $this->middleware('auth');
    }

    /**
     * Display the student dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
        try {
            // Get authenticated user's Moodle ID
            $userId = $request->user()->moodle_user_id;
            
            if (!$userId) {
                return view('moodle::student.dashboard', [
                    'error' => 'Usuario no vinculado con Moodle'
                ]);
            }
            
            // Get user enrollments
            $enrollments = $this->enrollmentService->getUserEnrollments($userId);
            
            // Get user information
            $userInfo = $this->userService->getUser($userId);
            
            return view('moodle::student.dashboard', [
                'userInfo' => $userInfo,
                'enrollments' => $enrollments
            ]);
        } catch (Exception $e) {
            return view('moodle::student.dashboard', [
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the student's courses.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function courses(Request $request)
    {
        try {
            // Get authenticated user's Moodle ID
            $userId = $request->user()->moodle_user_id;
            
            if (!$userId) {
                return view('moodle::student.courses', [
                    'error' => 'Usuario no vinculado con Moodle'
                ]);
            }
            
            // Get user enrollments
            $enrollments = $this->enrollmentService->getUserEnrollments($userId);
            
            return view('moodle::student.courses', [
                'enrollments' => $enrollments
            ]);
        } catch (Exception $e) {
            return view('moodle::student.courses', [
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display a specific course for the student.
     *
     * @param Request $request
     * @param int $courseId
     * @return \Illuminate\Http\Response
     */
    public function course(Request $request, $courseId)
    {
        try {
            // Get authenticated user's Moodle ID
            $userId = $request->user()->moodle_user_id;
            
            if (!$userId) {
                return view('moodle::student.course', [
                    'error' => 'Usuario no vinculado con Moodle'
                ]);
            }
            
            // Check if user is enrolled in the course
            $isEnrolled = $this->enrollmentService->isUserEnrolled($userId, $courseId);
            
            if (!$isEnrolled) {
                return redirect()->route('moodle.student.courses')
                    ->with('error', 'No estás matriculado en este curso');
            }
            
            // Get course information
            $course = $this->courseService->getCourse($courseId);
            
            // Get course contents
            $contents = $this->courseService->getCourseContents($courseId);
            
            // Get user progress
            $progress = $this->courseService->getCourseCompletionStatus($courseId, $userId);
            
            // Get user grades
            $grades = $this->courseService->getUserGrades($courseId, $userId);
            
            return view('moodle::student.course', [
                'course' => $course,
                'contents' => $contents,
                'progress' => $progress,
                'grades' => $grades
            ]);
        } catch (Exception $e) {
            return view('moodle::student.course', [
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the student's progress.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function progress(Request $request)
    {
        try {
            // Get authenticated user's Moodle ID
            $userId = $request->user()->moodle_user_id;
            
            if (!$userId) {
                return view('moodle::student.progress', [
                    'error' => 'Usuario no vinculado con Moodle'
                ]);
            }
            
            // Get user enrollments
            $enrollments = $this->enrollmentService->getUserEnrollments($userId);
            
            // Get progress for each enrollment
            $coursesProgress = [];
            
            foreach ($enrollments as $enrollment) {
                try {
                    $progress = $this->courseService->getCourseCompletionStatus($enrollment['id'], $userId);
                    $grades = $this->courseService->getUserGrades($enrollment['id'], $userId);
                    
                    $coursesProgress[] = [
                        'course' => $enrollment,
                        'progress' => $progress,
                        'grades' => $grades
                    ];
                } catch (Exception $e) {
                    // Log error but continue with other enrollments
                    \Illuminate\Support\Facades\Log::error("Error getting progress for course: {$e->getMessage()}", [
                        'userId' => $userId,
                        'courseId' => $enrollment['id'],
                        'exception' => $e
                    ]);
                }
            }
            
            return view('moodle::student.progress', [
                'coursesProgress' => $coursesProgress
            ]);
        } catch (Exception $e) {
            return view('moodle::student.progress', [
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the student's certificates.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function certificates(Request $request)
    {
        try {
            // Get authenticated user's Moodle ID
            $userId = $request->user()->moodle_user_id;
            
            if (!$userId) {
                return view('moodle::student.certificates', [
                    'error' => 'Usuario no vinculado con Moodle'
                ]);
            }
            
            // Get user certificates
            $certificates = $this->certificateService->getUserCertificates($userId);
            
            return view('moodle::student.certificates', [
                'certificates' => $certificates
            ]);
        } catch (Exception $e) {
            return view('moodle::student.certificates', [
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Request a certificate for a completed course.
     *
     * @param Request $request
     * @param int $courseId
     * @return \Illuminate\Http\Response
     */
    public function requestCertificate(Request $request, $courseId)
    {
        try {
            // Get authenticated user's Moodle ID
            $userId = $request->user()->moodle_user_id;
            
            if (!$userId) {
                return redirect()->route('moodle.student.certificates')
                    ->with('error', 'Usuario no vinculado con Moodle');
            }
            
            // Check if user is enrolled in the course
            $isEnrolled = $this->enrollmentService->isUserEnrolled($userId, $courseId);
            
            if (!$isEnrolled) {
                return redirect()->route('moodle.student.certificates')
                    ->with('error', 'No estás matriculado en este curso');
            }
            
            // Check if user has completed the course
            $completionStatus = $this->courseService->getCourseCompletionStatus($courseId, $userId);
            
            if (!isset($completionStatus['completionstatus']['completed']) || !$completionStatus['completionstatus']['completed']) {
                return redirect()->route('moodle.student.certificates')
                    ->with('error', 'No has completado este curso');
            }
            
            // Generate certificate
            $certificatePath = $this->certificateService->generateCertificate($userId, $courseId);
            
            if (!$certificatePath) {
                return redirect()->route('moodle.student.certificates')
                    ->with('error', 'No se pudo generar el certificado');
            }
            
            // Create certificate record in database
            $certificateId = 'CERT-' . uniqid();
            $filename = basename($certificatePath);
            
            \App\Modules\Moodle\Models\MoodleCertificate::create([
                'user_id' => $userId,
                'course_id' => $courseId,
                'certificate_id' => $certificateId,
                'filename' => $filename,
                'issued_at' => now(),
                'verified' => true,
                'metadata' => []
            ]);
            
            return redirect()->route('moodle.student.certificates')
                ->with('success', 'Certificado generado correctamente');
        } catch (Exception $e) {
            return redirect()->route('moodle.student.certificates')
                ->with('error', 'Error al generar certificado: ' . $e->getMessage());
        }
    }
}
