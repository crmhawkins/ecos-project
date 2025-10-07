<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiLink extends Model
{
    protected $table = 'ai_links';
    
    protected $fillable = [
        'title',
        'url',
        'description',
        'category',
        'is_active',
        'priority',
        'icon'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Obtener enlaces activos por categoría
     */
    public static function getActiveByCategory($category)
    {
        return self::where('category', $category)
                   ->where('is_active', true)
                   ->orderBy('priority', 'desc')
                   ->get();
    }

    /**
     * Obtener todos los enlaces activos
     */
    public static function getAllActive()
    {
        return self::where('is_active', true)
                   ->orderBy('category')
                   ->orderBy('priority', 'desc')
                   ->get();
    }
}
