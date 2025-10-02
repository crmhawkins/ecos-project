<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CoursesSyncService;

class SyncMoodleCourses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moodle:sync-courses {--force : Force sync even if recently synced}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincronizar cursos desde Moodle a la base de datos local';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Iniciando sincronización de cursos desde Moodle...');
        
        $coursesSyncService = app(CoursesSyncService::class);
        
        // Verificar si forzar sincronización
        $force = $this->option('force');
        
        if (!$force) {
            $lastSync = cache('courses_last_sync');
            if ($lastSync && now()->diffInMinutes($lastSync) < 10) {
                $this->warn('⚠️  Los cursos fueron sincronizados recientemente. Usa --force para forzar la sincronización.');
                return;
            }
        }
        
        try {
            $this->info('📡 Conectando con Moodle...');
            
            $result = $coursesSyncService->syncAllCourses();
            
            if ($result) {
                cache(['courses_last_sync' => now()], 30 * 60); // Cache por 30 minutos
                $this->info('✅ Sincronización completada exitosamente!');
                
                // Mostrar estadísticas
                $totalCourses = \App\Models\Cursos\Cursos::whereNotNull('moodle_id')->count();
                $this->info("📊 Total de cursos sincronizados: {$totalCourses}");
                
            } else {
                $this->error('❌ Error durante la sincronización');
                return 1;
            }
            
        } catch (\Exception $e) {
            $this->error('💥 Error: ' . $e->getMessage());
            return 1;
        }
        
        return 0;
    }
}