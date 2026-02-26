<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BuilderFormFieldsTest extends TestCase
{
    /**
     * Test que verifica que el archivo JavaScript de bloques personalizados existe
     */
    public function test_custom_blocks_js_file_exists(): void
    {
        $filePath = public_path('js/builder-custom-blocks.js');
        $this->assertFileExists($filePath, 'El archivo builder-custom-blocks.js debe existir');
    }

    /**
     * Test que verifica que el archivo contiene las funciones de registro de componentes
     */
    public function test_custom_blocks_contains_form_field_registration(): void
    {
        $filePath = public_path('js/builder-custom-blocks.js');
        $content = file_get_contents($filePath);
        
        // Verificar que contiene la función de registro
        $this->assertStringContainsString('registerFormFieldComponent', $content, 
            'El archivo debe contener la función registerFormFieldComponent');
        
        // Verificar que registra los tipos de campos
        $this->assertStringContainsString("registerFormFieldComponent('text'", $content,
            'Debe registrar el componente form-field-text');
        $this->assertStringContainsString("registerFormFieldComponent('email'", $content,
            'Debe registrar el componente form-field-email');
        $this->assertStringContainsString("registerFormFieldComponent('textarea'", $content,
            'Debe registrar el componente form-field-textarea');
        $this->assertStringContainsString("registerFormFieldComponent('select'", $content,
            'Debe registrar el componente form-field-select');
        $this->assertStringContainsString("registerFormFieldComponent('checkbox'", $content,
            'Debe registrar el componente form-field-checkbox');
        $this->assertStringContainsString("registerFormFieldComponent('file'", $content,
            'Debe registrar el componente form-field-file');
    }

    /**
     * Test que verifica que los traits están definidos correctamente
     */
    public function test_form_field_components_have_traits(): void
    {
        $filePath = public_path('js/builder-custom-blocks.js');
        $content = file_get_contents($filePath);
        
        // Verificar que contiene los traits necesarios
        $this->assertStringContainsString("name: 'field-label'", $content,
            'Debe tener el trait field-label');
        $this->assertStringContainsString("name: 'field-placeholder'", $content,
            'Debe tener el trait field-placeholder');
        $this->assertStringContainsString("name: 'field-name'", $content,
            'Debe tener el trait field-name');
        $this->assertStringContainsString("name: 'field-required'", $content,
            'Debe tener el trait field-required');
    }

    /**
     * Test que verifica que el listener de component:add está configurado
     */
    public function test_component_add_listener_exists(): void
    {
        $filePath = public_path('js/builder-custom-blocks.js');
        $content = file_get_contents($filePath);
        
        // Verificar que contiene el listener
        $this->assertStringContainsString("editor.on('component:add'", $content,
            'Debe tener el listener component:add para convertir componentes');
        $this->assertStringContainsString("checkAndConvert", $content,
            'Debe tener la función checkAndConvert');
    }

    /**
     * Test que verifica que la vista onRender está definida
     */
    public function test_form_field_view_onrender_exists(): void
    {
        $filePath = public_path('js/builder-custom-blocks.js');
        $content = file_get_contents($filePath);
        
        // Verificar que contiene la vista onRender
        $this->assertStringContainsString("view: {", $content,
            'Debe tener la definición de view');
        $this->assertStringContainsString("onRender()", $content,
            'Debe tener el método onRender en la vista');
    }

    /**
     * Test que verifica que los bloques de formulario están definidos
     */
    public function test_form_field_blocks_are_defined(): void
    {
        $filePath = public_path('js/builder-custom-blocks.js');
        $content = file_get_contents($filePath);
        
        // Verificar que los bloques están definidos
        $this->assertStringContainsString("formFieldText:", $content,
            'Debe tener el bloque formFieldText');
        $this->assertStringContainsString("formFieldEmail:", $content,
            'Debe tener el bloque formFieldEmail');
        $this->assertStringContainsString("formFieldTextarea:", $content,
            'Debe tener el bloque formFieldTextarea');
        $this->assertStringContainsString("formFieldSelect:", $content,
            'Debe tener el bloque formFieldSelect');
        $this->assertStringContainsString("formFieldCheckbox:", $content,
            'Debe tener el bloque formFieldCheckbox');
        $this->assertStringContainsString("formFieldFile:", $content,
            'Debe tener el bloque formFieldFile');
    }
}
