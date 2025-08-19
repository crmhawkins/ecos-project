<?php

namespace App\Modules\Moodle\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cursos\Cursos;
use App\Modules\Moodle\Services\MoodleApiService;
use App\Modules\Moodle\Services\MoodleUserService;
use App\Modules\Moodle\Services\MoodleCourseService;
use App\Modules\Moodle\Services\MoodleEnrollmentService;
use App\Modules\Moodle\Models\MoodleCertificate; // Added for certificate admin
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log; // Added for logging
use Illuminate\Support\Facades\Artisan; // Added for cache clearing
use Illuminate\Support\Facades\File; // Added for file operations
use Illuminate\Support\Facades\Config; // Added for config management
use Illuminate\Support\Facades\Storage; // Added for file storage
use Exception;

class AdminController extends Controller
{
    protected $apiService;
    protected $userService;
    protected $courseService;
    protected $enrollmentService;

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

        // Middleware should be applied in routes/web.php or a RouteServiceProvider
    }

    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function dashboard()
    {
        try {
            $connectionStatus = $this->apiService->testConnection();
            $siteInfo = $connectionStatus ? $this->apiService->getSiteInfo() : null;

            return view("moodle::admin.dashboard", compact("connectionStatus", "siteInfo"));
        } catch (Exception $e) {
            Log::error("Admin Dashboard Error: {" . $e->getMessage() . "}");
            return view("moodle::admin.dashboard", ["connectionStatus" => false, "error" => "Error al conectar con Moodle: " . $e->getMessage()]);
        }
    }

    /**
     * Display a listing of users from Moodle.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function users(Request $request)
    {
        try {
            $search = $request->input("search");
            $searchType = $request->input("searchType");
            $status = $request->input("status"); // active, suspended
            $page = $request->input("page", 1);
            $perPage = 15;

            $criteria = [];

            // Solo buscar si hay un término de búsqueda específico
            if ($search && $searchType && strlen(trim($search)) >= 2) {
                $criteria[] = ["key" => $searchType , "value" => "%" . $search . "%"];  // Usar 'key' y 'value' en inglés
            }

            // Si no hay criterios de búsqueda, usar la nueva lógica que evita timeout
            if (empty($criteria)) {
                // Usar el método que busca solo usuarios activos para evitar timeout
                $moodleUsers = $this->userService->searchUsers($criteria);
            } else {
                $moodleUsers = $this->userService->searchUsers($criteria);
            }

            //dd($moodleUsers);
            // --- Local Filtering ---
            if ($status === "suspended") {
                $moodleUsers = array_filter($moodleUsers, fn($user) => $user["suspended"] === true);
            } elseif ($status === "active") {
                $moodleUsers = array_filter($moodleUsers, fn($user) => $user["suspended"] === false);
            }

            $usersCollection = new Collection(array_values($moodleUsers));
            $paginatedUsers = new LengthAwarePaginator(
                $usersCollection->forPage($page, $perPage),
                $usersCollection->count(),
                $perPage,
                $page,
                ["path" => $request->url(), "query" => $request->query()]
            );

            return view("moodle::admin.users", [
                "users" => $paginatedUsers,
                "search" => $search,
                "searchType" => $searchType,
                "selectedStatus" => $status,
            ]);
        } catch (Exception $e) {
            Log::error("Admin Users Error: {" . $e->getMessage() . "}");
            return view("moodle::admin.users", ["error" => "Error al obtener usuarios: " . $e->getMessage()]);
        }
    }

    /**
     * Search users via AJAX for modals/autocomplete.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchUsersAjax(Request $request)
    {
        try {
            $search = $request->input("search");
            if (empty($search) || strlen($search) < 3) {
                return response()->json(["success" => false, "message" => "Término de búsqueda debe tener al menos 3 caracteres"], 400);
            }

            $criteria = [
                ["key" => "firstname", "value" => "%" . $search . "%"]  // Usar 'key' y 'value' en inglés
            ];

            $users = $this->userService->searchUsers($criteria);

            $formattedUsers = array_map(function($user) {
                return ["id" => $user["id"], "firstname" => $user["firstname"], "lastname" => $user["lastname"], "email" => $user["email"], "username" => $user["username"]];
            }, array_slice($users, 0, 20));

            return response()->json(["success" => true, "users" => $formattedUsers]);
        } catch (Exception $e) {
            Log::error("AJAX User Search Error: {" . $e->getMessage() . "}", ["search" => $request->input("search")]);
            return response()->json(["success" => false, "message" => "Error buscando usuarios: " . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created user in Moodle.
     *
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            "firstname" => "required|string|max:100",
            "lastname" => "required|string|max:100",
            "email" => "required|email|max:100",
            "username" => "required|string|max:100",
            "password" => "required|string|min:8",
        ]);

        try {
            $userData = $validated;
            $userData["auth"] = config("moodle.user_sync.default_auth") ?? "manual";
            $userData["lang"] = config("app.locale");

            $newUserResponse = $this->userService->createUser($userData);

            if (!$newUserResponse || !isset($newUserResponse["id"])) {
                throw new Exception("La API de Moodle no devolvió un ID de usuario válido.");
            }

            return redirect()->route("moodle.admin.users")->with("success", "Usuario ".$validated["username"]." creado correctamente en Moodle.");
        } catch (Exception $e) {
            Log::error("Admin Store User Error: {" . $e->getMessage() . "}", ["data" => $validated]);
            return redirect()->route("moodle.admin.users")->with("error", "Error al crear usuario: " . $e->getMessage());
        }
    }

    /**
     * Update the specified user in Moodle.
     *
     * @param  Request $request
     * @param  int  $userId Moodle User ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUser(Request $request, $userId)
    {
        $validated = $request->validate([
            "firstname" => "required|string|max:100",
            "lastname" => "required|string|max:100",
            "email" => "required|email|max:100",
            "password" => "nullable|string|min:8",
            "suspended" => "boolean",
        ]);

        try {
            $userData = $validated;
            $userData["id"] = $userId;

            if (empty($validated["password"])) {
                unset($userData["password"]);
            }
            $userData["suspended"] = $request->has("suspended") ? 1 : 0;

            $this->userService->updateUser($userId, $userData);

            return redirect()->route("moodle.admin.users")->with("success", "Usuario actualizado correctamente.");
        } catch (Exception $e) {
            Log::error("Admin Update User Error: {" . $e->getMessage() . "}", ["userId" => $userId, "data" => $validated]);
            return redirect()->route("moodle.admin.users")->with("error", "Error al actualizar usuario: " . $e->getMessage());
        }
    }

    /**
     * Remove the specified user from Moodle.
     *
     * @param  int  $userId Moodle User ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyUser($userId)
    {
        try {
            $this->userService->deleteUser($userId);
            return redirect()->route("moodle.admin.users")->with("success", "Usuario eliminado correctamente.");
        } catch (Exception $e) {
            Log::error("Admin Delete User Error: {" . $e->getMessage() . "}", ["userId" => $userId]);
            return redirect()->route("moodle.admin.users")->with("error", "Error al eliminar usuario: " . $e->getMessage());
        }
    }

    /**
     * Display the courses management page.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function courses(Request $request)
    {
        try {
            $baseUrl = config("moodle.connection.url");
            $search = $request->input("search");
            $categoryId = $request->input("category");
            $visibility = $request->input("visibility");
            $page = $request->input("page", 1);
            $perPage = 15;

            $moodleCourses = $this->courseService->getAllCourses();

            // --- Local Filtering ---
            if ($search) {
                $moodleCourses = array_filter($moodleCourses, function($course) use ($search) {
                    return stripos($course["fullname"], $search) !== false || stripos($course["shortname"], $search) !== false;
                });
            }
            if ($categoryId) {
                $moodleCourses = array_filter($moodleCourses, fn($course) => $course["categoryid"] == $categoryId);
            }
            if ($visibility === "visible") {
                $moodleCourses = array_filter($moodleCourses, fn($course) => isset($course["visible"]) && $course["visible"] == 1);
            } elseif ($visibility === "hidden") {
                $moodleCourses = array_filter($moodleCourses, fn($course) => !isset($course["visible"]) || $course["visible"] == 0);
            }
            // --- End Local Filtering ---

            $categories = $this->courseService->getCategories();

            $coursesCollection = new Collection(array_values($moodleCourses));
            $paginatedCourses = new LengthAwarePaginator(
                $coursesCollection->forPage($page, $perPage),
                $coursesCollection->count(),
                $perPage,
                $page,
                ["path" => $request->url(), "query" => $request->query()]
            );

            return view("moodle::admin.courses", [
                "courses" => $paginatedCourses,
                "categories" => $categories,
                "search" => $search,
                "selectedCategory" => $categoryId,
                "visibility" => $visibility,
                "baseUrl" => $baseUrl
            ]);
        } catch (Exception $e) {
            Log::error("Admin Courses Error: {" . $e->getMessage() . "}");
            return view("moodle::admin.courses", ["error" => "Error al obtener cursos: " . $e->getMessage()]);
        }
    }

    /**
     * Store a newly created course in Moodle.
     *
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            "fullname" => "required|string|max:254",
            "shortname" => "required|string|max:100",
            "categoryid" => "required|integer",
            "summary" => "nullable|string",
            "format" => "nullable|string|in:topics,weeks,social,singleactivity",
            "startdate" => "nullable|date",
            "enddate" => "nullable|date|after_or_equal:startdate",
            "visible" => "boolean",
        ]);

        try {
            $courseData = $validated;
            if (!empty($validated["startdate"])) {
                $courseData["startdate"] = strtotime($validated["startdate"]);
            }
            if (!empty($validated["enddate"])) {
                $courseData["enddate"] = strtotime($validated["enddate"]);
            }
            $courseData["format"] = $validated["format"] ?? "topics";

            $newCourseResponse = $this->courseService->createCourse($courseData);

            if (!$newCourseResponse || !isset($newCourseResponse["id"])) {
                throw new Exception("La API de Moodle no devolvió un ID de curso válido.");
            }

            Cursos::create([
                "moodle_id" => $newCourseResponse["id"],
                "name" => $validated["fullname"],
                "description" => $validated["summary"],
                "inactive" => 1
            ]);

            return redirect()->route("moodle.admin.courses")->with("success", "Curso ".$validated["shortname"]." creado correctamente en Moodle.");
        } catch (Exception $e) {
            Log::error("Admin Store Course Error: {" . $e->getMessage() . "}", ["data" => $validated]);
            return redirect()->route("moodle.admin.courses")->with("error", "Error al crear curso: " . $e->getMessage());
        }
    }

    /**
     * Update the specified course in Moodle.
     *
     * @param  Request $request
     * @param  int  $courseId Moodle Course ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCourse(Request $request, $courseId)
    {
        $validated = $request->validate([
            "fullname" => "required|string|max:254",
            "shortname" => "required|string|max:100",
            "categoryid" => "required|integer",
            "summary" => "nullable|string",
            "format" => "nullable|string|in:topics,weeks,social,singleactivity",
            "startdate" => "nullable|date",
            "enddate" => "nullable|date|after_or_equal:startdate",
            "visible" => "boolean",
        ]);

        try {
            $courseData = $validated;
            $courseData["id"] = $courseId;
             if (!empty($validated["startdate"])) {
                $courseData["startdate"] = strtotime($validated["startdate"]);
            }
            if (!empty($validated["enddate"])) {
                $courseData["enddate"] = strtotime($validated["enddate"]);
            }
            $courseData["visible"] = $request->has("visible") ? 1 : 0;
            $courseData["format"] = $validated["format"] ?? "topics";

            $this->courseService->updateCourse($courseId, $courseData);

            return redirect()->route("moodle.admin.courses")->with("success", "Curso actualizado correctamente.");
        } catch (Exception $e) {
            Log::error("Admin Update Course Error: {" . $e->getMessage() . "}", ["courseId" => $courseId, "data" => $validated]);
            return redirect()->route("moodle.admin.courses")->with("error", "Error al actualizar curso: " . $e->getMessage());
        }
    }

    /**
     * Remove the specified course from Moodle.
     *
     * @param  int  $courseId Moodle Course ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyCourse($courseId)
    {
        try {
            $this->courseService->deleteCourse($courseId);
            return redirect()->route("moodle.admin.courses")->with("success", "Curso eliminado correctamente.");
        } catch (Exception $e) {
            Log::error("Admin Delete Course Error: {" . $e->getMessage() . "}", ["courseId" => $courseId]);
            return redirect()->route("moodle.admin.courses")->with("error", "Error al eliminar curso: " . $e->getMessage());
        }
    }

    public function clonarCourse($courseId)
    {
        $course = $this->courseService->getCourse($courseId);
        Cursos::updateOrCreate(
            ['moodle_id' => $course['id']], // condición para encontrarlo
            [
                'name' => $course['fullname'],
                'description' => $course['summary'],
                'inactive' => 1,
            ]);

        return redirect()->route("moodle.admin.courses")->with("success", "Curso sincronizado correctamente.");
    }

    /**
     * Display the enrollments management page.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function enrollments(Request $request)
    {
        try {
            $courseId = $request->input("course_id");
            $enrolledUsers = [];
            $courses = $this->courseService->getAllCourses(); // For dropdown

            if ($courseId) {
                $enrolledUsersData = $this->enrollmentService->getEnrolledUsers($courseId);
                // TODO: Consider pagination if the list is large
                $collection = collect($enrolledUsersData);

                // Paginate manually (10 per page, for example)
                $perPage = 10;
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
                $pagedData = $collection->slice(($currentPage - 1) * $perPage, $perPage)->values();

                $enrolledUsers = new LengthAwarePaginator(
                    $pagedData,
                    $collection->count(),
                    $perPage,
                    $currentPage,
                    ['path' => $request->url(), 'query' => $request->query()]
                );
            }

            // Fetch Moodle roles for enrollment modal
            $moodleRoles = [];
            try {
                $rolesData = $this->apiService->call("core_role_get_roles");
                if (is_array($rolesData)) {
                    $assignableRoles = ["student", "teacher", "editingteacher"];
                    $moodleRoles = array_filter($rolesData, fn($role) => in_array($role["shortname"], $assignableRoles));
                }
            } catch (Exception $roleEx) {
                Log::error("Failed to fetch Moodle roles for enrollment: {" . $roleEx->getMessage() . "}");
            }

            return view("moodle::admin.enrollments", [
                "enrolledUsers" => $enrolledUsers,
                "courses" => $courses,
                "roles" => $moodleRoles,
                "selectedCourseId" => $courseId
            ]);
        } catch (Exception $e) {
            Log::error("Admin Enrollments Error: {" . $e->getMessage() . "}", ["course_id" => $request->input("course_id")]);
            $courses = $this->courseService->getAllCourses();
            return view("moodle::admin.enrollments", [
                "error" => "Error al obtener matriculaciones: " . $e->getMessage(),
                "courses" => $courses,
                "selectedCourseId" => $request->input("course_id")
                ]);
        }
    }

    /**
     * Enroll a user in a course.
     *
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enrollUser(Request $request)
    {
        $validated = $request->validate([
            "course_id" => "required|integer",
            "user_id" => "required|integer",
            "role_id" => "required|integer",
        ]);

        try {
            $this->enrollmentService->enrollUser(
                $validated["user_id"],
                $validated["course_id"],
                $validated["role_id"]
            );

            return redirect()->route("moodle.admin.enrollments", ["course_id" => $validated["course_id"]])
                             ->with("success", "Usuario matriculado correctamente.");
        } catch (Exception $e) {
            Log::error("Admin Enroll User Error: {" . $e->getMessage() . "}", ["data" => $validated]);
            return redirect()->route("moodle.admin.enrollments", ["course_id" => $validated["course_id"]])
                             ->with("error", "Error al matricular usuario: " . $e->getMessage());
        }
    }

    /**
     * Update a user"s enrollment (e.g., change role).
     *
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateEnrollment(Request $request)
    {
        $validated = $request->validate([
            "course_id" => "required|integer",
            "user_id" => "required|integer",
            "role_id" => "required|integer", // New Role ID
        ]);

        try {
            // Workaround: Unenroll and re-enroll
            $this->enrollmentService->unenrollUser($validated["user_id"], $validated["course_id"]);
            $this->enrollmentService->enrollUser($validated["user_id"], $validated["course_id"], $validated["role_id"]);

            return redirect()->route("moodle.admin.enrollments", ["course_id" => $validated["course_id"]])
                             ->with("success", "Matriculación actualizada correctamente (mediante re-matriculación).");
        } catch (Exception $e) {
            Log::error("Admin Update Enrollment Error: {" . $e->getMessage() . "}", ["data" => $validated]);
            return redirect()->route("moodle.admin.enrollments", ["course_id" => $validated["course_id"]])
                             ->with("error", "Error al actualizar matriculación: " . $e->getMessage());
        }
    }

    /**
     * Unenroll a user from a course.
     *
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unenrollUser(Request $request)
    {
         $validated = $request->validate([
            "course_id" => "required|integer",
            "user_id" => "required|integer",
        ]);

        try {
            $this->enrollmentService->unenrollUser($validated["user_id"], $validated["course_id"]);

            return redirect()->route("moodle.admin.enrollments", ["course_id" => $validated["course_id"]])
                             ->with("success", "Usuario desmatriculado correctamente.");
        } catch (Exception $e) {
            Log::error("Admin Unenroll User Error: {" . $e->getMessage() . "}", ["data" => $validated]);
            return redirect()->route("moodle.admin.enrollments", ["course_id" => $validated["course_id"]])
                             ->with("error", "Error al desmatricular usuario: " . $e->getMessage());
        }
    }

    /**
     * Display the certificates management page (local DB records).
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function certificates(Request $request)
    {
        try {
            $search = $request->input("search");
            $selectedCourseId = $request->input("course_id");
            $dateRange = $request->input("dateRange");
            $page = $request->input("page", 1);
            $perPage = 15;

            $query = MoodleCertificate::query();

            // Filtros básicos por campo directo
            if ($search) {
                $query->where("certificate_id", "like", "%{$search}%")
                    ->orWhere("user_id", "like", "%{$search}%")
                    ->orWhere("course_id", "like", "%{$search}%");
            }

            if ($selectedCourseId) {
                $query->where("course_id", $selectedCourseId);
            }

             if ($dateRange) {
            switch ($dateRange) {
                case 'today':
                    $query->whereDate('issued_at', Carbon::today());
                    break;
                case 'week':
                    $query->whereDate('issued_at', '>=', Carbon::now()->subWeek());
                    break;
                case 'month':
                    $query->whereDate('issued_at', '>=', Carbon::now()->subMonth());
                    break;
                case 'year':
                    $query->whereDate('issued_at', '>=', Carbon::now()->subYear());
                    break;
            }
        }


            $certificates = $query->orderBy("issued_at", "desc")->paginate($perPage);

            // ✅ Cargar datos reales desde Moodle API
            $userService = app(MoodleUserService::class);
            $courseService = app(MoodleCourseService::class);

            $certificates->getCollection()->transform(function ($cert) use ($userService, $courseService) {
                $cert->user_data = $userService->getUser($cert->user_id);
                $cert->course_data = $courseService->getCourse($cert->course_id);
                $cert->verification_url = $cert->getVerificationUrl();
                return $cert;
            });

            // Para filtros (lista de cursos)
            $courses = $courseService->getAllCourses();

            return view("moodle::admin.certificates", [
                "certificates" => $certificates,
                "courses" => $courses,
                "search" => $search,
                "selectedCourseId" => $selectedCourseId,
                "dateRange" => $dateRange,
            ]);
        } catch (Exception $e) {
            Log::error("Admin Certificates Error: {" . $e->getMessage() . "}");
            return view("moodle::admin.certificates", [
                "error" => "Error al obtener certificados: " . $e->getMessage()
            ]);
        }
    }

    public function deleteCertificate($id)
    {
        try {
            $certificate = MoodleCertificate::findOrFail($id);
            $certificate->delete();
            return redirect()->route("moodle.admin.certificates")->with("success", "Certificado eliminado correctamente.");
        } catch (Exception $e) {
            Log::error("Admin Delete Certificate Error: {" . $e->getMessage() . "}", ["certificate_id" => $id]);
            return redirect()->route("moodle.admin.certificates")->with("error", "Error al eliminar certificado: " . $e->getMessage());
        }
    }

    /**
     * Display the settings page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function settings()
    {
        $connectionStatus = $this->apiService->testConnection();

        $settings = [
            "url" => config("moodle.connection.url"),
            "token" => config("moodle.connection.token"),
            "protocol" => config("moodle.connection.protocol"),
            "format" => config("moodle.connection.format"),
            "timeout" => config("moodle.timeout"),
            "cache_enabled" => config("moodle.cache.enabled"),
            "cache_ttl" => config("moodle.cache.ttl"),
            "certificates_path" => config("moodle.certificates.path"),
            "certificate_template" => config("moodle.certificates.template"),
            "signature_image" => config("moodle.certificates.signature_image"),
        ];
        // dd($settings, $connectionStatus);
        return view("moodle::admin.settings", compact("settings", "connectionStatus"));
    }

    /**
     * Update the Moodle module settings.
     * This function updates the .env file. Be cautious with file permissions.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSettings(Request $request)
    {

        $request->merge([
            'cache_enabled' => $request->has('cache_enabled') ? 1 : 0,
            'auto_create_users' => $request->has('cache_enabled') ? 1 : 0,
            'auto_update_users' => $request->has('cache_enabled') ? 1 : 0,
            'auto_enroll' => $request->has('cache_enabled') ? 1 : 0,
        ]);
        $validated = $request->validate([
            "url" => "required|url",
            "token" => "required|string|min:32",
            "protocol" => "required|in:rest",
            "format" => "required|in:json",
            "timeout" => "required|integer|min:5",
            "cache_enabled" => "boolean",
            "cache_ttl" => "required_if:cache_enabled,1|integer|min:60",
            "certificates_path" => "required|string",
            "certificate_template" => "required|string",
            "signature_image" => "nullable|string", // Path to signature image
        ]);
        try {
            // Path to the .env file
            $envPath = base_path(".env");

            if (!File::exists($envPath)) {
                throw new Exception(".env file not found.");
            }

            // Read the existing .env content
            $content = File::get($envPath);

            // Prepare the settings to update/add
            $settingsToUpdate = [
                "MOODLE_API_URL" => $validated["url"] ?? config("moodle.connection.url"),
                "MOODLE_API_TOKEN" => $validated["token"] ?? config("moodle.connection.token"),
                "MOODLE_API_PROTOCOL" => $validated["protocol"] ?? config("moodle.connection.protocol"),
                "MOODLE_API_FORMAT" => $validated["format"] ?? config("moodle.connection.format"),
                "MOODLE_API_TIMEOUT" => $validated["timeout"] ?? config("moodle.timeout"),
                "MOODLE_CACHE_ENABLED" => $request->has("cache_enabled") ? "true" : "false",
                "MOODLE_CACHE_TTL" => $validated["cache_ttl"] ?? config("moodle.cache.ttl"),
                "MOODLE_CERTIFICATES_PATH" => $validated["certificates_path"] ?? config("moodle.certificates.path"),
                "MOODLE_CERTIFICATE_TEMPLATE" => $validated["certificate_template"] ?? config("moodle.certificates.template"),
                "MOODLE_SIGNATURE_IMAGE" => $validated["signature_image"] ?? config("moodle.certificates.signature_image"),
            ];
            // Update or add each setting in the .env content
            foreach ($settingsToUpdate as $key => $value) {
                $key = strtoupper($key);
                $escapedValue = preg_match("/\s/", $value) ? "".$value."" : $value; // Add quotes if value has spaces

                if (preg_match("/^" . $key . "=.*/m", $content)) {
                    // Key exists, update it
                    $content = preg_replace("/^" . $key . "=.*/m", "{$key}={$escapedValue}", $content);
                } else {
                    // Key doesn"t exist, add it to the end
                    $content .= "\n{$key}={$escapedValue}";
                }
            }

            // Write the updated content back to .env
            if (File::put($envPath, $content) === false) {
                throw new Exception("Failed to write to .env file. Check permissions.");
            }

            // Clear config cache to apply changes
            Artisan::call("config:cache");

            return redirect()->route("moodle.admin.settings")->with("success", "Configuración actualizada correctamente. La caché de configuración ha sido limpiada.");

        } catch (Exception $e) {
            Log::error("Admin Update Settings Error: {" . $e->getMessage() . "}", ["data" => $validated]);
            return redirect()->route("moodle.admin.settings")->with("error", "Error al actualizar la configuración: " . $e->getMessage());
        }
    }

    public function testConnection()
    {
        try {
            $ok = $this->apiService->testConnection();
            if ($ok) {
                $siteInfo = $ok ? $this->apiService->getSiteInfo() : null;
                return response()->json([
                    'success' => true,
                    'message' => 'Conexión exitosa con Moodle.',
                    'site' => $siteInfo
                ]);
            }
        } catch (Exception $e) {
            Log::error("Admin Dashboard Error: {" . $e->getMessage() . "}");
            return view("moodle::admin.dashboard", ["connectionStatus" => false, "error" => "Error al conectar con Moodle: " . $e->getMessage()]);
        }
    }

    public function getUserCourses($id)
    {
        try {
            $enrolledCourses = $this->enrollmentService->getUserEnrollments($id);

            return response()->json([
                'success' => true,
                'courses' => $enrolledCourses
            ]);
        } catch (\Exception $e) {
            Log::error("Admin User Courses Error: {" . $e->getMessage() . "}");

            return response()->json([
                'success' => false,
                'message' => 'Error al obtener cursos: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getCourseContent($id)
    {
        try {
            $courseId = $id;
            $courses = $this->courseService->getCourseContents($courseId);

            return response()->json([
                'success' => true,
                'contents' => $courses
            ]);
        } catch (\Exception $e) {
            Log::error("Admin User Courses Error: {" . $e->getMessage() . "}");

            return response()->json([
                'success' => false,
                'message' => 'Error al obtener cursos: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getCompletedCourses(Request $request){
        $userId = $request->input('user_id');
        try {
            $courses = $this->enrollmentService->getUserEnrollments($userId);

            return response()->json([
                'success' => true,
                'courses' => $courses
            ]);
        } catch (\Exception $e) {
            Log::error("Admin User Courses Error: {" . $e->getMessage() . "}");

            return response()->json([
                'success' => false,
                'message' => 'Error al obtener cursos: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Listado de categorías de cursos
     */
    public function categories()
    {
        try {
            $categories = $this->courseService->getCategories();
            return view('moodle::admin.categories', compact('categories'));
        } catch (Exception $e) {
            Log::error("Error al cargar categorías: " . $e->getMessage());
            return view('moodle::admin.categories', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Crear nueva categoría de curso en Moodle
     */
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        try {
            $this->courseService->createCategory($validated);
            return redirect()->route('moodle.admin.categories')->with('success', 'Categoría creada correctamente.');
        } catch (Exception $e) {
            Log::error("Error al crear categoría: " . $e->getMessage());
            return redirect()->route('moodle.admin.categories')->with('error', 'Error al crear la categoría: ' . $e->getMessage());
        }
    }

    public function updateCategory(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        try {
            $validated['id'] = (int) $id;
            $this->courseService->updateCategory($validated);
            return redirect()->route('moodle.admin.categories')->with('success', 'Categoría actualizada correctamente.');
        } catch (Exception $e) {
            Log::error("Error al actualizar categoría: " . $e->getMessage());
            return redirect()->route('moodle.admin.categories')->with('error', 'Error al actualizar la categoría: ' . $e->getMessage());
        }
    }

    public function destroyCategory($id)
    {
        try {
            $this->courseService->deleteCategory((int) $id);
            return redirect()->route('moodle.admin.categories')->with('success', 'Categoría eliminada correctamente.');
        } catch (Exception $e) {
            Log::error("Error al eliminar categoría: " . $e->getMessage());
            return redirect()->route('moodle.admin.categories')->with('error', 'Error al eliminar la categoría: ' . $e->getMessage());
        }
    }
}
