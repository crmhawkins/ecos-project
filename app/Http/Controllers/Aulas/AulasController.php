<?php

namespace App\Http\Controllers\Aulas;

use App\Http\Controllers\Controller;
use App\Models\Aulas\Aulas;
use Illuminate\Http\Request;

class AulasController extends Controller
{
    public function index()
    {
        return view('crm.aulas.index');
    }

    public function create() {
        return view('crm.aulas.create');
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

        $servicioCreado = Aulas::create($data);

        return redirect()->route('aulas.edit', $servicioCreado->id)->with('toast', [
                'icon' => 'success',
                'mensaje' => 'El servicio creado con exito'
        ]);
    }

    public function edit(string $id){
        $servicio = Aulas::find($id);
        if (!$servicio) {
            session()->flash('toast', [
                'icon' => 'error',
                'mensaje' => 'El servicio no existe'
            ]);
            return redirect()->route('aulas.index');
        }
        return view('crm.aulas.edit', compact('servicio'));
    }

    public function update(string $id ,Request $request) {
        $servicio = Aulas::find($id);

        $data = $this->validate($request, [
            'name' => 'required|max:255',
            'inactive' => 'nullable',
        ], [
            'name.required' => 'El nombre es requerido para continuar',
            'name.max' => 'El nombre no pueder tener mas de 255 caracteres',
        ]);

        $servicio->update($data);

        return redirect()->route('aulas.index')->with('toast', [
                'icon' => 'success',
                'mensaje' => 'El servicio actualizado con exito'
        ]);
    }

    public function destroy(Request $request) {
        $servicio = Aulas::find($request->id);

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
