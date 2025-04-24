<?php

namespace App\Modules\Moodle\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Moodle\Services\CertificateGeneratorService;
use App\Modules\Moodle\Models\MoodleCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Exception;

class CertificateController extends Controller
{
    /**
     * The CertificateGeneratorService instance
     *
     * @var \App\Modules\Moodle\Services\CertificateGeneratorService
     */
    protected $certificateService;

    /**
     * Create a new CertificateController instance.
     *
     * @param \App\Modules\Moodle\Services\CertificateGeneratorService $certificateService
     * @return void
     */
    public function __construct(CertificateGeneratorService $certificateService)
    {
        $this->certificateService = $certificateService;
    }

    /**
     * Display a listing of the user's certificates.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            // Get authenticated user's Moodle ID
            $userId = $request->user()->moodle_user_id;
            
            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no vinculado con Moodle'
                ], 400);
            }
            
            // Get user certificates
            $certificates = $this->certificateService->getUserCertificates($userId);
            
            return response()->json([
                'success' => true,
                'certificates' => $certificates
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener certificados: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate a certificate for a user who completed a course.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|integer',
                'course_id' => 'required|integer',
            ]);
            
            $userId = $request->input('user_id');
            $courseId = $request->input('course_id');
            $options = $request->input('options', []);
            
            // Generate certificate
            $certificatePath = $this->certificateService->generateCertificate($userId, $courseId, $options);
            
            if (!$certificatePath) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se pudo generar el certificado'
                ], 500);
            }
            
            // Create certificate record in database
            $certificateId = 'CERT-' . uniqid();
            $filename = basename($certificatePath);
            
            MoodleCertificate::create([
                'user_id' => $userId,
                'course_id' => $courseId,
                'certificate_id' => $certificateId,
                'filename' => $filename,
                'issued_at' => now(),
                'verified' => true,
                'metadata' => $options
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Certificado generado correctamente',
                'certificate_id' => $certificateId,
                'filename' => $filename
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al generar certificado: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Download a certificate.
     *
     * @param string $filename
     * @return \Illuminate\Http\Response
     */
    public function download($filename)
    {
        try {
            // Get certificate from database
            $certificate = MoodleCertificate::where('filename', $filename)->firstOrFail();
            
            // Get certificate file path
            $filePath = $this->certificateService->downloadCertificate($filename);
            
            // Return file download response
            return Response::download($filePath, $filename, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al descargar certificado: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verify a certificate.
     *
     * @param string $certificateId
     * @return \Illuminate\Http\Response
     */
    public function verify($certificateId)
    {
        try {
            // Find certificate in database
            $certificate = MoodleCertificate::where('certificate_id', $certificateId)->first();
            
            if (!$certificate) {
                return view('moodle::certificates.verification', [
                    'verified' => false,
                    'message' => 'Certificado no encontrado'
                ]);
            }
            
            return view('moodle::certificates.verification', [
                'verified' => true,
                'certificate' => $certificate,
                'user' => $certificate->user,
                'course' => $certificate->course
            ]);
        } catch (Exception $e) {
            return view('moodle::certificates.verification', [
                'verified' => false,
                'message' => 'Error al verificar certificado: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the certificate template preview.
     *
     * @return \Illuminate\Http\Response
     */
    public function templatePreview()
    {
        return view('moodle::certificates.template_preview');
    }
}
