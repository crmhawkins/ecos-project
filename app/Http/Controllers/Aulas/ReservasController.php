<?php

namespace App\Http\Controllers\Aulas;

use App\Http\Controllers\Controller;
use App\Models\Aulas\Aulas;
use App\Models\Aulas\Reservas;
use App\Models\Aulas\ReservaSesion;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
    public function index()
    {
        return view('crm.reservas.index');
    }
    public function calendario()
    {
        return view('crm.reservas.index');
    }

 public function eventosMensuales(Request $request)
    {
        $sesiones = ReservaSesion::with(['reserva', 'aula'])->get();

        $eventos = $sesiones->map(function ($sesion) {
            return [
                'id' => $sesion->id,
                'title' => optional($sesion->reserva)->curso . ' - ' . optional($sesion->aula)->name,
                'start' => $sesion->fecha->format('Y-m-d') . 'T' . \Carbon\Carbon::parse($sesion->hora_inicio)->format('H:i:s'),
                'end' => $sesion->fecha->format('Y-m-d') . 'T' . \Carbon\Carbon::parse($sesion->hora_fin)->format('H:i:s'),
                'allDay' => false,
                //'url' => route('calendario.diario', ['fecha' => $sesion->fecha->format('Y-m-d')]),
            ];
        });

        return response()->json($eventos);
    }

    public function actualizarEvento(Request $request)
    {
        $sesion = ReservaSesion::find($request->id);

        if (!$sesion) {
            return response()->json(['success' => false]);
        }

        $sesion->fecha = $request->fecha;
        $sesion->hora_inicio = Carbon::parse($request->hora_inicio)->format('H:i:s'); //$request->hora_inicio;
        $sesion->hora_fin = Carbon::parse($request->hora_fin)->format('H:i:s'); //$request->hora_fin;
        $sesion->save();

        return response()->json(['success' => true]);
    }

    public function create() {
        return view('crm.reservas.create');
    }


       public function store(Request $request)
    {
        //dd($request->all());
        $data = $request->validate([
            'curso' => 'required|string|max:255',
            'profesor' => 'required|string|max:255',
            'contacto_profesor' => 'nullable|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'dias' => 'required|array',
            'dias.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'alumnos' => 'nullable|integer',
            'archivo' => 'nullable|file',
            'observaciones' => 'nullable|string',
            'informatica' => 'nullable|boolean',
            'homologada' => 'nullable|boolean',
        ]);

        if ($request->hasFile('archivo')) {
            $data['archivo'] = $request->file('archivo')->store('reservas_archivos', 'public');
        }

        $data['dias'] = json_encode($request->dias); // guardar como JSON
        $data['estado'] = 'pendiente';

        Reservas::create($data);

        return redirect()->route('reservas.index')->with('toast', [
            'icon' => 'success',
            'mensaje' => 'Solicitud enviada correctamente.'
        ]);
    }

    public function asignarVista($id)
    {
        $reserva = Reservas::findOrFail($id);
        $aulas = Aulas::all();

        $diasCurso = json_decode($reserva->dias, true); // Ej: ['Monday', 'Wednesday']
        $periodo = CarbonPeriod::create($reserva->fecha_inicio, $reserva->fecha_fin);
        $horaInicio = $reserva->hora_inicio;
        $horaFin = $reserva->hora_fin;

        $disponibilidad = [];
        $conflictos = [];

        foreach ($periodo as $fecha) {
            if (!in_array($fecha->englishDayOfWeek, $diasCurso)) continue;

            $fechaStr = $fecha->toDateString();
            $disponibilidad[$fechaStr] = [];

            foreach ($aulas as $aula) {
                $hayConflicto = ReservaSesion::where('aula_id', $aula->id)
                    ->where('fecha', $fechaStr)
                    ->where(function ($query) use ($horaInicio, $horaFin) {
                        $query->whereBetween('hora_inicio', [$horaInicio, $horaFin])
                            ->orWhereBetween('hora_fin', [$horaInicio, $horaFin])
                            ->orWhere(function ($q) use ($horaInicio, $horaFin) {
                                $q->where('hora_inicio', '<=', $horaInicio)
                                ->where('hora_fin', '>=', $horaFin);
                            });
                    })->exists();

                if ($hayConflicto) {
                    $disponibilidad[$fechaStr][$aula->id] = 'Ocupado';
                    $conflictos[] = "$fechaStr – Aula {$aula->nombre} ya está ocupada.";
                } else {
                    $disponibilidad[$fechaStr][$aula->id] = 'Libre';
                }
            }
        }

        return view('crm.reservas.aceptar', compact('reserva', 'aulas', 'disponibilidad', 'conflictos'));
    }


    public function asignarAula(Request $request)
    {
        $id = $request->id;
        $reserva = Reservas::findOrFail($id);

        $reserva->aula_id = $request->aula_id;
        $reserva->estado = 'aceptada';
        $reserva->save();

        // Generar sesiones concretas
        $dias = json_decode($reserva->dias); // array de días
        $periodo = CarbonPeriod::create($reserva->fecha_inicio, $reserva->fecha_fin);

        foreach ($periodo as $fecha) {
            if (in_array($fecha->englishDayOfWeek, $dias)) {
                ReservaSesion::create([
                    'reserva_id' => $reserva->id,
                    'aula_id' => $reserva->aula_id,
                    'fecha' => $fecha->toDateString(),
                    'hora_inicio' => $reserva->hora_inicio,
                    'hora_fin' => $reserva->hora_fin,
                ]);
            }
        }

        return redirect()->route('reservas.index')->with('toast', [
            'icon' => 'success',
            'mensaje' => 'Reserva aceptada y sesiones creadas.'
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
