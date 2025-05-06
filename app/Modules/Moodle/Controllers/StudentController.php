<?php

namespace App\Modules\Moodle\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Moodle\Services\MoodleUserService;
use App\Modules\Moodle\Services\MoodleCourseService;
use App\Modules\Moodle\Services\MoodleEnrollmentService;
use App\Modules\Moodle\Services\CertificateGeneratorService;
use App\Modules\Moodle\Models\MoodleCertificate; // Import the model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Use Auth facade
use Illuminate\Support\Facades\Log; // Use Log facade
use Exception;

class StudentController extends Controller
{
    protected $userService;
    protected $courseService;
    protected $enrollmentService;
    protected $certificateService;

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

        // Apply auth middleware (assuming it's handled in routes or globally)
        // $this->middleware('auth');
    }

    /**
     * Display the student dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function dashboard(Request $request)
    {
        try {
            $laravelUser = Auth::user();
            // Ensure the user model has 'moodle_user_id' attribute
            if (!isset($laravelUser->moodle_user_id)) {
                 return view('moodle::student.dashboard', ['error' => 'Campo moodle_user_id no encontrado en el modelo User de Laravel.']);
            }
            $moodleUserId = $laravelUser->moodle_user_id;

            if (!$moodleUserId) {
                return view('moodle::student.dashboard', ['error' => 'Usuario no vinculado con Moodle']);
            }

            $enrollments = $this->enrollmentService->getUserEnrollments($moodleUserId);
            $userInfo = $this->userService->getUser($moodleUserId);

            return view('moodle::student.dashboard', compact('userInfo', 'enrollments'));
        } catch (Exception $e) {
            Log::error("Student Dashboard Error: {" . $e->getMessage() . "}", ['user_id' => Auth::id()]);
            return view('moodle::student.dashboard', ['error' => 'Error al cargar el panel de estudiante: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the student's courses.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function courses(Request $request)
    {
        try {
            $laravelUser = Auth::user();
            if (!isset($laravelUser->moodle_user_id)) {
                 return view('moodle::student.courses', ['error' => 'Campo moodle_user_id no encontrado en el modelo User de Laravel.']);
            }
            $moodleUserId = $laravelUser->moodle_user_id;

            if (!$moodleUserId) {
                return view('moodle::student.courses', ['error' => 'Usuario no vinculado con Moodle']);
            }

            $enrollments = $this->enrollmentService->getUserEnrollments($moodleUserId);

            return view('moodle::student.courses', compact('enrollments'));
        } catch (Exception $e) {
            Log::error("Student Courses Error: {" . $e->getMessage() . "}", ['user_id' => Auth::id()]);
            return view('moodle::student.courses', ['error' => 'Error al cargar los cursos: ' . $e->getMessage()]);
        }
    }

    /**
     * Display a specific course for the student.
     *
     * @param Request $request
     * @param int $courseId Moodle Course ID
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function course(Request $request, $courseId)
    {
        try {
            $laravelUser = Auth::user();
            if (!isset($laravelUser->moodle_user_id)) {
                 return redirect()->route('moodle.student.dashboard')->with('error', 'Campo moodle_user_id no encontrado en el modelo User de Laravel.');
            }
            $moodleUserId = $laravelUser->moodle_user_id;

            if (!$moodleUserId) {
                 return redirect()->route('moodle.student.dashboard')->with('error', 'Usuario no vinculado con Moodle');
            }

            $isEnrolled = $this->enrollmentService->isUserEnrolled($moodleUserId, $courseId);

            if (!$isEnrolled) {
                return redirect()->route('moodle.student.courses')
                    ->with('error', 'No estás matriculado en este curso');
            }

            $course = $this->courseService->getCourse($courseId);
            $contents = $this->courseService->getCourseContents($courseId);
            $progress = $this->courseService->getCourseCompletionStatus($courseId, $moodleUserId);
            $grades = $this->courseService->getUserGrades($courseId, $moodleUserId);

            // Ensure the view 'moodle::student.course_detail' exists
            if (!view()->exists('moodle::student.course_detail')) {
                Log::warning("View not found: moodle::student.course_detail. Check module structure.");
                return redirect()->route('moodle.student.courses')->with('error', 'Vista de detalle del curso no encontrada.');
            }

            return view('moodle::student.course_detail', compact('course', 'contents', 'progress', 'grades'));
        } catch (Exception $e) {
            Log::error("Student Course Detail Error: {" . $e->getMessage() . "}", ['user_id' => Auth::id(), 'course_id' => $courseId]);
            return redirect()->route('moodle.student.courses')->with('error', 'Error al cargar el detalle del curso: ' . $e->getMessage());
        }
    }

    /**
     * Display the student's progress across courses.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function progress(Request $request)
    {
        try {
            $laravelUser = Auth::user();
            if (!isset($laravelUser->moodle_user_id)) {
                 return view('moodle::student.progress', ['error' => 'Campo moodle_user_id no encontrado en el modelo User de Laravel.']);
            }
            $moodleUserId = $laravelUser->moodle_user_id;

            if (!$moodleUserId) {
                return view('moodle::student.progress', ['error' => 'Usuario no vinculado con Moodle']);
            }

            $enrollments = $this->enrollmentService->getUserEnrollments($moodleUserId);
            $coursesProgress = [];

            foreach ($enrollments as $enrollment) {
                try {
                    $progress = $this->courseService->getCourseCompletionStatus($enrollment['id'], $moodleUserId);
                    $grades = $this->courseService->getUserGrades($enrollment['id'], $moodleUserId);

                    $coursesProgress[] = [
                        'course' => $enrollment,
                        'progress' => $progress,
                        'grades' => $grades
                    ];
                } catch (Exception $e) {
                    Log::error("Error getting progress for course: {" . $e->getMessage() . "}", [
                        'userId' => $moodleUserId,
                        'courseId' => $enrollment['id'],
                        'exception' => $e
                    ]);
                    $coursesProgress[] = [
                        'course' => $enrollment,
                        'error' => 'No se pudo obtener el progreso'
                    ];
                }
            }

            // Ensure the view 'moodle::student.progress' exists
            if (!view()->exists('moodle::student.progress')) {
                 Log::warning("View not found: moodle::student.progress. Check module structure.");
                 return view('moodle::student.dashboard', ['error' => 'Vista de progreso no encontrada.']); // Redirect or show error
            }

            return view('moodle::student.progress', compact('coursesProgress'));
        } catch (Exception $e) {
            Log::error("Student Progress Error: {" . $e->getMessage() . "}", ['user_id' => Auth::id()]);
            return view('moodle::student.progress', ['error' => 'Error al cargar el progreso: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the student's certificates (from DB).
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function certificates(Request $request)
    {
        try {
            $laravelUser = Auth::user();
            if (!isset($laravelUser->moodle_user_id)) {
                 return view('moodle::student.certificates', ['error' => 'Campo moodle_user_id no encontrado en el modelo User de Laravel.']);
            }
            $moodleUserId = $laravelUser->moodle_user_id;

            if (!$moodleUserId) {
                return view('moodle::student.certificates', ['error' => 'Usuario no vinculado con Moodle']);
            }

            // Get certificates from the database linked to this Moodle user ID
            $certificates = MoodleCertificate::where('user_id', $moodleUserId)
                                        ->with('course') // Eager load course relationship if defined in MoodleCertificate model
                                        ->orderBy('issued_at', 'desc')
                                        ->get();

            // Ensure the view 'moodle::student.certificates' exists
            if (!view()->exists('moodle::student.certificates')) {
                 Log::warning("View not found: moodle::student.certificates. Check module structure.");
                 return view('moodle::student.dashboard', ['error' => 'Vista de certificados no encontrada.']); // Redirect or show error
            }

            return view('moodle::student.certificates', compact('certificates'));
        } catch (Exception $e) {
            Log::error("Student Certificates Error: {" . $e->getMessage() . "}", ['user_id' => Auth::id()]);
            return view('moodle::student.certificates', ['error' => 'Error al obtener certificados: ' . $e->getMessage()]);
        }
    }

    /**
     * Request a certificate for a completed course.
     *
     * @param Request $request
     * @param int $courseId Moodle Course ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestCertificate(Request $request, $courseId)
    {
        try {
            $laravelUser = Auth::user();
            if (!isset($laravelUser->moodle_user_id)) {
                 return redirect()->route('moodle.student.certificates')->with('error', 'Campo moodle_user_id no encontrado en el modelo User de Laravel.');
            }
            $moodleUserId = $laravelUser->moodle_user_id;

            if (!$moodleUserId) {
                return redirect()->route('moodle.student.certificates')
                    ->with('error', 'Usuario no vinculado con Moodle');
            }

            // Check if user is enrolled
            $isEnrolled = $this->enrollmentService->isUserEnrolled($moodleUserId, $courseId);
            if (!$isEnrolled) {
                return redirect()->route('moodle.student.certificates')
                    ->with('error', 'No estás matriculado en este curso');
            }

            // Check if course is completed
            $completionStatus = $this->courseService->getCourseCompletionStatus($courseId, $moodleUserId);
            if (!isset($completionStatus['completionstatus']['completed']) || !$completionStatus['completionstatus']['completed']) {
                return redirect()->route('moodle.student.certificates')
                    ->with('error', 'No has completado este curso aún');
            }

            // Check if a certificate already exists in DB for this user/course
            $existingCertificate = MoodleCertificate::where('user_id', $moodleUserId)
                                                ->where('course_id', $courseId)
                                                ->first();
            if ($existingCertificate) {
                 return redirect()->route('moodle.student.certificates')
                    ->with('info', 'Ya tienes un certificado generado para este curso.');
            }

            // Generate certificate file using the service
            // Pass options if needed, e.g., custom date, force generation
            $options = [];
            $certificatePath = $this->certificateService->generateCertificate($moodleUserId, $courseId, $options);

            if (!$certificatePath) {
                // The service should throw an exception, but double-check
                throw new Exception('La generación del certificado falló y no devolvió una ruta.');
            }

            // Create certificate record in database
            $certificateId = 'CERT-' . uniqid(); // Generate a unique ID for the record
            $filename = basename($certificatePath);

MoodleCertificate::create([
                'user_id' => $moodleUserId, // Store Moodle User ID
                'course_id' => $courseId, // Store Moodle Course ID
                'certificate_id' => $certificateId, // Store the unique verification ID
                'filename' => $filename,
                'issued_at' => now(),
                'verified' => true, // Mark as verified upon generation
                'metadata' => $options // Store any relevant options used
            ]);

            return redirect()->route('moodle.student.certificates')
                ->with('success', 'Certificado generado y registrado correctamente. Puedes descargarlo desde la lista.');
        } catch (Exception $e) {
            Log::error("Request Certificate Error: {" . $e->getMessage() . "}", [
                'user_id' => Auth::id(),
                'moodle_user_id' => $moodleUserId ?? null,
                'course_id' => $courseId,
                'exception' => $e
            ]);
            return redirect()->route('moodle.student.certificates')
                ->with('error', 'Error al generar o registrar el certificado: ' . $e->getMessage());
        }
    }
}
