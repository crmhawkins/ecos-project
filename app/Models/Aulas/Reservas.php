<?php

namespace App\Models\Aulas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'reservas';

    protected $fillable = [
        // Campos nuevos del sistema
        'titulo',
        'descripcion',
        'solicitante',
        'email_contacto',
        'fecha_inicio',
        'fecha_fin',
        'hora_inicio',
        'hora_fin',
        'aula_id',
        'numero_asistentes',
        'estado',
        'prioridad',
        'equipamiento_requerido',
        'observaciones',
        // Campos del sistema anterior (para compatibilidad)
        'curso',
        'profesor',
        'contacto_profesor',
        'dias',
        'alumnos',
        'informatica',
        'homologada',
        'archivo',
        'inactive'
    ];

    protected $attributes = [
        'inactive' => 0,
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at',
    ];

    public function aula()
    {
        return $this->belongsTo(Aulas::class, 'aula_id');
    }

    public function sesiones()
    {
        return $this->hasMany(ReservaSesion::class, 'reserva_id');
    }

}
