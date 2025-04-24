<?php

namespace App\Modules\Moodle\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class MoodleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Register module configuration
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'moodle'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Load routes
        $this->loadRoutes();
        
        // Load views
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'moodle');
        
        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        
        // Publish configuration
        $this->publishConfig();
        
        // Publish views
        $this->publishViews();
    }
    
    /**
     * Load module routes.
     *
     * @return void
     */
    protected function loadRoutes()
    {
        Route::middleware('web')
            ->group(function () {
                require __DIR__.'/../Routes/admin.php';
                require __DIR__.'/../Routes/student.php';
                require __DIR__.'/../Routes/certificate.php';
            });
    }
    
    /**
     * Publish module configuration.
     *
     * @return void
     */
    protected function publishConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('moodle.php'),
        ], 'moodle-config');
    }
    
    /**
     * Publish module views.
     *
     * @return void
     */
    protected function publishViews()
    {
        $this->publishes([
            __DIR__.'/../Resources/views' => resource_path('views/vendor/moodle'),
        ], 'moodle-views');
    }
}
