<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiAssistantConfig extends Model
{
    protected $table = 'ai_assistant_config';
    
    protected $fillable = [
        'is_active',
        'assistant_name',
        'welcome_message',
        'system_prompt',
        'ai_model',
        'temperature',
        'max_tokens',
        'show_courses',
        'show_contact_info',
        'primary_color',
        'secondary_color'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_courses' => 'boolean',
        'show_contact_info' => 'boolean',
        'temperature' => 'decimal:2'
    ];

    /**
     * Obtener la configuración activa del asistente
     */
    public static function getActiveConfig()
    {
        return self::where('is_active', true)->first() ?? self::createDefault();
    }

    /**
     * Crear configuración por defecto
     */
    public static function createDefault()
    {
        return self::create([
            'is_active' => true,
            'assistant_name' => 'Asistente ECOS',
            'welcome_message' => '¡Hola! Bienvenido a ECOS. ¿En qué podemos ayudarte hoy?',
            'system_prompt' => 'Hablas en nombre de ECOS, una empresa de formación con más de 28 años de experiencia. Ayudas a los usuarios con información sobre cursos, formación y servicios. No menciones que eres una IA ni que eres un asistente virtual; céntrate en la información práctica y útil.',
            'ai_model' => 'gpt-3.5-turbo',
            'temperature' => 0.7,
            'max_tokens' => 1000,
            'show_courses' => true,
            'show_contact_info' => true,
            'primary_color' => '#D93690',
            'secondary_color' => '#667eea'
        ]);
    }
}
