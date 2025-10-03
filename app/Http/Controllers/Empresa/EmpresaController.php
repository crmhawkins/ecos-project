<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display the company details page.
     */
    public function index()
    {
        // Datos de la empresa (puedes obtenerlos de la base de datos o configuración)
        $empresa = [
            'nombre' => 'Ecos Formación',
            'descripcion' => 'Centro de formación especializado en desarrollo profesional y competencias digitales.',
            'direccion' => 'Calle Ejemplo, 123',
            'ciudad' => 'Madrid',
            'codigo_postal' => '28001',
            'telefono' => '+34 900 123 456',
            'email' => 'info@ecosformacion.com',
            'web' => 'https://www.ecosformacion.com',
            'cif' => 'B12345678',
            'sector' => 'Formación y Educación',
            'fecha_creacion' => '2020-01-15',
            'empleados' => 25,
            'estudiantes' => 1500,
            'cursos_activos' => 45,
            'aulas_disponibles' => 8
        ];

        return view('crm.empresa.index', compact('empresa'));
    }

    /**
     * Show the form for editing company details.
     */
    public function edit()
    {
        // Datos de la empresa (puedes obtenerlos de la base de datos o configuración)
        $empresa = [
            'nombre' => 'Ecos Formación',
            'descripcion' => 'Centro de formación especializado en desarrollo profesional y competencias digitales.',
            'direccion' => 'Calle Ejemplo, 123',
            'ciudad' => 'Madrid',
            'codigo_postal' => '28001',
            'telefono' => '+34 900 123 456',
            'email' => 'info@ecosformacion.com',
            'web' => 'https://www.ecosformacion.com',
            'cif' => 'B12345678',
            'sector' => 'Formación y Educación',
            'fecha_creacion' => '2020-01-15',
            'empleados' => 25,
            'estudiantes' => 1500,
            'cursos_activos' => 45,
            'aulas_disponibles' => 8
        ];

        return view('crm.empresa.edit', compact('empresa'));
    }

    /**
     * Update company details.
     */
    public function update(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'cif' => 'required|string|max:20',
            'sector' => 'required|string|max:100',
            'empleados' => 'nullable|integer|min:0',
            'estudiantes' => 'nullable|integer|min:0',
            'cursos_activos' => 'nullable|integer|min:0',
            'aulas_disponibles' => 'nullable|integer|min:0',
        ], [
            'nombre.required' => 'El nombre de la empresa es requerido',
            'descripcion.required' => 'La descripción es requerida',
            'direccion.required' => 'La dirección es requerida',
            'ciudad.required' => 'La ciudad es requerida',
            'telefono.required' => 'El teléfono es requerido',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email debe tener un formato válido',
            'cif.required' => 'El CIF es requerido',
            'sector.required' => 'El sector es requerido',
            'empleados.integer' => 'El número de empleados debe ser un número entero',
            'empleados.min' => 'El número de empleados no puede ser negativo',
            'estudiantes.integer' => 'El número de estudiantes debe ser un número entero',
            'estudiantes.min' => 'El número de estudiantes no puede ser negativo',
            'cursos_activos.integer' => 'El número de cursos activos debe ser un número entero',
            'cursos_activos.min' => 'El número de cursos activos no puede ser negativo',
            'aulas_disponibles.integer' => 'El número de aulas disponibles debe ser un número entero',
            'aulas_disponibles.min' => 'El número de aulas disponibles no puede ser negativo',
        ]);

        // Aquí guardarías los datos en la base de datos
        // Por ahora solo mostramos un mensaje de éxito
        
        return redirect()->route('empresa.index')->with('success', 'Información de la empresa actualizada exitosamente.');
    }
}
