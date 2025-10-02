<?php

namespace App\Services;

use App\Models\Cursos\Cursos;
use App\Models\Cursos\Category;
use App\Modules\Moodle\Services\MoodleCourseService;
use App\Modules\Moodle\Services\MoodleApiService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

class CoursesSyncService
{
    protected $moodleCourseService;
    protected $moodleApiService;

    public function __construct()
    {
        $this->moodleApiService = app(MoodleApiService::class);
        $this->moodleCourseService = app(MoodleCourseService::class);
    }

    /**
     * Sincronizar todos los cursos de Moodle con la base de datos local
     */
    public function syncAllCourses()
    {
        try {
            Log::info('Iniciando sincronización de cursos desde Moodle');
            
            // Primero sincronizar categorías
            $this->syncCategories();
            
            // Obtener cursos de Moodle
            $moodleCourses = $this->moodleCourseService->getAllCourses();
            
            if (empty($moodleCourses)) {
                Log::warning('No se obtuvieron cursos desde Moodle');
                return false;
            }

            $syncedCount = 0;
            $errorCount = 0;

            foreach ($moodleCourses as $moodleCourse) {
                try {
                    // Saltar el curso "Site" (ID 1) que es el sitio principal
                    if ($moodleCourse['id'] == 1) {
                        continue;
                    }

                    $this->syncSingleCourse($moodleCourse);
                    $syncedCount++;
                } catch (Exception $e) {
                    $errorCount++;
                    Log::error("Error sincronizando curso {$moodleCourse['id']}: " . $e->getMessage());
                }
            }

            Log::info("Sincronización completada. Cursos sincronizados: {$syncedCount}, Errores: {$errorCount}");
            return true;

        } catch (Exception $e) {
            Log::error('Error en sincronización de cursos: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Sincronizar un curso individual
     */
    public function syncSingleCourse($moodleCourse)
    {
        // Buscar si el curso ya existe
        $curso = Cursos::where('moodle_id', $moodleCourse['id'])->first();

        // Obtener o crear categoría
        $category = $this->getOrCreateCategory($moodleCourse['categoryid'] ?? 1);

        // Datos del curso
        $courseData = [
            'name' => $moodleCourse['fullname'] ?? $moodleCourse['shortname'],
            'description' => $this->cleanDescription($moodleCourse['summary'] ?? ''),
            'moodle_id' => $moodleCourse['id'],
            'category_id' => $category->id,
            'inactive' => 0,
            'price' => $this->extractPrice($moodleCourse),
            'duracion' => $this->extractDuration($moodleCourse),
            'plazas' => $this->extractPlaces($moodleCourse),
            'lecciones' => $this->extractLessons($moodleCourse),
            'certificado' => $this->hasCertificate($moodleCourse),
            'image' => $this->downloadCourseImage($moodleCourse),
        ];

        if ($curso) {
            // Actualizar curso existente
            $curso->update($courseData);
            Log::info("Curso actualizado: {$curso->name} (Moodle ID: {$moodleCourse['id']})");
        } else {
            // Crear nuevo curso
            $curso = Cursos::create($courseData);
            Log::info("Curso creado: {$curso->name} (Moodle ID: {$moodleCourse['id']})");
        }

        return $curso;
    }

    /**
     * Obtener cursos activos para mostrar en la web
     */
    public function getActiveCourses($limit = null)
    {
        $query = Cursos::with('category')
            ->where('inactive', 0)
            ->whereNotNull('moodle_id')
            ->orderBy('created_at', 'desc');

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }

    /**
     * Obtener un curso específico con toda su información
     */
    public function getCourseDetails($id)
    {
        $curso = Cursos::with('category')->find($id);
        
        if (!$curso || $curso->inactive) {
            return null;
        }

        // Obtener información adicional de Moodle si es necesario
        if ($curso->moodle_id) {
            try {
                $moodleDetails = $this->moodleCourseService->getCourse($curso->moodle_id);
                if ($moodleDetails) {
                    $curso->moodle_details = $moodleDetails;
                }
            } catch (Exception $e) {
                Log::warning("No se pudo obtener detalles de Moodle para curso {$id}: " . $e->getMessage());
            }
        }

        return $curso;
    }

    /**
     * Obtener o crear categoría
     */
    private function getOrCreateCategory($moodleCategoryId)
    {
        try {
            // Obtener información de la categoría desde Moodle
            $moodleCategory = $this->moodleApiService->call('core_course_get_categories', [
                'criteria' => [
                    ['key' => 'id', 'value' => $moodleCategoryId]
                ]
            ]);

            $categoryName = 'General';
            if (!empty($moodleCategory) && isset($moodleCategory[0]['name'])) {
                $categoryName = $moodleCategory[0]['name'];
            }

            // Buscar o crear categoría local
            return Category::firstOrCreate(
                ['name' => $categoryName],
                ['inactive' => 0]
            );

        } catch (Exception $e) {
            Log::warning("Error obteniendo categoría de Moodle: " . $e->getMessage());
            
            // Retornar categoría por defecto
            return Category::firstOrCreate(
                ['name' => 'General'],
                ['inactive' => 0]
            );
        }
    }

    /**
     * Limpiar descripción HTML
     */
    private function cleanDescription($html)
    {
        return strip_tags($html);
    }

    /**
     * Extraer precio del curso (desde campos personalizados o descripción)
     */
    private function extractPrice($moodleCourse)
    {
        // Buscar precio en campos personalizados o descripción
        $price = 0;
        
        // Si hay campos personalizados, buscar precio
        if (isset($moodleCourse['customfields'])) {
            foreach ($moodleCourse['customfields'] as $field) {
                if (stripos($field['name'], 'price') !== false || stripos($field['name'], 'precio') !== false) {
                    $price = floatval($field['value']);
                    break;
                }
            }
        }

        // Si no se encontró precio, usar uno por defecto basado en el nombre
        if ($price == 0) {
            $price = $this->generateDefaultPrice($moodleCourse['fullname'] ?? '');
        }

        return $price;
    }

    /**
     * Generar precio por defecto basado en el nombre del curso
     */
    private function generateDefaultPrice($courseName)
    {
        $name = strtolower($courseName);
        
        // Precios realistas para el mercado español (en euros)
        if (strpos($name, 'básico') !== false || strpos($name, 'basic') !== false) {
            return 89.00;
        } elseif (strpos($name, 'avanzado') !== false || strpos($name, 'advanced') !== false) {
            return 179.00;
        } elseif (strpos($name, 'profesional') !== false || strpos($name, 'professional') !== false) {
            return 259.00;
        }
        
        // Precios basados en área temática
        elseif (strpos($name, 'excel') !== false) {
            return 119.00;
        } elseif (strpos($name, 'seguridad') !== false) {
            return 149.00;
        } elseif (strpos($name, 'prevención') !== false || strpos($name, 'riesgos') !== false) {
            return 139.00;
        } elseif (strpos($name, 'marketing') !== false || strpos($name, 'comercial') !== false) {
            return 169.00;
        } elseif (strpos($name, 'idiomas') !== false || strpos($name, 'inglés') !== false) {
            return 199.00;
        } elseif (strpos($name, 'informática') !== false || strpos($name, 'digital') !== false) {
            return 159.00;
        } elseif (strpos($name, 'gestión') !== false || strpos($name, 'administración') !== false) {
            return 149.00;
        } elseif (strpos($name, 'hostelería') !== false || strpos($name, 'turismo') !== false) {
            return 129.00;
        } elseif (strpos($name, 'guardería') !== false || strpos($name, 'infantil') !== false) {
            return 109.00;
        }
        
        // Precios basados en duración
        elseif (strpos($name, '120 horas') !== false || strpos($name, '100 horas') !== false) {
            return 219.00;
        } elseif (strpos($name, '60 horas') !== false || strpos($name, '80 horas') !== false) {
            return 169.00;
        } elseif (strpos($name, '20 horas') !== false || strpos($name, '30 horas') !== false) {
            return 89.00;
        }
        
        return 129.00; // Precio por defecto
    }

    /**
     * Extraer duración del curso
     */
    private function extractDuration($moodleCourse)
    {
        // Buscar duración en campos personalizados
        if (isset($moodleCourse['customfields'])) {
            foreach ($moodleCourse['customfields'] as $field) {
                if (stripos($field['name'], 'duration') !== false || stripos($field['name'], 'duracion') !== false) {
                    return $field['value'];
                }
            }
        }

        return '40 Horas'; // Duración por defecto
    }

    /**
     * Extraer número de plazas
     */
    private function extractPlaces($moodleCourse)
    {
        // Buscar plazas en campos personalizados
        if (isset($moodleCourse['customfields'])) {
            foreach ($moodleCourse['customfields'] as $field) {
                if (stripos($field['name'], 'places') !== false || stripos($field['name'], 'plazas') !== false) {
                    return intval($field['value']);
                }
            }
        }

        return 25; // Plazas por defecto
    }

    /**
     * Extraer número de lecciones
     */
    private function extractLessons($moodleCourse)
    {
        try {
            // Obtener contenido del curso para contar lecciones
            $contents = $this->moodleCourseService->getCourseContents($moodleCourse['id']);
            $lessonCount = 0;
            
            if ($contents) {
                foreach ($contents as $section) {
                    if (isset($section['modules'])) {
                        $lessonCount += count($section['modules']);
                    }
                }
            }
            
            return $lessonCount > 0 ? $lessonCount : 8; // Mínimo 8 lecciones
        } catch (Exception $e) {
            return 8; // Valor por defecto
        }
    }

    /**
     * Verificar si el curso tiene certificado
     */
    private function hasCertificate($moodleCourse)
    {
        // Buscar certificado en campos personalizados
        if (isset($moodleCourse['customfields'])) {
            foreach ($moodleCourse['customfields'] as $field) {
                if (stripos($field['name'], 'certificate') !== false || stripos($field['name'], 'certificado') !== false) {
                    return $field['value'] === '1' || strtolower($field['value']) === 'yes' || strtolower($field['value']) === 'sí';
                }
            }
        }

        return true; // Por defecto, todos los cursos tienen certificado
    }

    /**
     * Descargar imagen del curso desde Moodle
     */
    private function downloadCourseImage($moodleCourse)
    {
        try {
            // Si el curso tiene imagen en Moodle, descargarla
            if (isset($moodleCourse['courseimage'])) {
                $imageUrl = $moodleCourse['courseimage'];
                $imageName = 'courses/' . $moodleCourse['id'] . '_' . time() . '.jpg';
                
                // Descargar y guardar imagen
                $imageContent = file_get_contents($imageUrl);
                if ($imageContent) {
                    Storage::disk('public')->put($imageName, $imageContent);
                    return $imageName;
                }
            }
        } catch (Exception $e) {
            Log::warning("Error descargando imagen del curso {$moodleCourse['id']}: " . $e->getMessage());
        }

        return null; // Sin imagen
    }

    /**
     * Sincronizar categorías de Moodle
     */
    private function syncCategories()
    {
        try {
            Log::info('Sincronizando categorías desde Moodle');
            
            // Obtener categorías de Moodle
            $moodleCategories = $this->moodleCourseService->getCategories();
            
            if (empty($moodleCategories)) {
                Log::warning('No se obtuvieron categorías desde Moodle');
                return;
            }

            $syncedCount = 0;
            $updatedCount = 0;

            foreach ($moodleCategories as $moodleCategory) {
                try {
                    // Saltar la categoría "Miscellaneous" (ID 1) que es la categoría por defecto
                    if ($moodleCategory['id'] == 1) {
                        continue;
                    }

                    $result = $this->syncSingleCategory($moodleCategory);
                    
                    if ($result['created']) {
                        $syncedCount++;
                        Log::info("Categoría creada: {$moodleCategory['name']} (Moodle ID: {$moodleCategory['id']})");
                    } else {
                        $updatedCount++;
                        Log::info("Categoría actualizada: {$moodleCategory['name']} (Moodle ID: {$moodleCategory['id']})");
                    }
                    
                } catch (Exception $e) {
                    Log::error("Error sincronizando categoría {$moodleCategory['name']}: " . $e->getMessage());
                }
            }

            Log::info("Categorías sincronizadas. Creadas: {$syncedCount}, Actualizadas: {$updatedCount}");
            
        } catch (Exception $e) {
            Log::error('Error en sincronización de categorías: ' . $e->getMessage());
        }
    }

    /**
     * Sincronizar una categoría individual
     */
    private function syncSingleCategory($moodleCategory)
    {
        // Buscar si la categoría ya existe por nombre
        $category = Category::where('name', $moodleCategory['name'])->first();

        $categoryData = [
            'name' => $moodleCategory['name'],
            'inactive' => 0,
            'image' => null, // Las categorías de Moodle no tienen imagen por defecto
        ];

        $created = false;

        if ($category) {
            // Actualizar categoría existente
            $category->update($categoryData);
        } else {
            // Crear nueva categoría
            $category = Category::create($categoryData);
            $created = true;
        }

        return [
            'category' => $category,
            'created' => $created
        ];
    }
}
