<?php

namespace App\Http\Controllers\Cursos;

use App\Http\Controllers\Controller;
use App\Models\Cursos\Category;
use App\Models\Cursos\Cursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CursosController extends Controller
{
    public function index()
    {
        $servicios = Cursos::paginate(2);
        
        // Estadísticas para la vista
        $totalCursos = Cursos::count();
        $cursosPublicados = Cursos::where('published', 1)->count();
        $cursosBorrador = Cursos::where('published', 0)->count();
        $totalCategorias = Category::where('inactive', 0)->count();
        $categorias = Category::where('inactive', 0)->get();
        
        return view('crm.cursos.index', compact('servicios', 'totalCursos', 'cursosPublicados', 'cursosBorrador', 'totalCategorias', 'categorias'));
    }

    public function create() {
        $categorias = Category::where('inactive',0)->get();
        return view('crm.cursos.create', compact('categorias'));
    }

    public function show(string $id) {
        $curso = Cursos::with('alumnos')->find($id);
        if (!$curso) {
            session()->flash('toast', [
                'icon' => 'error',
                'mensaje' => 'El curso no existe'
            ]);
            return redirect()->route('cursos.index');
        }
        return view('crm.cursos.show', compact('curso'));
    }


    public function store(Request $request) {
        // Validamos los campos
        $data = $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required',
            'category_id' => 'required',
            'inactive' => 'nullable',
            'published' => 'nullable',
            'description' => 'nullable',
            'inicio' => 'nullable',
            'duracion' => 'nullable',
            'plazas' => 'nullable',
            'lecciones' => 'nullable',
            'certificado' => 'nullable',

        ], [
            'name.required' => 'El nombre es requerido para continuar',
            'name.max' => 'El nombre no pueder tener mas de 255 caracteres',
            'category_id.required' => 'La categoria es requerida para continuar',
            'price.required' => 'El precio es requerido para continuar',
        ]);

        // Manejar checkboxes
        if(!isset($data['inactive'])){
            $data['inactive'] = 0;
        }
        if(!isset($data['published'])){
            $data['published'] = 0;
        }

        if($request->hasFile('image')){
            $imagen = $request->file('image')->store('public/products');
            $data['image'] = Storage::url($imagen);
        }

        $servicioCreado = Cursos::create($data);

        return redirect()->route('cursos.edit', $servicioCreado->id)->with('toast', [
                'icon' => 'success',
                'mensaje' => 'El servicio creado con exito'
        ]);
    }

    public function edit(string $id){
        $curso = Cursos::find($id);
        $categorias = Category::where('inactive',0)->get();
        if (!$curso) {
            session()->flash('toast', [
                'icon' => 'error',
                'mensaje' => 'El curso no existe'
            ]);
            return redirect()->route('cursos.index');
        }
        return view('crm.cursos.edit', compact('curso','categorias'));
    }

    public function update(string $id ,Request $request) {
        $servicio = Cursos::find($id);

        $data = $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required',
            'category_id' => 'required',
            'inactive' => 'nullable',
            'published' => 'nullable',
            'description' => 'nullable',
            'inicio' => 'nullable',
            'duracion' => 'nullable',
            'plazas' => 'nullable',
            'lecciones' => 'nullable',
            'certificado' => 'nullable',
        ], [
            'name.required' => 'El nombre es requerido para continuar',
            'name.max' => 'El nombre no pueder tener mas de 255 caracteres',
            'category_id.required' => 'La categoria es requerida para continuar',
            'price.required' => 'El precio es requerido para continuar',
        ]);

        // Manejar checkboxes
        if(!isset($data['inactive'])){
            $data['inactive'] = 0;
        }
        if(!isset($data['published'])){
            $data['published'] = 0;
        }

        if($request->hasFile('image')){
            $imagen = $request->file('image')->store('public/products');
            $data['image'] = Storage::url($imagen);
        }
        $petitionCreado = $servicio->update($data);

        return redirect()->route('cursos.index')->with('toast', [
                'icon' => 'success',
                'mensaje' => 'El servicio actualizado con exito'
        ]);
    }

    public function destroy(Request $request) {
        $servicio = Cursos::find($request->id);

        if (!$servicio) {
            return response()->json([
                'error' => true,
                'mensaje' => "Error en el servidor, intentelo mas tarde."
            ]);
        }

        $servicio->delete();

        return response()->json([
            'error' => false,
            'mensaje' => 'El servicio fue borrado correctamente'
        ]);
    }



}
