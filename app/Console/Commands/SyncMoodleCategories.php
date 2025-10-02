<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cursos\Category;
use App\Modules\Moodle\Services\MoodleCourseService;
use Illuminate\Support\Facades\Log;
use Exception;

class SyncMoodleCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moodle:sync-categories {--force : Force sync even if recently synced}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincronizar categorías desde Moodle a la base de datos local';

    protected $moodleCourseService;

    public function __construct()
    {
        parent::__construct();
        $this->moodleCourseService = app(MoodleCourseService::class);
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Iniciando sincronización de categorías desde Moodle...');
        
        // Verificar si forzar sincronización
        $force = $this->option('force');
        
        if (!$force) {
            $lastSync = cache('categories_last_sync');
            if ($lastSync && now()->diffInMinutes($lastSync) < 30) {
                $this->warn('⚠️  Las categorías fueron sincronizadas recientemente. Usa --force para forzar la sincronización.');
                return;
            }
        }
        
        try {
            $this->info('📡 Conectando con Moodle...');
            
            // Obtener categorías de Moodle
            $moodleCategories = $this->moodleCourseService->getCategories();
            
            if (empty($moodleCategories)) {
                $this->warn('⚠️  No se obtuvieron categorías desde Moodle');
                return 1;
            }

            $this->info('📊 Categorías obtenidas de Moodle: ' . count($moodleCategories));
            
            $syncedCount = 0;
            $updatedCount = 0;
            $errorCount = 0;

            foreach ($moodleCategories as $moodleCategory) {
                try {
                    // Saltar la categoría "Miscellaneous" (ID 1) que es la categoría por defecto
                    if ($moodleCategory['id'] == 1) {
                        continue;
                    }

                    $result = $this->syncSingleCategory($moodleCategory);
                    
                    if ($result['created']) {
                        $syncedCount++;
                        $this->line("✅ Categoría creada: {$moodleCategory['name']} (Moodle ID: {$moodleCategory['id']})");
                    } else {
                        $updatedCount++;
                        $this->line("🔄 Categoría actualizada: {$moodleCategory['name']} (Moodle ID: {$moodleCategory['id']})");
                    }
                    
                } catch (Exception $e) {
                    $errorCount++;
                    $this->error("❌ Error sincronizando categoría {$moodleCategory['name']}: " . $e->getMessage());
                    Log::error("Error sincronizando categoría {$moodleCategory['id']}: " . $e->getMessage());
                }
            }

            // Actualizar caché
            cache(['categories_last_sync' => now()], 30 * 60); // Cache por 30 minutos
            
            $this->info('✅ Sincronización completada!');
            $this->info("📊 Estadísticas:");
            $this->info("   - Categorías creadas: {$syncedCount}");
            $this->info("   - Categorías actualizadas: {$updatedCount}");
            $this->info("   - Errores: {$errorCount}");
            
            // Mostrar total de categorías
            $totalCategories = Category::where('inactive', 0)->count();
            $this->info("   - Total categorías activas: {$totalCategories}");
            
            return 0;
            
        } catch (Exception $e) {
            $this->error('❌ Error durante la sincronización: ' . $e->getMessage());
            Log::error('Error en sincronización de categorías: ' . $e->getMessage());
            return 1;
        }
    }

    /**
     * Sincronizar una categoría individual
     */
    private function syncSingleCategory($moodleCategory)
    {
        // Buscar si la categoría ya existe por nombre (ya que no tenemos moodle_id en categorías)
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
