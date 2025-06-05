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

        // ✅ Renderiza la vista Blade completamente con el layout y los estilos
        $html = View::make($currentView)->render();

        return view('builder.builder', [
            'views' => $views,
            'currentView' => $currentView,
            'html' => $html
        ]);

    }

    public function load(Request $request)
    {
        $view = $request->get('view');
        $path = resource_path("views/webacademia/pages/{$view}.blade.php");

        $html = File::get($path);
        return response()->json(['html' => $html]);
    }

    public function save(Request $request)
    {
         $data = json_decode($request->getContent(), true);
        $view = $request->get('view');
        $html = $data['html'] ?? '';
        $css  = $data['css'] ?? '';

        if (!$view) {
            return response()->json(['error' => 'No se especificó la vista'], 400);
        }

        $path = resource_path("views/{$view}.blade.php");

        if (!File::exists($path)) {
            return response()->json(['error' => 'Vista no encontrada'], 404);
        }

        // Inserta el CSS en un <style> al principio del HTML
        $finalHtml = "<style>\n{$css}\n</style>\n\n{$html}";

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
            $path = $file->store("$folder");
            $url = asset(('storage/'. $path));
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
}
