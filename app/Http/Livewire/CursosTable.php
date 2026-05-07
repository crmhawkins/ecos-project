<?php

namespace App\Http\Livewire;

use App\Models\Cursos\Category;
use App\Models\Cursos\Cursos;
use Livewire\Component;
use Livewire\WithPagination;

class CursosTable extends Component
{
    use WithPagination;

    public $categorias;
    public $buscar;
    public $selectedCategoria = '';
    public $perPage = 10;
    public $sortColumn = 'created_at'; // Columna por defecto
    public $sortDirection = 'desc'; // Dirección por defecto
    protected $services; // Propiedad protegida para los usuarios

    public function mount(){
        $this->categorias = Category::where('inactive',0)->get();
        // $this->actualizarServicios(); // Inicializa los usuarios
    }
    public function render()
    {
        $this->actualizarServicios(); // Ahora se llama directamente en render para refrescar los clientes.
        return view('livewire.cursos-table', [
            'servicios' => $this->services
        ]);
    }

    protected function actualizarServicios()
    {
        $buscar = $this->buscar;
        $selectedCategoria = $this->selectedCategoria;

        $query = Cursos::when($buscar, function ($query) use ($buscar) {
                    $query->where(function ($q) use ($buscar) {
                        $q->where('cursos.name', 'like', '%' . $buscar . '%')
                          ->orWhere('cursos.price', 'like', '%' . $buscar . '%');
                    });
                })
                ->when($selectedCategoria, function ($query) use ($selectedCategoria) {
                    $query->where('cursos.category_id', $selectedCategoria);
                })
                ->leftjoin('cursos_category', 'cursos.category_id', '=', 'cursos_category.id')
                ->select('cursos.*', 'cursos_category.name as categoria_nombre');

        $query->orderBy($this->sortColumn, $this->sortDirection);

        // Verifica si se seleccionó 'all' para mostrar todos los registros
        $this->services = $this->perPage === 'all'
            ? $query->paginate(9999)
            : $query->paginate(is_numeric($this->perPage) ? (int) $this->perPage : 10);
    }

    public function getServices()
    {
        // Si es necesario, puedes incluir lógica adicional aquí antes de devolver los usuarios
        return $this->services;
    }

    public function aplicarFiltro()
    {
        // Aquí aplicarías los filtros
        // Por ejemplo: $this->filtroEspecifico = 'valor';

        $this->actualizarServicios(); // Luego actualizas la lista de usuarios basada en los filtros
    }
    public function sortBy($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }
    public function updating($propertyName)
    {
        if ($propertyName === 'buscar' || $propertyName === 'selectedCategoria') {
            $this->resetPage(); // Resetear la paginación solo cuando estos filtros cambien.
        }
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function limpiarFiltros()
    {
        $this->buscar = '';
        $this->selectedCategoria = '';
        $this->perPage = 10;
        $this->resetPage();
    }

    public function delete($id)
    {
        try {
            $curso = Cursos::findOrFail($id);
            $curso->delete();

            session()->flash('success', 'Curso eliminado exitosamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar el curso: ' . $e->getMessage());
        }
    }
}
