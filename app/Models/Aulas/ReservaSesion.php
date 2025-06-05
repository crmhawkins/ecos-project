<?php

namespace App\Models\Aulas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReservaSesion extends Model
{
  use HasFactory;

    protected $table = 'reserva_sesions';

    protected $fillable = [
        'reserva_id',
        'aula_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'conflicto',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora_inicio' => 'datetime:H:i',
        'hora_fin' => 'datetime:H:i',
        'conflicto' => 'boolean',
    ];

    // Relaciones
    public function reserva()
    {
        return $this->belongsTo(Reservas::class, 'reserva_id');
    }

    public function aula()
    {
        return $this->belongsTo(Aulas::class, 'aula_id');
    }
}
