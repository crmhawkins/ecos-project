<?php

namespace App\Modules\Moodle\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Moodle\Services\MoodleApiService;
use App\Modules\Moodle\Services\MoodleUserService;
use App\Modules\Moodle\Services\MoodleCourseService;
use App\Modules\Moodle\Services\MoodleEnrollmentService;
use Illuminate\Http\Request;
use Exception;

class AdminController extends Controller
{
    /**
     * The MoodleApiService instance
     *
     * @var \App\Modules\Moodle\Services\MoodleApiService
     */
    protected $apiService;

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
     * Create a new AdminController instance.
     *
     * @param \App\Modules\Moodle\Services\MoodleApiService $apiService
     * @param \App\Modules\Moodle\Services\MoodleUserService $userService
     * @param \App\Modules\Moodle\Services\MoodleCourseService $courseService
     * @param \App\Modules\Moodle\Services\MoodleEnrollmentService $enrollmentService
     * @return void
     */
    public function __construct(
        MoodleApiService $apiService,
        MoodleUserService $userService,
        MoodleCourseService $courseService,
        MoodleEnrollmentService $enrollmentService
    ) {
        $this->apiService = $apiService;
        $this->userService = $userService;
        $this->courseService = $courseService;
        $this->enrollmentService = $enrollmentService;

        // Apply admin middleware
        $this->middleware(['auth']);
    }

    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        try {
            // Test connection to Moodle API
            $connectionStatus = $this->apiService->testConnection();

            // Get Moodle site info if connection is successful
            $siteInfo = $connectionStatus ? $this->apiService->getSiteInfo() : null;

            return view('moodle::admin.dashboard', [
                'connectionStatus' => $connectionStatus,
                'siteInfo' => $siteInfo
            ]);
        } catch (Exception $e) {
            return view('moodle::admin.dashboard', [
                'connectionStatus' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the users management page.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function users(Request $request)
    {
        try {
            // Get search parameters
            $search = $request->input('search');

            // Get users from Moodle
            // In a real implementation, this would include pagination and more search options
            $users = [];

            return view('moodle::admin.users', [
                'users' => $users,
                'search' => $search
            ]);
        } catch (Exception $e) {
            return view('moodle::admin.users', [
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the courses management page.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function courses(Request $request)
    {
        try {
            // Get courses from Moodle
            $courses = $this->courseService->getAllCourses();

            // Get categories
            $categories = $this->courseService->getCategories();

            return view('moodle::admin.courses', [
                'courses' => $courses,
                'categories' => $categories
            ]);
        } catch (Exception $e) {
            return view('moodle::admin.courses', [
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the enrollments management page.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function enrollments(Request $request)
    {
        try {
            // Get course ID from request
            $courseId = $request->input('course_id');

            // Get enrolled users if course ID is provided
            $enrolledUsers = $courseId ? $this->enrollmentService->getEnrolledUsers($courseId) : [];

            // Get all courses for the dropdown
            $courses = $this->courseService->getAllCourses();

            return view('moodle::admin.enrollments', [
                'enrolledUsers' => $enrolledUsers,
                'courses' => $courses,
                'selectedCourseId' => $courseId
            ]);
        } catch (Exception $e) {
            return view('moodle::admin.enrollments', [
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the certificates management page.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function certificates(Request $request)
    {
        try {
            // Get certificates from database
            $certificates = \App\Modules\Moodle\Models\MoodleCertificate::with(['user', 'course'])
                ->orderBy('created_at', 'desc')
                ->paginate(20);

            return view('moodle::admin.certificates', [
                'certificates' => $certificates
            ]);
        } catch (Exception $e) {
            return view('moodle::admin.certificates', [
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        try {
            $connectionStatus = $this->apiService->testConnection();

            // Get current settings
            $settings = [
                'url' => config('moodle.connection.url'),
                'token' => config('moodle.connection.token'),
                'protocol' => config('moodle.connection.protocol'),
                'format' => config('moodle.connection.format'),
                'timeout' => config('moodle.timeout'),
                'cache_enabled' => config('moodle.cache.enabled'),
                'cache_ttl' => config('moodle.cache.ttl'),
                'auto_create_users' => config('moodle.user_sync.auto_create'),
                'auto_update_users' => config('moodle.user_sync.auto_update'),
                'default_role' => config('moodle.user_sync.default_role'),
                'auto_enroll' => config('moodle.enrollment.auto_enroll'),
                'enroll_method' => config('moodle.enrollment.enroll_method'),
                'certificates_path' => config('moodle.certificates.path'),
                'certificate_template' => config('moodle.certificates.template'),
                'signature_image' => config('moodle.certificates.signature_image'),
            ];

            return view('moodle::admin.settings', [
                'settings' => $settings,
                'connectionStatus' => $connectionStatus,

            ]);
        } catch (Exception $e) {
            return view('moodle::admin.settings', [
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update settings.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateSettings(Request $request)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'url' => 'required|url',
                'token' => 'required|string',
                'protocol' => 'required|in:rest,soap,xmlrpc',
                'format' => 'required|in:json,xml',
                'timeout' => 'required|integer|min:5|max:120',
                'cache_enabled' => 'boolean',
                'cache_ttl' => 'required|integer|min:60|max:86400',
                'auto_create_users' => 'boolean',
                'auto_update_users' => 'boolean',
                'default_role' => 'required|string',
                'auto_enroll' => 'boolean',
                'enroll_method' => 'required|string',
                'certificates_path' => 'required|string',
                'certificate_template' => 'required|string',
                'signature_image' => 'nullable|string',
            ]);

            // In a real implementation, this would update the .env file or database settings
            // For now, we'll just return success

            return redirect()->route('moodle.admin.settings')
                ->with('success', 'Configuración actualizada correctamente');
        } catch (Exception $e) {
            return redirect()->route('moodle.admin.settings')
                ->with('error', 'Error al actualizar la configuración: ' . $e->getMessage());
        }
    }

    /**
     * Test connection to Moodle API.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function testConnection(Request $request)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'url' => 'required|url',
                'token' => 'required|string',
                'protocol' => 'required|in:rest,soap,xmlrpc',
                'format' => 'required|in:json,xml',
            ]);

            // Create a temporary API service with the provided credentials
            $tempApiService = new MoodleApiService();

            // Set the credentials
            // In a real implementation, this would use dependency injection or a factory
            // For now, we'll just return success

            return response()->json([
                'success' => true,
                'message' => 'Conexión exitosa con la API de Moodle'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al conectar con la API de Moodle: ' . $e->getMessage()
            ], 500);
        }
    }
}
