<?php

namespace App\Http\Controllers\Builder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class BuilderController extends Controller
{
    public function index(Request $request)
    {
        $views = collect(File::files(resource_path('views/webacademia/pages')))
        ->filter(fn($f) => $f->getExtension() === 'php')
        ->mapWithKeys(function ($file) {
            $relative = str_replace('.blade.php', '', $file->getFilename());
            return ["webacademia/pages/$relative" => ucfirst($relative)];
        })->toArray();

        $currentView = $request->get('view', 'webacademia/pages/index');

        // Extraer solo el nombre del archivo
        $viewName = str_replace('webacademia/pages/', '', $currentView);
        $viewPath = resource_path("views/webacademia/pages/{$viewName}.blade.php");
        
        // Leer el archivo directamente en lugar de renderizarlo con el layout
        $html = '';
        $initialCss = '';
        if (File::exists($viewPath)) {
            $content = File::get($viewPath);
            
            // Extraer CSS del bloque <style> antes de removerlo
            if (preg_match('/<style>(.*?)<\/style>/s', $content, $styleMatches)) {
                $extractedCss = $styleMatches[1];
                
                // Si no tiene el comentario "CSS generado por el editor", es CSS original
                if (strpos($extractedCss, 'CSS generado por el editor') === false) {
                    // Es CSS original, guardarlo para añadirlo al editor
                    $initialCss = trim($extractedCss);
                    
                    // Limpiar URLs de SVG problemáticas que pueden causar errores
                    // Reemplazar URLs de data:image/svg+xml con una versión más simple
                    $initialCss = preg_replace(
                        '/background:\s*url\([\'"]?data:image\/svg\+xml[^\'"]*[\'"]?\)/i',
                        'background: transparent; /* SVG background removed for builder compatibility */',
                        $initialCss
                    );
                } else {
                    // Ya tiene CSS del editor, extraer solo el CSS personalizado si existe
                    if (preg_match('/\/\*\s*CSS Personalizado\s*\*\/(.*?)$/s', $extractedCss, $customMatches)) {
                        $initialCss = trim($customMatches[1]);
                    }
                }
            }
            
            $html = $content;
            
            // Remover bloques <style> del HTML para que GrapesJS lo procese correctamente
            $html = preg_replace('/<style>.*?<\/style>/s', '', $html);
            
            // Remover scripts que puedan interferir
            $html = preg_replace('/<script.*?<\/script>/s', '', $html);
            
            // Remover comentarios HTML
            $html = preg_replace('/<!--.*?-->/s', '', $html);
            
            // Limpiar atributos problemáticos que pueden causar errores en GrapesJS
            // Remover atributos data-wow-* que pueden causar problemas
            $html = preg_replace('/\s*data-wow-[^=]*=["\'][^"\']*["\']/i', '', $html);
            
            // Limpiar atributos SVG problemáticos que causan el error InvalidCharacterError
            // Remover atributos con comillas escapadas mal formadas
            $html = preg_replace('/\s+svg\\\"[^=]*=["\'][^"\']*["\']/i', '', $html);
            
            // Asegurar que los atributos estén bien formados
            // Remover atributos vacíos o mal formados
            $html = preg_replace('/\s+=\s*["\']\s*["\']/', '', $html);
            
            $html = trim($html);
            
            // Si el HTML está vacío después de limpiar, usar contenido por defecto
            if (empty($html) || strlen($html) < 10) {
                $html = '<div class="container"><h1>Vista nueva</h1><p>Contenido inicial...</p></div>';
            }
        } else {
            // Si no existe, crear contenido por defecto
            $html = '<div class="container"><h1>Vista nueva</h1><p>Contenido inicial...</p></div>';
        }

        return view('builder.builder', [
            'views' => $views,
            'currentView' => $currentView,
            'html' => $html,
            'initialCss' => $initialCss ?? ''
        ]);

    }

