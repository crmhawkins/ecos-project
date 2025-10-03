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
        // Estadísticas para la vista
        $totalReservas = Reservas::count();
        $reservasConfirmadas = Reservas::where('estado', 'confirmada')->count();
        $reservasPendientes = Reservas::where('estado', 'pendiente')->count();
        $reservasCanceladas = Reservas::where('estado', 'cancelada')->count();
        $aulas = Aulas::all();
        
        // Obtener reservas paginadas para la paginación
        $servicios = Reservas::with(['aula'])->paginate(10);
        
        return view('crm.reservas.index', compact('totalReservas', 'reservasConfirmadas', 'reservasPendientes', 'reservasCanceladas', 'aulas', 'servicios'));
    }
    public function calendario()
    {
        return view('crm.calendario.index');
    }

    public function getReservasCalendario($year, $month)
    {
        $startDate = \Carbon\Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        $reservas = Reservas::with(['aula'])
            ->whereBetween('fecha_inicio', [$startDate, $endDate])
            ->get();

        $eventos = $reservas->map(function ($reserva) {
            $fechaInicio = \Carbon\Carbon::parse($reserva->fecha_inicio);
            $fechaFin = $reserva->fecha_fin ? \Carbon\Carbon::parse($reserva->fecha_fin) : $fechaInicio;
            
            // Si tiene hora específica, la agregamos
            $horaInicio = $reserva->hora_inicio ? $reserva->hora_inicio : '09:00';
            $horaFin = $reserva->hora_fin ? $reserva->hora_fin : '10:00';

            return [
                'id' => $reserva->id,
                'title' => $reserva->titulo,
                'start' => $fechaInicio->format('Y-m-d') . 'T' . $horaInicio,
                'end' => $fechaFin->format('Y-m-d') . 'T' . $horaFin,
                'backgroundColor' => $this->getColorByEstado($reserva->estado),
                'borderColor' => $this->getColorByEstado($reserva->estado),
                'extendedProps' => [
                    'reserva_id' => $reserva->id,
                    'descripcion' => $reserva->descripcion,
                    'solicitante' => $reserva->solicitante,
                    'email_contacto' => $reserva->email_contacto,
                    'aula' => $reserva->aula ? $reserva->aula->nombre : 'Sin aula',
                    'estado' => $reserva->estado,
                    'prioridad' => $reserva->prioridad,
                    'numero_asistentes' => $reserva->numero_asistentes,
                    'equipamiento_requerido' => $reserva->equipamiento_requerido,
                    'observaciones' => $reserva->observaciones,
                ]
            ];
        });

        return response()->json($eventos);
    }

    private function getColorByEstado($estado)
    {
        switch ($estado) {
            case 'confirmada':
                return '#10b981'; // Verde
            case 'pendiente':
                return '#f59e0b'; // Amarillo
            case 'cancelada':
                return '#ef4444'; // Rojo
            default:
                return '#6b7280'; // Gris
        }
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
        $aulas = Aulas::all();
        return view('crm.reservas.create', compact('aulas'));
    }

    public function edit($id) {
        $reserva = Reservas::findOrFail($id);
        $aulas = Aulas::all();
        return view('crm.reservas.edit', compact('reserva', 'aulas'));
    }

    public function show($id) {
        $reserva = Reservas::with(['aula'])->findOrFail($id);
        return view('crm.reservas.show', compact('reserva'));
    }


       public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'solicitante' => 'required|string|max:255',
            'email_contacto' => 'nullable|email|max:255',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'aula_id' => 'required|exists:aulas,id',
            'numero_asistentes' => 'nullable|integer|min:1',
            'estado' => 'required|in:pendiente,confirmada,cancelada',
            'prioridad' => 'required|in:baja,media,alta',
            'equipamiento_requerido' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ], [
            'titulo.required' => 'El título de la reserva es requerido',
            'titulo.max' => 'El título no puede tener más de 255 caracteres',
            'solicitante.required' => 'El nombre del solicitante es requerido',
            'email_contacto.email' => 'El email de contacto debe ser válido',
            'fecha_inicio.required' => 'La fecha de inicio es requerida',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio no puede ser anterior a hoy',
            'fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio',
            'hora_inicio.required' => 'La hora de inicio es requerida',
            'hora_fin.required' => 'La hora de fin es requerida',
            'hora_fin.after' => 'La hora de fin debe ser posterior a la hora de inicio',
            'aula_id.required' => 'Debe seleccionar un aula',
            'aula_id.exists' => 'El aula seleccionada no existe',
            'numero_asistentes.min' => 'El número de asistentes debe ser al menos 1',
            'estado.required' => 'El estado es requerido',
            'estado.in' => 'El estado debe ser: pendiente, confirmada o cancelada',
            'prioridad.required' => 'La prioridad es requerida',
            'prioridad.in' => 'La prioridad debe ser: baja, media o alta',
        ]);

        Reservas::create($data);

        return redirect()->route('reservas.index')->with('success', 'Reserva creada exitosamente');
    }

    public function update(Request $request, $id)
    {
        $reserva = Reservas::findOrFail($id);
        
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'solicitante' => 'required|string|max:255',
            'email_contacto' => 'nullable|email|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'aula_id' => 'required|exists:aulas,id',
            'numero_asistentes' => 'nullable|integer|min:1',
            'estado' => 'required|in:pendiente,confirmada,cancelada',
            'prioridad' => 'required|in:baja,media,alta',
            'equipamiento_requerido' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ], [
            'titulo.required' => 'El título de la reserva es requerido',
            'titulo.max' => 'El título no puede tener más de 255 caracteres',
            'solicitante.required' => 'El nombre del solicitante es requerido',
            'email_contacto.email' => 'El email de contacto debe ser válido',
            'fecha_inicio.required' => 'La fecha de inicio es requerida',
            'fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio',
            'hora_inicio.required' => 'La hora de inicio es requerida',
            'hora_fin.required' => 'La hora de fin es requerida',
            'hora_fin.after' => 'La hora de fin debe ser posterior a la hora de inicio',
            'aula_id.required' => 'Debe seleccionar un aula',
            'aula_id.exists' => 'El aula seleccionada no existe',
            'numero_asistentes.min' => 'El número de asistentes debe ser al menos 1',
            'estado.required' => 'El estado es requerido',
            'estado.in' => 'El estado debe ser: pendiente, confirmada o cancelada',
            'prioridad.required' => 'La prioridad es requerida',
            'prioridad.in' => 'La prioridad debe ser: baja, media o alta',
        ]);

        $reserva->update($data);

        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada exitosamente');
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
