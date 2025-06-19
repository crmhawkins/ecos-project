<?php

namespace App\Models\Carrito;


use Illuminate\Database\Eloquent\Model;

class ShoppingCartItem extends Model
{
    protected $fillable = ['alumno_id', 'curso_id', 'cantidad'];

    public function curso()
    {
        return $this->belongsTo(\App\Models\Cursos\Cursos::class, 'curso_id');
    }
}