    public function load(Request $request)
    {
        $view = $request->get('view');
        
        if (!$view) {
            return response()->json(['error' => 'No se especificó la vista'], 400);
        }
        
        // Extraer solo el nombre del archivo si viene la ruta completa
        // Si viene "webacademia/pages/index", extraer solo "index"
        // Si viene "webacademia%2Fpages%2Findex" (codificado), decodificar primero
        $view = urldecode($view);
        
        if (strpos($view, '/') !== false) {
            $viewParts = explode('/', $view);
            $view = end($viewParts);
        }
        
        // Limpiar el nombre del archivo (remover espacios, caracteres especiales)
        $view = preg_replace('/[^a-zA-Z0-9_-]/', '', $view);
        
        if (empty($view)) {
            return response()->json(['error' => 'Nombre de vista inválido'], 400);
        }
        
        $path = resource_path("views/webacademia/pages/{$view}.blade.php");

        if (!File::exists($path)) {
            return response()->json([
                'error' => 'Vista no encontrada: ' . $view,
                'html' => '',
                'custom_css' => ''
            ], 404);
        }

        $content = File::get($path);
        
        // Extraer CSS personalizado y HTML
        $customCss = '';
        $html = $content;
        
        // Buscar y extraer CSS personalizado
        if (preg_match('/<style>(.*?)<\/style>/s', $content, $matches)) {
            $allCss = $matches[1];
            
            // Separar CSS del editor del CSS personalizado
            if (preg_match('/\/\*\s*CSS generado por el editor\s*\*\/(.*?)(?:\/\*\s*CSS Personalizado|$)/s', $allCss, $editorMatches)) {
                // Hay CSS del editor, extraer solo el CSS personalizado
                if (preg_match('/\/\*\s*CSS Personalizado\s*\*\/(.*?)$/s', $allCss, $customMatches)) {
                    $customCss = trim($customMatches[1]);
                }
            } else {
                // No hay comentario de CSS del editor, todo el CSS es personalizado
                // Solo si no tiene el comentario "CSS generado por el editor"
                if (strpos($allCss, 'CSS generado por el editor') === false) {
                    $customCss = trim($allCss);
                } else {
                    // Hay CSS del editor, extraer solo el CSS personalizado
                    if (preg_match('/\/\*\s*CSS Personalizado\s*\*\/(.*?)$/s', $allCss, $customMatches)) {
                        $customCss = trim($customMatches[1]);
                    }
                }
            }
            
            // Remover el bloque <style> completo del HTML
            $html = preg_replace('/<style>.*?<\/style>/s', '', $content);
            $html = trim($html);
        }
        
        return response()->json([
            'html' => $html,
            'custom_css' => $customCss
        ]);
    }

    public function save(Request $request)
    {
         $data = json_decode($request->getContent(), true);
        $view = $request->get('view');
        $html = $data['html'] ?? '';
        $css  = $data['css'] ?? '';
        $customCss = $data['custom_css'] ?? '';

        if (!$view) {
            return response()->json(['error' => 'No se especificó la vista'], 400);
        }

        // Si viene la ruta completa, construir la ruta completa
        // Si viene solo el nombre, usar la ruta por defecto
        if (strpos($view, 'webacademia/pages/') === 0) {
            $path = resource_path("views/{$view}.blade.php");
        } else {
            // Si viene solo el nombre, añadir la ruta
            $path = resource_path("views/webacademia/pages/{$view}.blade.php");
        }

        if (!File::exists($path)) {
            return response()->json(['error' => 'Vista no encontrada'], 404);
        }

        // Validaciones de seguridad
        $html = $this->sanitizeHtml($html);
        $css = $this->sanitizeCss($css);
        $customCss = $this->sanitizeCss($customCss);
        
        // Construir el HTML final con CSS separado
        $styleBlocks = [];
        
        // CSS generado por el editor
        if (!empty($css)) {
            $styleBlocks[] = "/* CSS generado por el editor */\n{$css}";
        }
        
        // CSS personalizado (si existe)
        if (!empty($customCss)) {
            $styleBlocks[] = "/* CSS Personalizado */\n{$customCss}";
        }
        
        // Crear backup antes de guardar
        $this->createBackup($path, $view);
        
        // Combinar todos los estilos
        $allCss = implode("\n\n", $styleBlocks);
        
        // Inserta el CSS en un <style> al principio del HTML
        $finalHtml = !empty($allCss) 
            ? "<style>\n{$allCss}\n</style>\n\n{$html}"
            : $html;

        File::put($path, $finalHtml);

        return response()->json(['status' => 'ok']);
    }

