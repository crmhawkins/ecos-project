<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WebMenuItem extends Model
{
    protected $fillable = [
        'label',
        'url',
        'order',
        'parent_id',
        'active',
        'target',
        'icon',
    ];

    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Relación con el menú padre (para submenús)
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(WebMenuItem::class, 'parent_id');
    }

    /**
     * Relación con los submenús
     */
    public function children(): HasMany
    {
        return $this->hasMany(WebMenuItem::class, 'parent_id')->orderBy('order');
    }

    /**
     * Obtener todos los items del menú ordenados
     */
    public static function getMenuItems()
    {
        return self::where('active', true)
            ->whereNull('parent_id')
            ->orderBy('order')
            ->with('children')
            ->get();
    }

    /**
     * Obtener todos los items (incluyendo inactivos) para administración
     */
    public static function getAllItems()
    {
        return self::orderBy('order')->get();
    }
}
