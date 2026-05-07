<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Company\CompanyDetails;
use App\Models\Cursos\Cursos;
use App\Models\Alumnos\Alumno;
use App\Models\Aulas\Aulas;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmpresaController extends Controller
{
    private function getEmpresaData(): array
    {
        try {
            $company = CompanyDetails::first();
        } catch (\Throwable $e) {
            $company = null;
        }

        return [
            'nombre'      => $company?->company_name ?? 'Grupo ECOS',
            'descripcion' => 'Centro de formación con más de 30 años de experiencia en Ceuta, Estepona y Melilla.',
            'direccion'   => $company?->address ?? 'Poblado Marinero, locales 25, 44, 45 y 46',
            'ciudad'      => $company?->town ?? 'Ceuta',
            'codigo_postal' => $company?->postCode ?? '51001',
            'telefono'    => $company?->telephone ?? '956 52 50 68',
            'email'       => $company?->email ?? 'academia@grupoecos.net',
            'web'         => $company?->website ?? 'https://www.formacionecos.es',
            'cif'         => $company?->nif ?? '',
            'sector'      => 'Formación y Educación',
        ];
    }

    private function getStats(): array
    {
        try {
            $cursos = Cursos::where('inactive', 0)->where('published', 1)->count();
        } catch (\Throwable $e) {
            $cursos = 0;
        }

        try {
            $alumnos = Alumno::count();
        } catch (\Throwable $e) {
            $alumnos = 0;
        }

        try {
            $aulas = Aulas::where('inactive', 0)->count();
        } catch (\Throwable $e) {
            $aulas = 0;
        }

        try {
            $empleados = User::count();
        } catch (\Throwable $e) {
            $empleados = 0;
        }

        return [
            'cursos_activos'    => $cursos,
            'estudiantes'       => $alumnos,
            'aulas_disponibles' => $aulas,
            'empleados'         => $empleados,
        ];
    }

    public function index()
    {
        $empresa = $this->getEmpresaData();
        $stats   = $this->getStats();

        return view('crm.empresa.index', compact('empresa', 'stats'));
    }

    public function edit()
    {
        $empresa = $this->getEmpresaData();

        return view('crm.empresa.edit', compact('empresa'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'required|string',
            'direccion'   => 'required|string|max:255',
            'ciudad'      => 'required|string|max:100',
            'telefono'    => 'required|string|max:20',
            'email'       => 'required|email|max:255',
            'cif'         => 'required|string|max:20',
            'sector'      => 'required|string|max:100',
        ]);

        try {
            $company = CompanyDetails::firstOrNew([]);
            $company->company_name = $request->nombre;
            $company->address      = $request->direccion;
            $company->town         = $request->ciudad;
            $company->telephone    = $request->telefono;
            $company->email        = $request->email;
            $company->nif          = $request->cif;
            $company->save();
        } catch (\Throwable $e) {
            Log::warning('EmpresaController: no se pudo guardar en company_details: ' . $e->getMessage());
        }

        return redirect()->route('empresa.index')->with('success', 'Información de la empresa actualizada correctamente.');
    }
}
