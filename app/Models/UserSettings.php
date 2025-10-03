<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'language',
        'timezone',
        'theme',
        'email_notifications',
        'system_notifications',
        'additional_settings',
    ];

    protected $casts = [
        'email_notifications' => 'boolean',
        'system_notifications' => 'boolean',
        'additional_settings' => 'array',
    ];

    /**
     * Relación con el usuario
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener configuraciones por defecto
     */
    public static function getDefaults(): array
    {
        return [
            'language' => 'es',
            'timezone' => 'Europe/Madrid',
            'theme' => 'light',
            'email_notifications' => true,
            'system_notifications' => true,
            'additional_settings' => [],
        ];
    }

    /**
     * Crear o actualizar configuraciones para un usuario
     */
    public static function updateOrCreateForUser(int $userId, array $settings): self
    {
        return self::updateOrCreate(
            ['user_id' => $userId],
            $settings
        );
    }

    /**
     * Obtener configuraciones de un usuario o crear las por defecto
     */
    public static function getForUser(int $userId): self
    {
        return self::firstOrCreate(
            ['user_id' => $userId],
            array_merge(['user_id' => $userId], self::getDefaults())
        );
    }
}