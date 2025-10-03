<?php

namespace App\Models\Cursos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cursos extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cursos';

    protected $fillable = [
        'name',
        'title', // Alias para name
        'price',
        'category_id',
        'image',
        'description',
        'moodle_id',
        'moodle_course_id', // Alias para moodle_id
        'inactive',
        'published',
        'inicio',
        'duracion',
        'plazas',
        'lecciones',
        'certificado',
    ];

    protected $attributes = [
        'inactive' => 0,
        'published' => false,
    ];

    protected $casts = [
        'published' => 'boolean',
        'inactive' => 'boolean',
        'certificado' => 'boolean',
    ];
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at','inicio'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function alumnos()
    {
        return $this->belongsToMany(\App\Models\Alumnos\Alumno::class, 'alumnos_cursos', 'curso_id', 'alumno_id');
    }

    // Accessors para compatibilidad
    public function getTitleAttribute()
    {
        return $this->attributes['title'] ?? $this->attributes['name'];
    }

    public function getMoodleCourseIdAttribute()
    {
        return $this->attributes['moodle_course_id'] ?? $this->attributes['moodle_id'];
    }

    // Mutators para compatibilidad
    public function setTitleAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['title'] = $value;
    }

    public function setMoodleCourseIdAttribute($value)
    {
        $this->attributes['moodle_id'] = $value;
        $this->attributes['moodle_course_id'] = $value;
    }
}

