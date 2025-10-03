<?php

namespace App\Http\Controllers\Alumnos;

use App\Http\Controllers\Controller;
use App\Models\Alumnos\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AlumnosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Alumno::query();

        // Filtros
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('surname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        if ($request->filled('moodle_status')) {
            if ($request->moodle_status === 'synced') {
                $query->whereNotNull('moodle_id');
            } elseif ($request->moodle_status === 'not_synced') {
                $query->whereNull('moodle_id');
            }
        }

        $alumnos = $query->withCount('cursos')
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);

        // Estadísticas para la vista
        $totalAlumnos = Alumno::count();
        $alumnosSincronizados = Alumno::whereNotNull('moodle_id')->count();
        $alumnosNoSincronizados = Alumno::whereNull('moodle_id')->count();

        return view('crm.alumnos.index', compact('alumnos', 'totalAlumnos', 'alumnosSincronizados', 'alumnosNoSincronizados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crm.alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:alumnos',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:alumnos',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Alumno::create($validated);

        return redirect()->route('crm.alumnos.index')
                        ->with('success', 'Alumno creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno)
    {
        $alumno->load('cursos');
        return view('crm.alumnos.show', compact('alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumno $alumno)
    {
        return view('crm.alumnos.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alumno $alumno)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:alumnos,username,' . $alumno->id,
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:alumnos,email,' . $alumno->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $alumno->update($validated);

        return redirect()->route('crm.alumnos.index')
                        ->with('success', 'Alumno actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumno $alumno)
    {
        $alumno->delete();

        return redirect()->route('crm.alumnos.index')
                        ->with('success', 'Alumno eliminado exitosamente.');
    }

    /**
     * Sync alumno with Moodle
     */
    public function syncMoodle(Alumno $alumno)
    {
        // Aquí iría la lógica para sincronizar con Moodle
        // Por ahora solo simulamos la sincronización
        
        $alumno->update(['moodle_id' => rand(1000, 9999)]);

        return redirect()->back()
                        ->with('success', 'Alumno sincronizado con Moodle exitosamente.');
    }
}