<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BuilderCompleteFeaturesTest extends TestCase
{
    /**
     * Test que verifica que todos los plugins de GrapeJS están cargados
     */
    public function test_all_grapesjs_plugins_are_loaded(): void
    {
        $filePath = resource_path('views/builder/builder.blade.php');
        $content = file_get_contents($filePath);
        
        // Verificar que todos los plugins están en el archivo
        $plugins = [
            'grapesjs-user-blocks',
            'grapesjs-templates',
            'grapesjs-plugin-toolbox',
            'grapesjs-component-code-editor',
            'grapesjs-tabs'
        ];
        
        foreach ($plugins as $plugin) {
            $this->assertStringContainsString($plugin, $content, 
                "El plugin {$plugin} debe estar cargado");
        }
    }

    /**
     * Test que verifica que los plugins están en el array de plugins
     */
    public function test_plugins_are_in_plugins_array(): void
    {
        $filePath = resource_path('views/builder/builder.blade.php');
        $content = file_get_contents($filePath);
        
        // Verificar que los plugins están en el array de plugins
        $this->assertStringContainsString("'grapesjs-user-blocks'", $content,
            'grapesjs-user-blocks debe estar en el array de plugins');
        $this->assertStringContainsString("'grapesjs-templates'", $content,
            'grapesjs-templates debe estar en el array de plugins');
        $this->assertStringContainsString("'grapesjs-plugin-toolbox'", $content,
            'grapesjs-plugin-toolbox debe estar en el array de plugins');
        $this->assertStringContainsString("'grapesjs-component-code-editor'", $content,
            'grapesjs-component-code-editor debe estar en el array de plugins');
    }

    /**
     * Test que verifica que el visor PDF está implementado
     */
    public function test_pdf_viewer_is_implemented(): void
    {
        $filePath = public_path('js/builder-custom-blocks.js');
        $content = file_get_contents($filePath);
        
        // Verificar que el bloque PDF está definido
        $this->assertStringContainsString('pdfViewer:', $content,
            'El bloque pdfViewer debe estar definido');
        
        // Verificar que el componente está registrado
        $this->assertStringContainsString("domc.addType('pdf-viewer-container'", $content,
            'El componente pdf-viewer-container debe estar registrado');
        
        // Verificar que tiene el trait para la URL
        $this->assertStringContainsString("name: 'data-pdf-url'", $content,
            'El componente debe tener el trait data-pdf-url');
    }

    /**
     * Test que verifica que el editor de cookies está implementado
     */
    public function test_cookie_editor_is_implemented(): void
    {
        $filePath = resource_path('views/builder/builder.blade.php');
        $content = file_get_contents($filePath);
        
        // Verificar que el modal existe
        $this->assertStringContainsString('cookiesEditorModal', $content,
            'El modal de cookies debe existir');
        
        // Verificar que las funciones JavaScript existen
        $this->assertStringContainsString('showCookiesEditor()', $content,
            'La función showCookiesEditor debe existir');
        $this->assertStringContainsString('saveCookiesText()', $content,
            'La función saveCookiesText debe existir');
        
        // Verificar que el botón existe
        $this->assertStringContainsString('showCookiesEditor()', $content,
            'El botón para abrir el editor de cookies debe existir');
    }

    /**
     * Test que verifica que el controlador tiene métodos para cookies
     */
    public function test_controller_has_cookie_methods(): void
    {
        $filePath = app_path('Http/Controllers/Builder/BuilderController.php');
        $content = file_get_contents($filePath);
        
        // Verificar que los métodos existen
        $this->assertStringContainsString('getCookiesText()', $content,
            'El método getCookiesText debe existir');
        $this->assertStringContainsString('saveCookiesText(', $content,
            'El método saveCookiesText debe existir');
    }

    /**
     * Test que verifica que el editor de URL/SEO está implementado
     */
    public function test_seo_editor_is_implemented(): void
    {
        $filePath = resource_path('views/builder/builder.blade.php');
        $content = file_get_contents($filePath);
        
        // Verificar que el modal existe
        $this->assertStringContainsString('pageMetadataModal', $content,
            'El modal de metadatos debe existir');
        
        // Verificar que las funciones JavaScript existen
        $this->assertStringContainsString('showPageMetadataEditor()', $content,
            'La función showPageMetadataEditor debe existir');
        $this->assertStringContainsString('savePageMetadata()', $content,
            'La función savePageMetadata debe existir');
        
        // Verificar que los campos del formulario existen
        $this->assertStringContainsString('metadataSlug', $content,
            'El campo slug debe existir');
        $this->assertStringContainsString('metadataTitle', $content,
            'El campo title debe existir');
        $this->assertStringContainsString('metadataDescription', $content,
            'El campo description debe existir');
    }

    /**
     * Test que verifica que el controlador tiene métodos para SEO
     */
    public function test_controller_has_seo_methods(): void
    {
        $filePath = app_path('Http/Controllers/Builder/BuilderController.php');
        $content = file_get_contents($filePath);
        
        // Verificar que los métodos existen
        $this->assertStringContainsString('getPageMetadata(', $content,
            'El método getPageMetadata debe existir');
        $this->assertStringContainsString('savePageMetadata(', $content,
            'El método savePageMetadata debe existir');
    }

    /**
     * Test que verifica que el gestor de menú está implementado
     */
    public function test_menu_manager_is_implemented(): void
    {
        $filePath = resource_path('views/builder/builder.blade.php');
        $content = file_get_contents($filePath);
        
        // Verificar que el modal existe
        $this->assertStringContainsString('menuManagerModal', $content,
            'El modal de menú debe existir');
        
        // Verificar que las funciones JavaScript existen
        $this->assertStringContainsString('showMenuManager()', $content,
            'La función showMenuManager debe existir');
        $this->assertStringContainsString('saveMenuItem(', $content,
            'La función saveMenuItem debe existir');
        $this->assertStringContainsString('deleteMenuItem(', $content,
            'La función deleteMenuItem debe existir');
        $this->assertStringContainsString('updateMenuOrder()', $content,
            'La función updateMenuOrder debe existir');
    }

    /**
     * Test que verifica que el controlador de menú existe
     */
    public function test_menu_controller_exists(): void
    {
        $filePath = app_path('Http/Controllers/Builder/MenuController.php');
        $this->assertFileExists($filePath, 'El controlador MenuController debe existir');
        
        $content = file_get_contents($filePath);
        
        // Verificar que los métodos existen
        $this->assertStringContainsString('public function index()', $content,
            'El método index debe existir');
        $this->assertStringContainsString('public function store(', $content,
            'El método store debe existir');
        $this->assertStringContainsString('public function update(', $content,
            'El método update debe existir');
        $this->assertStringContainsString('public function destroy(', $content,
            'El método destroy debe existir');
        $this->assertStringContainsString('public function reorder(', $content,
            'El método reorder debe existir');
    }

    /**
     * Test que verifica que el modelo WebMenuItem existe
     */
    public function test_web_menu_item_model_exists(): void
    {
        $filePath = app_path('Models/Web/WebMenuItem.php');
        $this->assertFileExists($filePath, 'El modelo WebMenuItem debe existir');
    }

    /**
     * Test que verifica que los formularios avanzados están implementados
     */
    public function test_advanced_forms_are_implemented(): void
    {
        $filePath = public_path('js/builder-custom-blocks.js');
        $content = file_get_contents($filePath);
        
        // Verificar que el bloque de formulario avanzado existe
        $this->assertStringContainsString('advancedForm:', $content,
            'El bloque advancedForm debe estar definido');
        
        // Verificar que el componente está registrado
        $this->assertStringContainsString("domc.addType('advanced-form'", $content,
            'El componente advanced-form debe estar registrado');
        
        // Verificar que tiene el trait para el email
        $this->assertStringContainsString("name: 'data-form-email'", $content,
            'El componente debe tener el trait data-form-email');
    }

    /**
     * Test que verifica que el controlador tiene método para procesar formularios
     */
    public function test_controller_has_form_submit_method(): void
    {
        $filePath = app_path('Http/Controllers/Builder/BuilderController.php');
        $content = file_get_contents($filePath);
        
        // Verificar que el método existe
        $this->assertStringContainsString('handleFormSubmit(', $content,
            'El método handleFormSubmit debe existir');
    }

    /**
     * Test que verifica que las rutas están definidas
     */
    public function test_routes_are_defined(): void
    {
        $filePath = base_path('routes/web.php');
        $content = file_get_contents($filePath);
        
        // Verificar rutas de cookies
        $this->assertStringContainsString('/builder/cookies', $content,
            'La ruta de cookies debe existir');
        
        // Verificar rutas de SEO
        $this->assertStringContainsString('/builder/page-metadata', $content,
            'La ruta de metadatos debe existir');
        
        // Verificar rutas de menú
        $this->assertStringContainsString('/builder/menu', $content,
            'La ruta de menú debe existir');
        
        // Verificar ruta de formularios
        $this->assertStringContainsString('/builder/form-submit', $content,
            'La ruta de formularios debe existir');
    }

    /**
     * Test que verifica que todos los tipos de campos de formulario están implementados
     */
    public function test_all_form_field_types_are_implemented(): void
    {
        $filePath = public_path('js/builder-custom-blocks.js');
        $content = file_get_contents($filePath);
        
        $fieldTypes = ['text', 'email', 'textarea', 'select', 'checkbox', 'file'];
        
        foreach ($fieldTypes as $type) {
            // Verificar que el bloque está definido
            $this->assertStringContainsString("formField{$type}:", $content,
                "El bloque formField{$type} debe estar definido");
            
            // Verificar que el componente está registrado
            $this->assertStringContainsString("registerFormFieldComponent('{$type}'", $content,
                "El componente form-field-{$type} debe estar registrado");
        }
    }

    /**
     * Test que verifica que los archivos de plugins existen
     */
    public function test_plugin_files_exist(): void
    {
        $plugins = [
            'grapesjs-user-blocks.min.js',
            'grapesjs-templates.min.js',
            'grapesjs-plugin-toolbox.min.js',
            'grapesjs-component-code-editor.min.js',
            'grapesjs-tabs.min.js'
        ];
        
        foreach ($plugins as $plugin) {
            $filePath = public_path("vendor/grapesjs/{$plugin}");
            $this->assertFileExists($filePath, "El archivo {$plugin} debe existir");
        }
    }

    /**
     * Test que verifica que el bloque de cookie banner está implementado
     */
    public function test_cookie_banner_block_is_implemented(): void
    {
        $filePath = public_path('js/builder-custom-blocks.js');
        $content = file_get_contents($filePath);
        
        // Verificar que el bloque existe
        $this->assertStringContainsString('cookieBanner:', $content,
            'El bloque cookieBanner debe estar definido');
    }
}
