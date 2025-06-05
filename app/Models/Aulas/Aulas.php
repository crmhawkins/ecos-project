<?php

namespace App\Models\Aulas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aulas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'aulas';

    protected $fillable = [
        'name',
        'inactive',
    ];

    protected $attributes = [
        'inactive' => 0,
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at',
    ];


}

