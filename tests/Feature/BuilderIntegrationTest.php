<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BuilderIntegrationTest extends TestCase
{
    /**
     * Test de integración: Verifica que todos los componentes principales están conectados
     */
    public function test_builder_integration_all_components_connected(): void
    {
        // Verificar que el archivo principal del builder existe
        $builderView = resource_path('views/builder/builder.blade.php');
        $this->assertFileExists($builderView, 'La vista del builder debe existir');
        
        // Verificar que el controlador existe
        $controller = app_path('Http/Controllers/Builder/BuilderController.php');
        $this->assertFileExists($controller, 'El controlador BuilderController debe existir');
        
        // Verificar que el archivo de bloques personalizados existe
        $customBlocks = public_path('js/builder-custom-blocks.js');
        $this->assertFileExists($customBlocks, 'El archivo de bloques personalizados debe existir');
    }

    /**
     * Test que verifica que el sistema de formularios está completo
     */
    public function test_form_system_is_complete(): void
    {
        $filePath = public_path('js/builder-custom-blocks.js');
        $content = file_get_contents($filePath);
        
        // Verificar formulario avanzado
        $this->assertStringContainsString('advancedForm:', $content);
        $this->assertStringContainsString("domc.addType('advanced-form'", $content);
        
        // Verificar que todos los campos están registrados
        $fields = ['text', 'email', 'textarea', 'select', 'checkbox', 'file'];
        foreach ($fields as $field) {
            $this->assertStringContainsString("formField{$field}:", $content,
                "El campo {$field} debe estar definido");
            $this->assertStringContainsString("registerFormFieldComponent('{$field}'", $content,
                "El componente form-field-{$field} debe estar registrado");
        }
    }

    /**
     * Test que verifica que el sistema de menú está completo
     */
    public function test_menu_system_is_complete(): void
    {
        // Verificar controlador
        $controller = app_path('Http/Controllers/Builder/MenuController.php');
        $this->assertFileExists($controller);
        
        // Verificar modelo
        $model = app_path('Models/Web/WebMenuItem.php');
        $this->assertFileExists($model);
        
        // Verificar que las rutas están definidas
        $routes = base_path('routes/web.php');
        $content = file_get_contents($routes);
        
        $this->assertStringContainsString("Route::get('/builder/menu'", $content);
        $this->assertStringContainsString("Route::post('/builder/menu'", $content);
        $this->assertStringContainsString("Route::put('/builder/menu/{id}'", $content);
        $this->assertStringContainsString("Route::delete('/builder/menu/{id}'", $content);
        $this->assertStringContainsString("Route::post('/builder/menu/reorder'", $content);
    }

    /**
     * Test que verifica que el sistema de SEO está completo
     */
    public function test_seo_system_is_complete(): void
    {
        $controller = app_path('Http/Controllers/Builder/BuilderController.php');
        $content = file_get_contents($controller);
        
        // Verificar métodos
        $this->assertStringContainsString('getPageMetadata(', $content);
        $this->assertStringContainsString('savePageMetadata(', $content);
        
        // Verificar rutas
        $routes = base_path('routes/web.php');
        $routesContent = file_get_contents($routes);
        
        $this->assertStringContainsString("Route::get('/builder/page-metadata'", $routesContent);
        $this->assertStringContainsString("Route::post('/builder/page-metadata/save'", $routesContent);
    }

    /**
     * Test que verifica que el sistema de cookies está completo
     */
    public function test_cookie_system_is_complete(): void
    {
        $controller = app_path('Http/Controllers/Builder/BuilderController.php');
        $content = file_get_contents($controller);
        
        // Verificar métodos
        $this->assertStringContainsString('getCookiesText()', $content);
        $this->assertStringContainsString('saveCookiesText(', $content);
        
        // Verificar rutas
        $routes = base_path('routes/web.php');
        $routesContent = file_get_contents($routes);
        
        $this->assertStringContainsString("Route::get('/builder/cookies'", $routesContent);
        $this->assertStringContainsString("Route::post('/builder/cookies/save'", $routesContent);
    }

    /**
     * Test que verifica que el sistema de PDF está completo
     */
    public function test_pdf_system_is_complete(): void
    {
        $filePath = public_path('js/builder-custom-blocks.js');
        $content = file_get_contents($filePath);
        
        // Verificar bloque
        $this->assertStringContainsString('pdfViewer:', $content);
        
        // Verificar componente
        $this->assertStringContainsString("domc.addType('pdf-viewer-container'", $content);
        
        // Verificar trait
        $this->assertStringContainsString("name: 'data-pdf-url'", $content);
    }

    /**
     * Test que verifica que todos los plugins están correctamente configurados
     */
    public function test_all_plugins_are_configured(): void
    {
        $filePath = resource_path('views/builder/builder.blade.php');
        $content = file_get_contents($filePath);
        
        $plugins = [
            'grapesjs-user-blocks' => [
                'script' => 'grapesjs-user-blocks.min.js',
                'config' => 'grapesjs-user-blocks'
            ],
            'grapesjs-templates' => [
                'script' => 'grapesjs-templates.min.js',
                'config' => 'grapesjs-templates'
            ],
            'grapesjs-plugin-toolbox' => [
                'script' => 'grapesjs-plugin-toolbox.min.js',
                'config' => 'grapesjs-plugin-toolbox'
            ],
            'grapesjs-component-code-editor' => [
                'script' => 'grapesjs-component-code-editor.min.js',
                'config' => 'grapesjs-component-code-editor'
            ]
        ];
        
        foreach ($plugins as $pluginName => $config) {
            // Verificar que el script está cargado
            $this->assertStringContainsString($config['script'], $content,
                "El script {$config['script']} debe estar cargado");
            
            // Verificar que está en el array de plugins
            $this->assertStringContainsString("'{$pluginName}'", $content,
                "El plugin {$pluginName} debe estar en el array de plugins");
            
            // Verificar que está en pluginsOpts
            $this->assertStringContainsString("'{$config['config']}':", $content,
                "El plugin {$pluginName} debe tener configuración en pluginsOpts");
        }
    }

    /**
     * Test que verifica que el sistema de formularios tiene el endpoint correcto
     */
    public function test_form_submit_endpoint_exists(): void
    {
        $routes = base_path('routes/web.php');
        $content = file_get_contents($routes);
        
        $this->assertStringContainsString("Route::post('/builder/form-submit'", $content,
            'La ruta para enviar formularios debe existir');
        
        $controller = app_path('Http/Controllers/Builder/BuilderController.php');
        $controllerContent = file_get_contents($controller);
        
        $this->assertStringContainsString('handleFormSubmit(', $controllerContent,
            'El método handleFormSubmit debe existir');
    }

    /**
     * Test que verifica que todos los bloques personalizados están definidos
     */
    public function test_all_custom_blocks_are_defined(): void
    {
        $filePath = public_path('js/builder-custom-blocks.js');
        $content = file_get_contents($filePath);
        
        $blocks = [
            'heroSection',
            'cardModern',
            'contactForm',
            'pdfViewer',
            'cookieBanner',
            'advancedForm',
            'formFieldText',
            'formFieldEmail',
            'formFieldTextarea',
            'formFieldSelect',
            'formFieldCheckbox',
            'formFieldFile'
        ];
        
        foreach ($blocks as $block) {
            $this->assertStringContainsString("{$block}:", $content,
                "El bloque {$block} debe estar definido");
        }
    }
}
