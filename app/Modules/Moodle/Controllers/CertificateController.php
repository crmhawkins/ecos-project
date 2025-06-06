<?php

namespace App\Modules\Moodle\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Moodle\Services\CertificateGeneratorService;
use App\Modules\Moodle\Models\MoodleCertificate;
use App\Modules\Moodle\Services\MoodleUserService;
use App\Modules\Moodle\Services\MoodleCourseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;

class CertificateController extends Controller
{
    protected $certificateService;
    protected $userService;
    protected $courseService;

    public function __construct(
        CertificateGeneratorService $certificateService,
        MoodleUserService $userService,
        MoodleCourseService $courseService
    ) {
        $this->certificateService = $certificateService;
        $this->userService = $userService;
        $this->courseService = $courseService;
    }

    public function index(Request $request)
    {
        try {
            $laravelUser = Auth::user();
            if (!isset($laravelUser->moodle_user_id)) {
                return response()->json(["success" => false, "message" => "Campo moodle_user_id no encontrado en el modelo User de Laravel."], 400);
            }

            $moodleUserId = $laravelUser->moodle_user_id;

            $certificates = MoodleCertificate::where('user_id', $moodleUserId)
                ->with('course')
                ->orderBy('issued_at', 'desc')
                ->get();

            return response()->json(["success" => true, "certificates" => $certificates]);

        } catch (Exception $e) {
            Log::error("Certificate Index Error: {" . $e->getMessage() . "}", ["user_id" => Auth::id()]);
            return response()->json(["success" => false, "message" => "Error al obtener certificados: " . $e->getMessage()], 500);
        }
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'course_id' => 'required|integer',
            'options' => 'nullable|array'
        ]);

        try {
            $userId = $validated['user_id'];
            $courseId = $validated['course_id'];
            $options = $validated['options'] ?? [];

            $existingCertificate = MoodleCertificate::where('user_id', $userId)
                ->where('course_id', $courseId)
                ->first();

            if ($existingCertificate && !($options['force_regeneration'] ?? false)) {
                return response()->json(["success" => false, "message" => "Ya existe un certificado para este usuario y curso."], 409);
            }

            $certificatePath = $this->certificateService->generateCertificate($userId, $courseId, $options);

            if (!$certificatePath) {
                throw new Exception("La generación del certificado falló.");
            }

            $certificateId = $options['certificate_id'] ?? 'CERT-' . uniqid();
            $filename = basename($certificatePath);

            $certificateRecord = MoodleCertificate::updateOrCreate(
                ['user_id' => $userId, 'course_id' => $courseId],
                [
                    'certificate_id' => $certificateId,
                    'file_path' => $filename,
                    'issued_at' => now()
                ]
            );

            return response()->json(["success" => true, "certificate" => $certificateRecord]);

        } catch (Exception $e) {
            Log::error("Certificate Generation Error: {" . $e->getMessage() . "}");
            return response()->json(["success" => false, "message" => $e->getMessage()], 500);
        }
    }

    public function download($id)
    {
        try {
            $certificate = MoodleCertificate::findOrFail($id);
            $path = storage_path('app/certificates/' . $certificate->filename);

            if (!file_exists($path)) {
                return response()->json(["success" => false, "message" => "El archivo del certificado no existe."], 404);
            }

            return Response::download($path);

        } catch (Exception $e) {
            Log::error("Certificate Download Error: {" . $e->getMessage() . "}");
            return response()->json(["success" => false, "message" => $e->getMessage()], 500);
        }
    }

    public function verify($certificateId)
    {
        try {
            $certificate = MoodleCertificate::where('certificate_id', $certificateId)->first();

            if (!$certificate) {
                return response()->json(["success" => false, "message" => "Certificado no encontrado."], 404);
            }

            return response()->json(["success" => true, "certificate" => $certificate]);

        } catch (Exception $e) {
            Log::error("Certificate Verification Error: {" . $e->getMessage() . "}");
            return response()->json(["success" => false, "message" => $e->getMessage()], 500);
        }
    }
}
