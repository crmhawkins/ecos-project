<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AiAssistantConfig;
use App\Models\AiPrompt;
use App\Models\AiLink;

class AiAssistantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear configuración por defecto
        AiAssistantConfig::create([
            'is_active' => true,
            'assistant_name' => 'Asistente ECOS',
            'welcome_message' => '¡Hola! Soy tu asistente virtual de ECOS. ¿En qué puedo ayudarte hoy?',
            'system_prompt' => 'Eres un asistente virtual de ECOS, una empresa de formación con más de 28 años de experiencia. Ayudas a los usuarios con información sobre cursos, formación y servicios. Sé amable, profesional y útil.',
            'ai_model' => 'gpt-3.5-turbo',
            'temperature' => 0.7,
            'max_tokens' => 1000,
            'show_courses' => true,
            'show_contact_info' => true,
            'primary_color' => '#D93690',
            'secondary_color' => '#667eea'
        ]);

        // Crear prompts por defecto
        $prompts = [
            [
                'category' => 'courses',
                'name' => 'Información de cursos',
                'prompt' => 'El usuario pregunta sobre cursos. Proporciona información sobre los cursos disponibles, categorías, duración y modalidades. Incluye enlaces relevantes si están disponibles.',
                'is_active' => true,
                'priority' => 10,
                'variables' => ['course_name', 'category', 'duration']
            ],
            [
                'category' => 'general',
                'name' => 'Información general',
                'prompt' => 'El usuario hace una pregunta general sobre ECOS. Proporciona información sobre la empresa, sus servicios, experiencia y valores.',
                'is_active' => true,
                'priority' => 5,
                'variables' => ['company_name', 'years_experience']
            ],
            [
                'category' => 'contact',
                'name' => 'Información de contacto',
                'prompt' => 'El usuario pregunta sobre contacto o ubicaciones. Proporciona información sobre las sedes, horarios de atención y formas de contacto.',
                'is_active' => true,
                'priority' => 8,
                'variables' => ['phone', 'email', 'address']
            ]
        ];

        foreach ($prompts as $prompt) {
            AiPrompt::create($prompt);
        }

        // Crear enlaces por defecto
        $links = [
            [
                'title' => 'Ver todos los cursos',
                'url' => '/course',
                'description' => 'Explora nuestro catálogo completo de cursos',
                'category' => 'courses',
                'is_active' => true,
                'priority' => 10,
                'icon' => 'fas fa-graduation-cap'
            ],
            [
                'title' => 'Contactar con nosotros',
                'url' => '/web/contact',
                'description' => 'Ponte en contacto con nuestro equipo',
                'category' => 'contact',
                'is_active' => true,
                'priority' => 8,
                'icon' => 'fas fa-envelope'
            ],
            [
                'title' => 'Sobre ECOS',
                'url' => '/web/about',
                'description' => 'Conoce más sobre nuestra empresa',
                'category' => 'general',
                'is_active' => true,
                'priority' => 5,
                'icon' => 'fas fa-info-circle'
            ]
        ];

        foreach ($links as $link) {
            AiLink::create($link);
        }
    }
}