    public function upload(Request $request)
    {
        $files = $request->file('file'); // será un array de UploadedFile
        if (!$files || !is_array($files)) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        $urls = [];

        foreach ($files as $file) {
            $mime = $file->getMimeType();
            $folder = str_starts_with($mime, 'video/') ? 'videos' : 'images';
            
            // Guardar directamente en storage/app/public/images o videos
            // Usar el disco 'public' para asegurar que se guarde en la ubicación correcta
            $path = $file->store($folder, 'public');
            
            // La ruta será "images/archivo.png" o "videos/archivo.mp4"
            // Generar la URL usando asset con storage/
            $url = asset("storage/$path");
            $urls[] = $url;
        }

        return response()->json(['data' => $urls]);
    }

    public function create(Request $request)
    {
         $viewName = $request->input('new_view');
        $path = resource_path("views/webacademia/pages/{$viewName}.blade.php");

        if (File::exists($path)) {
            return redirect()->back()->withErrors(['error' => 'La vista ya existe']);
        }

        File::put($path, '<div class="container"><h1>Vista nueva</h1><p>Contenido inicial...</p></div>');

        return redirect()->route('builder', ['view' => "webacademia/pages/{$viewName}"]);
    }

    public function seo($view)
    {
        $seoPath = resource_path("views/webacademia/seo/seo_{$view}.blade.php");
        $content = File::exists($seoPath) ? File::get($seoPath) : '';

        return view('builder.seo_editor', compact('view', 'content'));
    }

    public function saveSeo(Request $request)
    {
        $view = $request->input('view');
        $content = $request->input('seo_content');

        if (!$view) {
            return back()->withErrors(['view' => 'Vista no especificada']);
        }

        $seoPath = resource_path("views/webacademia/seo/seo_{$view}.blade.php");
        File::put($seoPath, $content);

        return redirect()->route('builder.seo', ['view' => $view])->with('status', 'SEO guardado correctamente');
    }

    public function duplicate(Request $request)
    {
        $sourceView = $request->input('source_view');
        $newViewName = $request->input('new_view_name');

        if (!$sourceView || !$newViewName) {
            return response()->json(['error' => 'Vista origen y nombre nuevo son requeridos'], 400);
        }

        // Validar que el nombre nuevo no esté vacío y sea válido
        $newViewName = preg_replace('/[^a-z0-9_]/', '', strtolower($newViewName));
        if (empty($newViewName)) {
            return response()->json(['error' => 'El nombre de la vista no es válido'], 400);
        }

        // Ruta de la vista origen
        $sourcePath = resource_path("views/webacademia/pages/{$sourceView}.blade.php");
        
        // Verificar que la vista origen existe
        if (!File::exists($sourcePath)) {
            return response()->json(['error' => 'La vista origen no existe'], 404);
        }

        // Ruta de la nueva vista
        $newPath = resource_path("views/webacademia/pages/{$newViewName}.blade.php");

        // Verificar que la nueva vista no exista ya
        if (File::exists($newPath)) {
            return response()->json(['error' => 'Ya existe una vista con ese nombre'], 409);
        }

        // Leer el contenido de la vista origen
        $content = File::get($sourcePath);

        // Crear la nueva vista con el contenido copiado
        File::put($newPath, $content);

        return response()->json([
            'status' => 'ok',
            'message' => 'Vista duplicada correctamente',
            'new_view' => "webacademia/pages/{$newViewName}"
        ]);
    }

