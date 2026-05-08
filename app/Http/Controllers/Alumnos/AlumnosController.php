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
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhereRaw("CONCAT(COALESCE(name,''), ' ', COALESCE(surname,'')) LIKE ?", ["%{$search}%"])
                  ->orWhereRaw("CONCAT(COALESCE(surname,''), ' ', COALESCE(name,'')) LIKE ?", ["%{$search}%"]);
            });
        }

        // Filtro estado Moodle (acepta ambos parámetros: sync_status (vista) y moodle_status (legacy))
        $syncStatus = $request->input('sync_status', $request->input('moodle_status'));
        if (!empty($syncStatus)) {
            if (in_array($syncStatus, ['synced', 'sincronizados', 'sincronizado'])) {
                $query->whereNotNull('moodle_id');
            } elseif (in_array($syncStatus, ['unsynced', 'not_synced', 'no_sincronizados', 'no_sincronizado'])) {
                $query->whereNull('moodle_id');
            }
        }

        // Filtro de fecha (date_from/date_to en la vista, también acepta fecha_desde/fecha_hasta)
        $fechaDesde = $request->input('date_from', $request->input('fecha_desde'));
        $fechaHasta = $request->input('date_to', $request->input('fecha_hasta'));
        if (!empty($fechaDesde)) {
            $query->whereDate('created_at', '>=', $fechaDesde);
        }
        if (!empty($fechaHasta)) {
            $query->whereDate('created_at', '<=', $fechaHasta);
        }

        $alumnos = $query->withCount('cursos')
                        ->orderBy('created_at', 'desc')
                        ->paginate(15)
                        ->withQueryString();

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

        if (empty($validated['password'])) {
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