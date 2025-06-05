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
        'curso',
        'profesor',
        'contacto_profesor',
        'hora_inicio',
        'hora_fin',
        'dias',
        'fecha_inicio',
        'fecha_fin',
        'alumnos',
        'informatica',
        'homologada',
        'aula_id',
        'archivo',
        'observaciones',
        'estado',
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
