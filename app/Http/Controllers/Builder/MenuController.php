<?php

namespace App\Http\Controllers\Builder;

use App\Http\Controllers\Controller;
use App\Models\Web\WebMenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{
    /**
     * Obtener todos los items del menú
     */
    public function index()
    {
        $items = WebMenuItem::orderBy('order')->get();
        return response()->json($items);
    }

    /**
     * Crear un nuevo item del menú
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'parent_id' => 'nullable|exists:web_menu_items,id',
            'active' => 'boolean',
            'target' => 'nullable|string|in:_self,_blank',
            'icon' => 'nullable|string|max:255',
        ]);

        // Si no se especifica orden, usar el último + 1
        if (!isset($validated['order'])) {
            $maxOrder = WebMenuItem::max('order') ?? 0;
            $validated['order'] = $maxOrder + 1;
        }

        $item = WebMenuItem::create($validated);

        return response()->json([
            'status' => 'ok',
            'message' => 'Item del menú creado correctamente',
            'item' => $item
        ]);
    }

    /**
     * Actualizar un item del menú
     */
    public function update(Request $request, $id)
    {
        $item = WebMenuItem::findOrFail($id);

        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'parent_id' => 'nullable|exists:web_menu_items,id',
            'active' => 'boolean',
            'target' => 'nullable|string|in:_self,_blank',
            'icon' => 'nullable|string|max:255',
        ]);

        // Evitar que un item sea su propio padre
        if (isset($validated['parent_id']) && $validated['parent_id'] == $id) {
            return response()->json([
                'error' => 'Un item no puede ser su propio padre'
            ], 400);
        }

        $item->update($validated);

        return response()->json([
            'status' => 'ok',
            'message' => 'Item del menú actualizado correctamente',
            'item' => $item->fresh()
        ]);
    }

    /**
     * Eliminar un item del menú
     */
    public function destroy($id)
    {
        $item = WebMenuItem::findOrFail($id);
        
        // Eliminar también los hijos (cascade)
        $item->delete();

        return response()->json([
            'status' => 'ok',
            'message' => 'Item del menú eliminado correctamente'
        ]);
    }

    /**
     * Reordenar items del menú
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:web_menu_items,id',
            'items.*.order' => 'required|integer',
        ]);

        DB::transaction(function () use ($validated) {
            foreach ($validated['items'] as $itemData) {
                WebMenuItem::where('id', $itemData['id'])
                    ->update(['order' => $itemData['order']]);
            }
        });

        return response()->json([
            'status' => 'ok',
            'message' => 'Orden actualizado correctamente'
        ]);
    }

    /**
     * Obtener las páginas disponibles para seleccionar en el menú
     */
    public function getAvailablePages()
    {
        $pages = collect(\File::files(resource_path('views/webacademia/pages')))
            ->filter(fn($f) => $f->getExtension() === 'php')
            ->map(function ($file) {
                $name = str_replace('.blade.php', '', $file->getFilename());
                return [
                    'name' => $name,
                    'url' => "/web/{$name}",
                    'label' => ucfirst(str_replace('_', ' ', $name))
                ];
            })
            ->values()
            ->toArray();

        // Añadir rutas comunes
        $commonRoutes = [
            ['name' => 'index', 'url' => '/web/index', 'label' => 'Inicio'],
            ['name' => 'course', 'url' => '/course', 'label' => 'Cursos'],
            ['name' => 'blog', 'url' => '/blog', 'label' => 'Noticias'],
            ['name' => 'contact', 'url' => '/contact', 'label' => 'Contacta'],
        ];

        return response()->json([
            'pages' => $pages,
            'common_routes' => $commonRoutes
        ]);
    }
}
