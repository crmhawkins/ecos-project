<?php

namespace App\Http\Controllers\Builder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;

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
                    // Ya tiene CSS del editor, extraer TODO el CSS (del editor + personalizado)
                    // para que GrapesJS pueda cargarlo correctamente
                    $initialCss = trim($extractedCss);
                    
                    // También extraer solo el CSS personalizado para el editor de CSS
                    if (preg_match('/\/\*\s*CSS Personalizado\s*\*\/(.*?)$/s', $extractedCss, $customMatches)) {
                        $customCssOnly = trim($customMatches[1]);
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

        // Decodificar el parámetro view si viene codificado
        $view = urldecode($view);
        
        // Extraer solo el nombre del archivo si viene la ruta completa
        // Si viene "webacademia/pages/about", extraer solo "about"
        if (strpos($view, '/') !== false) {
            $viewParts = explode('/', $view);
            $view = end($viewParts);
        }
        
        // Si viene "webacademia/pages/about", extraer solo "about"
        if (strpos($view, 'webacademia/pages/') !== false) {
            $view = str_replace('webacademia/pages/', '', $view);
        }
        
        // Limpiar el nombre del archivo (remover espacios, caracteres especiales, pero mantener guiones y guiones bajos)
        $view = preg_replace('/[^a-zA-Z0-9_-]/', '', $view);
        
        if (empty($view)) {
            return response()->json(['error' => 'Nombre de vista inválido'], 400);
        }

        // Construir la ruta completa
        $path = resource_path("views/webacademia/pages/{$view}.blade.php");

        if (!File::exists($path)) {
            return response()->json([
                'error' => 'Vista no encontrada',
                'debug' => [
                    'view_param' => $request->get('view'),
                    'decoded_view' => $view,
                    'path' => $path,
                    'exists' => File::exists($path)
                ]
            ], 404);
        }

        // Validaciones de seguridad
        $html = $this->sanitizeHtml($html);
        $css = $this->sanitizeCss($css);
        $customCss = $this->sanitizeCss($customCss);
        
        // Limpiar el HTML: remover etiquetas <body>, <html>, <!DOCTYPE> si existen
        // El archivo Blade solo debe contener el contenido del body, no las etiquetas
        $html = preg_replace('/<!DOCTYPE[^>]*>/i', '', $html);
        $html = preg_replace('/<html[^>]*>/i', '', $html);
        $html = preg_replace('/<\/html>/i', '', $html);
        
        // Extraer el contenido interno de <body> si existe
        if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $html, $bodyMatches)) {
            $html = $bodyMatches[1];
        } else {
            // Si no hay <body>, remover cualquier etiqueta <body> suelta
            $html = preg_replace('/<body[^>]*>/i', '', $html);
            $html = preg_replace('/<\/body>/i', '', $html);
        }
        
        $html = trim($html);
        
        // Construir el HTML final con CSS separado
        $styleBlocks = [];
        
        // CSS generado por el editor
        // Aumentar especificidad para que los estilos se apliquen correctamente
        if (!empty($css)) {
            // Aumentar especificidad añadiendo !important a propiedades críticas
            // y envolver en un selector más específico
            $cssWithSpecificity = preg_replace(
                '/(border-radius|object-fit|object-position|width|height):\s*([^;]+);/i',
                '$1: $2 !important;',
                $css
            );
            $styleBlocks[] = "/* CSS generado por el editor */\n{$cssWithSpecificity}";
            
            // Sobrescribir estilos problemáticos del style.css
            // Remover padding-right de .ab_img img que interfiere con el diseño
            // Usar selector más específico y añadir al final para máxima prioridad
            $styleBlocks[] = "/* Sobrescribir estilos del theme - Máxima prioridad */\nbody .ab_img img,\nbody .ab_img > img,\nbody section .ab_img img,\nbody .container .ab_img img,\nbody .row .ab_img img { padding-right: 0 !important; padding-left: 0 !important; margin-right: 0 !important; }";
        }
        
        // CSS personalizado (si existe)
        if (!empty($customCss)) {
            $styleBlocks[] = "/* CSS Personalizado */\n{$customCss}";
        }
        
        // SIEMPRE añadir la sobrescritura de .ab_img img al final, incluso si no hay CSS del editor
        // Esto asegura que siempre se sobrescriba el padding del style.css
        // Usar selectores muy específicos y múltiples para máxima prioridad
        $styleBlocks[] = "/* Sobrescribir estilos del theme - SIEMPRE aplicar - MÁXIMA PRIORIDAD */\nhtml body .ab_img img,\nhtml body .ab_img > img,\nhtml body section .ab_img img,\nhtml body .container .ab_img img,\nhtml body .row .ab_img img,\nhtml body .col-lg-6 .ab_img img,\nhtml body .col-sm-12 .ab_img img,\nhtml body .wow.fadeInUp .ab_img img { padding-right: 0 !important; padding-left: 0 !important; margin-right: 0 !important; margin-left: 0 !important; }";
        
        // Crear backup antes de guardar
        $this->createBackup($path, $view);
        
        // Combinar todos los estilos
        $allCss = implode("\n\n", $styleBlocks);
        
        // Extraer el bloque <style> si existe en el HTML actual y combinarlo
        // Luego insertar el CSS en un <style> al principio del HTML
        // IMPORTANTE: El CSS debe estar ANTES del <body> para que se aplique correctamente
        if (!empty($allCss)) {
            // Si el HTML ya tiene un bloque <style>, extraerlo y combinarlo
            if (preg_match('/<style>(.*?)<\/style>/s', $html, $existingStyle)) {
                // Remover el estilo existente del HTML
                $html = preg_replace('/<style>.*?<\/style>/s', '', $html);
            }
            
            // Insertar el CSS al principio del HTML (antes de cualquier contenido)
            $finalHtml = "<style>\n{$allCss}\n</style>\n\n{$html}";
        } else {
            $finalHtml = $html;
        }

        // Log para debugging (solo en desarrollo)
        if (config('app.debug')) {
            \Log::info('Builder Save', [
                'view' => $view,
                'path' => $path,
                'css_length' => strlen($allCss),
                'html_length' => strlen($html),
                'has_border_radius' => strpos($allCss, 'border-radius') !== false || strpos($html, 'border-radius') !== false
            ]);
        }

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

    /**
     * Listar imágenes y videos existentes para el assetManager
     */
    public function listAssets()
    {
        $assets = [];
        
        // Obtener imágenes de storage/app/public/images
        $imagesPath = storage_path('app/public/images');
        if (File::exists($imagesPath)) {
            $imageFiles = File::files($imagesPath);
            foreach ($imageFiles as $file) {
                $assets[] = [
                    'src' => asset('storage/images/' . $file->getFilename()),
                    'type' => 'image'
                ];
            }
        }
        
        // Obtener videos de storage/app/public/videos
        $videosPath = storage_path('app/public/videos');
        if (File::exists($videosPath)) {
            $videoFiles = File::files($videosPath);
            foreach ($videoFiles as $file) {
                $assets[] = [
                    'src' => asset('storage/videos/' . $file->getFilename()),
                    'type' => 'video'
                ];
            }
        }
        
        return response()->json(['data' => $assets]);
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

    /**
     * Eliminar una vista de webacademia/pages con comprobaciones básicas.
     */
    public function delete(Request $request)
    {
        $viewName = $request->input('view');

        if (!$viewName) {
            return response()->json(['error' => 'Vista no especificada'], 400);
        }

        // Normalizar: si viene "webacademia/pages/index", quedarnos solo con "index"
        $viewName = urldecode($viewName);
        if (strpos($viewName, '/') !== false) {
            $parts = explode('/', $viewName);
            $viewName = end($parts);
        }

        // Proteger vistas críticas
        $protected = ['index', 'footer'];
        if (in_array($viewName, $protected, true)) {
            return response()->json(['error' => 'Esta vista no se puede borrar desde el editor'], 403);
        }

        $path = resource_path("views/webacademia/pages/{$viewName}.blade.php");
        if (!File::exists($path)) {
            return response()->json(['error' => 'La vista no existe'], 404);
        }

        // TODO opcional: comprobar si está en el menú antes de borrar

        File::delete($path);

        return response()->json(['status' => 'ok']);
    }

    public function seo($view)
    {
        $seoPath = resource_path("views/webacademia/seo/seo_{$view}.blade.php");
        $content = File::exists($seoPath) ? File::get($seoPath) : '';

        $seo = [
            'title' => '',
            'description' => '',
            'keywords' => '',
            'canonical' => '',
            'robots' => '',
            'og_title' => '',
            'og_description' => '',
        ];

        if (!empty($content)) {
            if (preg_match('/<title>(.*?)<\/title>/s', $content, $m)) {
                $seo['title'] = trim($m[1]);
            }
            if (preg_match('/<meta\s+name=["\']description["\']\s+content=["\'](.*?)["\']/si', $content, $m)) {
                $seo['description'] = trim($m[1]);
            }
            if (preg_match('/<meta\s+name=["\']keywords["\']\s+content=["\'](.*?)["\']/si', $content, $m)) {
                $seo['keywords'] = trim($m[1]);
            }
            if (preg_match('/<link\s+rel=["\']canonical["\']\s+href=["\'](.*?)["\']/si', $content, $m)) {
                $seo['canonical'] = trim($m[1]);
            }
            if (preg_match('/<meta\s+name=["\']robots["\']\s+content=["\'](.*?)["\']/si', $content, $m)) {
                $seo['robots'] = trim($m[1]);
            }
            if (preg_match('/<meta\s+property=["\']og:title["\']\s+content=["\'](.*?)["\']/si', $content, $m)) {
                $seo['og_title'] = trim($m[1]);
            }
            if (preg_match('/<meta\s+property=["\']og:description["\']\s+content=["\'](.*?)["\']/si', $content, $m)) {
                $seo['og_description'] = trim($m[1]);
            }
        }

        return view('builder.seo_editor', compact('view', 'seo'));
    }

    public function saveSeo(Request $request)
    {
        $data = $request->validate([
            'view' => 'required|string',
            'title' => 'nullable|string|max:60',
            'description' => 'nullable|string|max:160',
            'keywords' => 'nullable|string|max:255',
            'canonical' => 'nullable|string|max:255',
            'robots' => 'nullable|string|max:50',
            'og_title' => 'nullable|string|max:60',
            'og_description' => 'nullable|string|max:160',
        ]);

        $view = $data['view'];

        $lines = [];
        if (!empty($data['title'])) {
            $lines[] = '<title>'.e($data['title']).'</title>';
        }
        if (!empty($data['description'])) {
            $lines[] = '<meta name="description" content="'.e($data['description']).'">';
        }
        if (!empty($data['keywords'])) {
            $lines[] = '<meta name="keywords" content="'.e($data['keywords']).'">';
        }
        if (!empty($data['canonical'])) {
            $lines[] = '<link rel="canonical" href="'.e($data['canonical']).'">';
        }
        if (!empty($data['robots'])) {
            $lines[] = '<meta name="robots" content="'.e($data['robots']).'">';
        }
        if (!empty($data['og_title'])) {
            $lines[] = '<meta property="og:title" content="'.e($data['og_title']).'">';
        }
        if (!empty($data['og_description'])) {
            $lines[] = '<meta property="og:description" content="'.e($data['og_description']).'">';
        }

        $content = implode("\n", $lines);

        $seoPath = resource_path("views/webacademia/seo/seo_{$view}.blade.php");
        File::put($seoPath, $content);

        return redirect()->route('builder.seo', ['view' => $view])->with('status', 'SEO guardado correctamente');
    }

    /**
     * Obtener metadatos de una página (URL, SEO, etc.)
     */
    public function getPageMetadata(Request $request)
    {
        $view = $request->get('view');
        
        if (!$view) {
            return response()->json(['error' => 'No se especificó la vista'], 400);
        }
        
        // Extraer solo el nombre del archivo
        $view = urldecode($view);
        if (strpos($view, '/') !== false) {
            $viewParts = explode('/', $view);
            $view = end($viewParts);
        }
        $view = preg_replace('/[^a-zA-Z0-9_-]/', '', $view);
        
        $seoPath = resource_path("views/webacademia/seo/seo_{$view}.blade.php");
        $seo = [
            'title' => '',
            'description' => '',
            'keywords' => '',
            'canonical' => '',
            'robots' => '',
            'og_title' => '',
            'og_description' => '',
            'slug' => $view, // Por defecto el slug es el nombre de la vista
        ];
        
        if (File::exists($seoPath)) {
            $content = File::get($seoPath);
            if (preg_match('/<title>(.*?)<\/title>/s', $content, $m)) {
                $seo['title'] = trim($m[1]);
            }
            if (preg_match('/<meta\s+name=["\']description["\']\s+content=["\'](.*?)["\']/si', $content, $m)) {
                $seo['description'] = trim($m[1]);
            }
            if (preg_match('/<meta\s+name=["\']keywords["\']\s+content=["\'](.*?)["\']/si', $content, $m)) {
                $seo['keywords'] = trim($m[1]);
            }
            if (preg_match('/<link\s+rel=["\']canonical["\']\s+href=["\'](.*?)["\']/si', $content, $m)) {
                $seo['canonical'] = trim($m[1]);
            }
            if (preg_match('/<meta\s+name=["\']robots["\']\s+content=["\'](.*?)["\']/si', $content, $m)) {
                $seo['robots'] = trim($m[1]);
            }
            if (preg_match('/<meta\s+property=["\']og:title["\']\s+content=["\'](.*?)["\']/si', $content, $m)) {
                $seo['og_title'] = trim($m[1]);
            }
            if (preg_match('/<meta\s+property=["\']og:description["\']\s+content=["\'](.*?)["\']/si', $content, $m)) {
                $seo['og_description'] = trim($m[1]);
            }
            // Extraer slug de canonical si existe
            if (!empty($seo['canonical'])) {
                $parsed = parse_url($seo['canonical']);
                if (isset($parsed['path'])) {
                    $seo['slug'] = trim($parsed['path'], '/');
                }
            }
        }
        
        return response()->json($seo);
    }

    /**
     * Guardar metadatos de página incluyendo URL amigable
     */
    public function savePageMetadata(Request $request)
    {
        $data = $request->validate([
            'view' => 'required|string',
            'slug' => 'nullable|string|max:255|regex:/^[a-z0-9-]+$/',
            'title' => 'nullable|string|max:60',
            'description' => 'nullable|string|max:160',
            'keywords' => 'nullable|string|max:255',
            'canonical' => 'nullable|string|max:255',
            'robots' => 'nullable|string|max:50',
            'og_title' => 'nullable|string|max:60',
            'og_description' => 'nullable|string|max:160',
        ]);
        
        $view = $data['view'];
        $slug = $data['slug'] ?? $view;
        
        // Si se proporciona un slug, actualizar el canonical
        if (!empty($slug)) {
            $data['canonical'] = url("/web/{$slug}");
        }
        
        // Guardar usando el método existente saveSeo
        $request->merge($data);
        return $this->saveSeo($request);
    }

    /**
     * Obtener texto de cookies
     */
    public function getCookiesText()
    {
        $cookiesPath = resource_path('views/webacademia/partials/cookies_text.blade.php');
        $text = '';
        
        if (File::exists($cookiesPath)) {
            $text = File::get($cookiesPath);
            // Remover tags blade si existen
            $text = preg_replace('/@[a-zA-Z]+/i', '', $text);
            $text = preg_replace('/\{\{[^}]+\}\}/', '', $text);
        }
        
        return response()->json(['text' => $text]);
    }

    /**
     * Guardar texto de cookies
     */
    public function saveCookiesText(Request $request)
    {
        $data = $request->validate([
            'text' => 'required|string'
        ]);
        
        $cookiesPath = resource_path('views/webacademia/partials');
        
        // Crear directorio si no existe
        if (!File::exists($cookiesPath)) {
            File::makeDirectory($cookiesPath, 0755, true);
        }
        
        $filePath = $cookiesPath . '/cookies_text.blade.php';
        
        // Sanitizar el texto
        $text = strip_tags($data['text'], '<p><br><strong><em><a><ul><ol><li><h1><h2><h3><h4><h5><h6>');
        
        File::put($filePath, $text);
        
        return response()->json(['status' => 'ok', 'message' => 'Texto de cookies guardado correctamente']);
    }

    /**
     * Manejar envío de formularios avanzados desde el builder
     */
    public function handleFormSubmit(Request $request)
    {
        $data = $request->validate([
            'form_id' => 'nullable|string',
            'form_email' => 'required|email',
            'privacy_policy' => 'required|accepted'
        ]);
        
        // Obtener todos los campos del formulario excepto los de control
        $formData = $request->except(['_token', 'form_id', 'form_email', 'privacy_policy']);
        
        // Construir el mensaje del email
        $message = "Nuevo formulario enviado desde el sitio web\n\n";
        $message .= "Detalles del formulario:\n";
        $message .= str_repeat('=', 50) . "\n\n";
        
        foreach ($formData as $key => $value) {
            $label = ucfirst(str_replace('_', ' ', $key));
            $message .= "{$label}: {$value}\n";
        }
        
        $message .= "\n" . str_repeat('=', 50) . "\n";
        $message .= "Fecha: " . now()->format('d/m/Y H:i:s') . "\n";
        
        // Enviar email
        try {
            Mail::raw($message, function ($mail) use ($data) {
                $mail->to($data['form_email'])
                    ->subject('Nuevo formulario enviado desde el sitio web');
            });
            
            return response()->json([
                'status' => 'ok',
                'message' => 'Formulario enviado correctamente'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error al enviar formulario: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Error al enviar el formulario. Por favor, inténtalo de nuevo.'
            ], 500);
        }
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
     * IMPORTANTE: Preserva los atributos style y otros atributos seguros que GrapesJS genera
     */
    private function sanitizeHtml($html)
    {
        if (empty($html)) {
            return $html;
        }

        // NO usar strip_tags porque elimina todos los atributos incluyendo style
        // En su lugar, solo remover atributos peligrosos específicos
        
        // Remover atributos peligrosos como onclick, onerror, etc.
        $html = preg_replace('/\s*on\w+\s*=\s*["\'][^"\']*["\']/i', '', $html);
        $html = preg_replace('/\s*on\w+\s*=\s*[^\s>]*/i', '', $html);
        
        // Remover javascript: en href
        $html = preg_replace('/href\s*=\s*["\']javascript:[^"\']*["\']/i', 'href="#"', $html);
        
        // Remover atributos data-wow-* que pueden causar problemas en GrapesJS
        $html = preg_replace('/\s*data-wow-[^=]*=["\'][^"\']*["\']/i', '', $html);
        
        // Limpiar atributos mal formados o vacíos que pueden causar errores
        $html = preg_replace('/\s+=\s*["\']\s*["\']/', '', $html);
        
        // Asegurar que no haya atributos con nombres numéricos (como "0")
        // Esto puede causar el error InvalidCharacterError
        $html = preg_replace('/\s+0\s*=\s*["\'][^"\']*["\']/', '', $html);
        $html = preg_replace('/\s+0\s*=\s*[^\s>]*/', '', $html);
        
        // IMPORTANTE: NO remover atributos style, class, id, src, alt, href, etc.
        // Estos son necesarios para que GrapesJS funcione correctamente
        
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
