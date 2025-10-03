<?php

namespace App\Http\Controllers\Cursos;

use App\Http\Controllers\Controller;
use App\Models\Cursos\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CursosCategoriesController extends Controller
{
    public function index()
    {
        // Estadísticas para la vista
        $totalCategorias = Category::count();
        $totalCursos = \App\Models\Cursos\Cursos::count();
        $categoriasActivas = Category::where('inactive', 0)->count();
        
        // Obtener categorías paginadas para la paginación
        $categorias = Category::paginate(10);
        
        return view('crm.cursos-categories.index', compact('totalCategorias', 'totalCursos', 'categoriasActivas', 'categorias'));
    }

    public function create() {
        return view('crm.cursos-categories.create');
    }

    public function show(string $id) {
        $categoria = Category::find($id);
        if (!$categoria) {
            session()->flash('toast', [
                'icon' => 'error',
                'mensaje' => 'La categoría no existe'
            ]);
            return redirect()->route('cursosCategoria.index');
        }
        return view('crm.cursos-categories.show', compact('categoria'));
    }

    public function store(Request $request) {
        // Validamos los campos
        $data = $this->validate($request, [
            'name' => 'required|max:255',
            'inactive' => 'nullable',
        ], [
            'name.required' => 'El nombre es requerido para continuar',
            'name.max' => 'El nombre no pueder tener mas de 255 caracteres',
        ]);


        if($request->hasFile('image')){
            $imagen = $request->file('image')->store('public/categories');
            $data['image'] = Storage::url($imagen);
        }
        $categoriaCreada = Category::create($data);

        if($categoriaCreada){
            return redirect()->route('productosCategoria.edit', $categoriaCreada->id)->with('toast', [
                    'icon' => 'success',
                    'mensaje' => 'El categoria creada con exito'
            ]);
        }else{
            return redirect()->back()->with('toast', [
                'icon' => 'error',
                'mensaje' => 'Error en la creacion de la categoria'
            ]);
        }

    }

    public function edit(string $id){
        $categoria = Category::find($id);
        if (!$categoria) {
            session()->flash('toast', [
                'icon' => 'error',
                'mensaje' => 'La categoria no existe'
            ]);
            return redirect()->route('productosCategoria.index');
        }
        return view('crm.cursos-categories.edit', compact('categoria'));
    }

    public function update(string $id ,Request $request) {
        $categoria = Category::find($id);
        $data = $this->validate($request, [
            'name' => 'required|max:255',
            'inactive' => 'nullable'
        ], [
            'name.required' => 'El nombre es requerido para continuar',
            'name.max' => 'El nombre no pueder tener mas de 255 caracteres',
        ]);

        if($request->hasFile('image')){
            $imagen = $request->file('image')->store('public/categories');
            $data['image'] = Storage::url($imagen);
        }

        $categoriaCreada = $categoria->update($data);

        return redirect()->route('productosCategoria.index')->with('toast', [
                'icon' => 'success',
                'mensaje' => 'El servicio actualizado con exito'
        ]);
    }

    public function destroy(Request $request) {
        $servicio = Category::find($request->id);

        if (!$servicio) {
            return response()->json([
                'error' => true,
                'mensaje' => "Error en el servidor, intentelo mas tarde."
            ]);
        }

        $servicio->delete();

        return response()->json([
            'error' => false,
            'mensaje' => 'La categoria de servicio fue borrada correctamente'
        ]);
    }


}
