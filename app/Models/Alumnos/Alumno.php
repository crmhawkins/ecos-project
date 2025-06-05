<?php

namespace App\Models\Alumnos;

use App\Models\Cursos\Cursos;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Alumno extends Authenticatable
{
    use HasApiTokens, Notifiable , SoftDeletes;

    protected $fillable = [
        'username',     // Moodle requiere este campo
        'name',
        'surname',      // Para lastname en Moodle
        'email',
        'password',
        'phone',
        'avatar',
        'moodle_id',     //
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relaciones futuras: cursos comprados, pagos, etc.

    public function cursos()
    {
        return $this->belongsToMany(Cursos::class, 'alumnos_cursos', 'alumno_id', 'curso_id');
    }
}
