<?php

namespace App\Http\Controllers\Aulas;

use App\Http\Controllers\Controller;
use App\Models\Aulas\Aulas;
use Illuminate\Http\Request;

class AulasController extends Controller
{
    public function index()
    {
        // Estadísticas para la vista usando campos disponibles
        $totalAulas = Aulas::count();
        $aulasDisponibles = Aulas::where('inactive', 0)->count(); // Activas = no inactivas
        $aulasOcupadas = Aulas::where('inactive', 1)->count(); // Inactivas = ocupadas/en mantenimiento
        $aulasMantenimiento = 0; // No hay campo específico, usar 0 por ahora
        
        return view('crm.aulas.index', compact('totalAulas', 'aulasDisponibles', 'aulasOcupadas', 'aulasMantenimiento'));
    }

    public function create() {
        return view('crm.aulas.create');
    }

    public function show(string $id) {
        $aula = Aulas::find($id);
        if (!$aula) {
            session()->flash('toast', [
                'icon' => 'error',
                'mensaje' => 'El aula no existe'
            ]);
            return redirect()->route('aulas.index');
        }
        return view('crm.aulas.show', compact('aula'));
    }


    public function store(Request $request) {
        // Validamos todos los campos del formulario
        $data = $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'capacity' => 'nullable|integer|min:1',
            'floor' => 'nullable|string|max:255',
            'building' => 'nullable|string|max:255',
            'status' => 'required|in:disponible,ocupada,mantenimiento',
            'type' => 'nullable|in:aula_teorica,laboratorio,taller,auditorio,sala_reuniones,biblioteca',
            'equipment' => 'nullable|array',
            'equipment.*' => 'string',
            'responsible' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'available_schedule' => 'nullable|string',
            'observations' => 'nullable|string',
            'inactive' => 'nullable|boolean',
        ], [
            'name.required' => 'El nombre del aula es requerido',
            'name.max' => 'El nombre no puede tener más de 255 caracteres',
            'capacity.integer' => 'La capacidad debe ser un número entero',
            'capacity.min' => 'La capacidad debe ser al menos 1',
            'status.required' => 'El estado del aula es requerido',
            'status.in' => 'El estado debe ser: disponible, ocupada o mantenimiento',
            'type.in' => 'El tipo de aula no es válido',
        ]);

        // Procesar el equipamiento (convertir array a JSON)
        if (isset($data['equipment'])) {
            $data['equipment'] = json_encode($data['equipment']);
        }

        // Mapear los campos del formulario a los campos del modelo
        $aulaData = [
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'capacity' => $data['capacity'] ?? null,
            'floor' => $data['floor'] ?? null,
            'building' => $data['building'] ?? null,
            'status' => $data['status'],
            'type' => $data['type'] ?? null,
            'equipment' => $data['equipment'] ?? null,
            'responsible' => $data['responsible'] ?? null,
            'contact_phone' => $data['contact_phone'] ?? null,
            'available_schedule' => $data['available_schedule'] ?? null,
            'observations' => $data['observations'] ?? null,
            'inactive' => $data['inactive'] ?? 0,
        ];

        $aulaCreada = Aulas::create($aulaData);

        return redirect()->route('aulas.index')->with('success', 'Aula creada exitosamente');
    }

    public function edit(string $id){
        $aula = Aulas::find($id);
        if (!$aula) {
            session()->flash('toast', [
                'icon' => 'error',
                'mensaje' => 'El aula no existe'
            ]);
            return redirect()->route('aulas.index');
        }
        return view('crm.aulas.edit', compact('aula'));
    }

    public function update(string $id ,Request $request) {
        $aula = Aulas::find($id);

        if (!$aula) {
            return redirect()->route('aulas.index')->with('error', 'Aula no encontrada');
        }

        $data = $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'capacity' => 'nullable|integer|min:1',
            'floor' => 'nullable|string|max:255',
            'building' => 'nullable|string|max:255',
            'status' => 'required|in:disponible,ocupada,mantenimiento',
            'type' => 'nullable|in:aula_teorica,laboratorio,taller,auditorio,sala_reuniones,biblioteca',
            'equipment' => 'nullable|array',
            'equipment.*' => 'string',
            'responsible' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'available_schedule' => 'nullable|string',
            'observations' => 'nullable|string',
            'inactive' => 'nullable|boolean',
        ], [
            'name.required' => 'El nombre del aula es requerido',
            'name.max' => 'El nombre no puede tener más de 255 caracteres',
            'capacity.integer' => 'La capacidad debe ser un número entero',
            'capacity.min' => 'La capacidad debe ser al menos 1',
            'status.required' => 'El estado del aula es requerido',
            'status.in' => 'El estado debe ser: disponible, ocupada o mantenimiento',
            'type.in' => 'El tipo de aula no es válido',
        ]);

        // Procesar el equipamiento (convertir array a JSON)
        if (isset($data['equipment'])) {
            $data['equipment'] = json_encode($data['equipment']);
        }

        // Mapear los campos del formulario a los campos del modelo
        $aulaData = [
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'capacity' => $data['capacity'] ?? null,
            'floor' => $data['floor'] ?? null,
            'building' => $data['building'] ?? null,
            'status' => $data['status'],
            'type' => $data['type'] ?? null,
            'equipment' => $data['equipment'] ?? null,
            'responsible' => $data['responsible'] ?? null,
            'contact_phone' => $data['contact_phone'] ?? null,
            'available_schedule' => $data['available_schedule'] ?? null,
            'observations' => $data['observations'] ?? null,
            'inactive' => $data['inactive'] ?? 0,
        ];

        $aula->update($aulaData);

        return redirect()->route('aulas.index')->with('success', 'Aula actualizada exitosamente');
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
