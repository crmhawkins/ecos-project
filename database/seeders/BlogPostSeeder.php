<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog\BlogPost;
use App\Models\Users\User;
use Carbon\Carbon;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author = User::first();
        
        if (!$author) {
            $this->command->error('No hay usuarios. Crea un usuario primero.');
            return;
        }

        $posts = [
            [
                'title' => 'Transformación Digital en la Formación Profesional',
                'excerpt' => 'La transformación digital revoluciona la formación profesional preparando estudiantes para empleos del futuro.',
                'content' => '<h2>La Era Digital</h2><p>En <strong>Grupo Ecos</strong> lideramos la revolución educativa integrando tecnologías avanzadas.</p><h3>Beneficios</h3><ul><li>Plataformas online como Moodle</li><li>Realidad virtual</li><li>Inteligencia artificial</li></ul>',
                'category' => 'tecnologia',
                'tags' => ['transformación digital', 'educación online'],
                'published' => true,
                'published_at' => Carbon::now()->subDays(2),
                'author_id' => $author->id,
            ],
            [
                'title' => 'Certificaciones Profesionales: Tu Pasaporte al Éxito',
                'excerpt' => 'Las certificaciones profesionales son clave para destacar en el mercado laboral actual.',
                'content' => '<h2>Importancia de Certificaciones</h2><p>Las <strong>certificaciones profesionales</strong> son diferenciadores clave.</p><h3>Más Demandadas</h3><ol><li>Cloud Computing</li><li>Ciberseguridad</li><li>Gestión de Proyectos</li></ol>',
                'category' => 'certificaciones',
                'tags' => ['certificaciones', 'desarrollo profesional'],
                'published' => true,
                'published_at' => Carbon::now()->subDays(5),
                'author_id' => $author->id,
            ],
            [
                'title' => 'Metodologías Ágiles en la Educación',
                'excerpt' => 'Las metodologías ágiles transforman la manera de diseñar experiencias educativas efectivas.',
                'content' => '<h2>Agilidad en Educación</h2><p>Las <strong>metodologías ágiles</strong> transforman la educación.</p><h3>Principios</h3><ul><li>Iteración continua</li><li>Colaboración</li><li>Adaptabilidad</li></ul>',
                'category' => 'educacion',
                'tags' => ['metodologías ágiles', 'innovación educativa'],
                'published' => true,
                'published_at' => Carbon::now()->subDays(8),
                'author_id' => $author->id,
            ],
            [
                'title' => 'El Auge del E-Learning: Estadísticas 2024',
                'excerpt' => 'El mercado e-learning crece exponencialmente. Análisis de estadísticas y tendencias.',
                'content' => '<h2>E-Learning en Números</h2><p>Crecimiento sin precedentes en <strong>e-learning</strong>.</p><h3>Estadísticas</h3><ul><li>Crecimiento 900% desde 2000</li><li>Mercado $315 mil millones</li></ul>',
                'category' => 'formacion',
                'tags' => ['e-learning', 'estadísticas'],
                'published' => true,
                'published_at' => Carbon::now()->subDays(12),
                'author_id' => $author->id,
            ],
            [
                'title' => 'Soft Skills vs Hard Skills: El Equilibrio Perfecto',
                'excerpt' => 'Tanto habilidades técnicas como interpersonales son cruciales para el éxito profesional.',
                'content' => '<h2>Competencias Profesionales</h2><p>El mercado demanda <strong>hard skills</strong> y <strong>soft skills</strong>.</p><h3>Hard Skills</h3><ul><li>Programación</li><li>Análisis de datos</li></ul><h3>Soft Skills</h3><ul><li>Comunicación</li><li>Liderazgo</li></ul>',
                'category' => 'formacion',
                'tags' => ['soft skills', 'hard skills'],
                'published' => true,
                'published_at' => Carbon::now()->subDays(15),
                'author_id' => $author->id,
            ],
            [
                'title' => 'Innovaciones en Moodle: Nuevas Funcionalidades',
                'excerpt' => 'Moodle evoluciona con nuevas funcionalidades que mejoran la experiencia educativa.',
                'content' => '<h2>Moodle Avanzado</h2><p><strong>Moodle</strong> es la plataforma LMS más robusta.</p><h3>Nuevas Funciones</h3><ul><li>Interfaz renovada</li><li>Analíticas de aprendizaje</li><li>Gamificación</li></ul>',
                'category' => 'tecnologia',
                'tags' => ['moodle', 'LMS'],
                'published' => true,
                'published_at' => Carbon::now()->subDays(18),
                'author_id' => $author->id,
            ]
        ];

        foreach ($posts as $postData) {
            BlogPost::create($postData);
        }

        $this->command->info('6 artículos creados exitosamente.');
    }
}