    /**
     * Sanitizar HTML para prevenir XSS
     */
    private function sanitizeHtml($html)
    {
        if (empty($html)) {
            return $html;
        }

        // Permitir solo tags HTML seguros
        $allowedTags = '<div><span><p><h1><h2><h3><h4><h5><h6><a><img><ul><ol><li><strong><em><b><i><u><br><hr><table><thead><tbody><tr><td><th><section><article><header><footer><nav><aside><main>';
        
        // Limpiar HTML pero mantener estructura
        $html = strip_tags($html, $allowedTags);
        
        // Remover atributos peligrosos como onclick, onerror, etc.
        $html = preg_replace('/\s*on\w+\s*=\s*["\'][^"\']*["\']/i', '', $html);
        $html = preg_replace('/\s*on\w+\s*=\s*[^\s>]*/i', '', $html);
        
        // Remover javascript: en href
        $html = preg_replace('/href\s*=\s*["\']javascript:[^"\']*["\']/i', 'href="#"', $html);
        
        // Remover atributos data-wow-* que pueden causar problemas en GrapesJS
        $html = preg_replace('/\s*data-wow-[^=]*=["\'][^"\']*["\']/i', '', $html);
        
        // Limpiar atributos mal formados o vacíos que pueden causar errores
        $html = preg_replace('/\s+=\s*["\']\s*["\']/', '', $html);
        $html = preg_replace('/\s+=\s*["\']\s*["\']/', '', $html);
        
        // Asegurar que no haya atributos con nombres numéricos (como "0")
        // Esto puede causar el error InvalidCharacterError
        $html = preg_replace('/\s+0\s*=\s*["\'][^"\']*["\']/', '', $html);
        $html = preg_replace('/\s+0\s*=\s*[^\s>]*/', '', $html);
        
        return $html;
    }

    /**
     * Sanitizar CSS para prevenir inyección
     */
    private function sanitizeCss($css)
    {
        if (empty($css)) {
            return $css;
        }

        // Remover expresiones peligrosas
        $dangerousPatterns = [
            '/expression\s*\(/i',
            '/javascript\s*:/i',
            '/@import/i',
            '/behavior\s*:/i',
            '/-moz-binding/i',
            '/<!--/',
            '/-->/',
        ];

        foreach ($dangerousPatterns as $pattern) {
            $css = preg_replace($pattern, '', $css);
        }

        // Validar que solo contenga CSS válido (básico)
        // Permitir comentarios, selectores, propiedades, valores
        $css = preg_replace('/[^a-zA-Z0-9\s\.#\-_:;{}\[\]()\/\*"\'!@$%&+=,<>?|~`]/', '', $css);
        
        return $css;
    }

    /**
     * Crear backup de la vista antes de guardar
     */
    private function createBackup($filePath, $view)
    {
        if (!File::exists($filePath)) {
            return;
        }

        // Crear directorio de backups si no existe
        $backupDir = storage_path('app/builder_backups');
        if (!File::exists($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
        }

        // Leer contenido actual
        $content = File::get($filePath);
        
        // Generar nombre de backup con timestamp
        $viewName = str_replace(['webacademia/pages/', '/'], ['', '_'], $view);
        $timestamp = date('Y-m-d_H-i-s');
        $backupFileName = "{$viewName}_{$timestamp}.blade.php";
        $backupPath = "{$backupDir}/{$backupFileName}";
        
        // Guardar backup
        File::put($backupPath, $content);
        
        // Limpiar backups antiguos (mantener solo los últimos 10)
        $this->cleanOldBackups($backupDir, $viewName);
    }

    /**
     * Limpiar backups antiguos, manteniendo solo los últimos N
     */
    private function cleanOldBackups($backupDir, $viewName, $keepCount = 10)
    {
        $backups = collect(File::glob("{$backupDir}/{$viewName}_*.blade.php"))
            ->map(function ($file) {
                return [
                    'path' => $file,
                    'time' => File::lastModified($file)
                ];
            })
            ->sortByDesc('time')
            ->values();

        // Eliminar backups que excedan el límite
        if ($backups->count() > $keepCount) {
            $toDelete = $backups->slice($keepCount);
            foreach ($toDelete as $backup) {
                File::delete($backup['path']);
            }
        }
    }
}
