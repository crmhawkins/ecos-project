<?php

namespace App\Http\Livewire;

use App\Models\Aulas\Reservas;
use Livewire\Component;
use Livewire\WithPagination;

class ReservasTable extends Component
{
    use WithPagination;

    public $buscar;
    public $perPage = 10;
    public $sortColumn = 'created_at'; // Columna por defecto
    public $sortDirection = 'desc'; // Dirección por defecto
    protected $services; // Propiedad protegida para los usuarios
    public $reservaSeleccionada;
    public $observaciones;

    public function render()
    {
        $this->actualizarServicios(); // Ahora se llama directamente en render para refrescar los clientes.
        return view('livewire.reservas-table', [
            'servicios' => $this->services
        ]);
    }

    protected function actualizarServicios()
    {
        $query = Reservas::when($this->buscar, function ($query) {
                    $query->where('curso', 'like', '%' . $this->buscar . '%');
                });

        $query->orderBy($this->sortColumn, $this->sortDirection);

        // Verifica si se seleccionó 'all' para mostrar todos los registros
        $this->services = $this->perPage === 'all' ? $query->get() : $query->paginate(is_numeric($this->perPage) ? $this->perPage : 10);
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
        if ($propertyName === 'buscar' ) {
            $this->resetPage(); // Resetear la paginación solo cuando estos filtros cambien.
        }
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function verDetalle($id)
    {
        $this->reservaSeleccionada = Reservas::findOrFail($id);
        $this->dispatch('mostrarModalDetalle');
    }
    public function rechazarReserva($id)
    {
        $reserva = Reservas::findOrFail($id);
        $reserva->estado = 'rechazada';
        $reserva->save();
        $sesiones = $reserva->sesiones;
        if ($sesiones) {
            foreach ($sesiones as $sesion) {
                $sesion->delete();
            }
        }
        $this->actualizarServicios();
    }

    public function Observaciones($id)
    {
        $this->reservaSeleccionada = Reservas::findOrFail($id);
        $this->observaciones = $this->reservaSeleccionada->observaciones;
        $this->dispatch('mostrarModalObservaciones');
    }

    public function guardarObservaciones($id)
    {
        $reserva = Reservas::findOrFail($id);
        $reserva->observaciones = $this->observaciones;
        $reserva->save();
        $this->observaciones = null;
        $this->reservaSeleccionada = null;

    }
    public function traducirDiasFormateados($dias)
    {
        $mapaDias = [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo',
        ];

        $ordenDias = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        $diasArray = is_array($dias) ? $dias : json_decode($dias, true);

        // Ordenar según el orden natural de los días
        usort($diasArray, function($a, $b) use ($ordenDias) {
            return array_search($a, $ordenDias) <=> array_search($b, $ordenDias);
        });

        // Días laborales
        $laborales = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        // Comparación sin importar el orden
        $diasOrdenadosLaborales = $diasArray;
        sort($diasOrdenadosLaborales);
        $laboralesOrdenados = $laborales;
        sort($laboralesOrdenados);

        if (count($diasArray) === count($laborales) && empty(array_diff($diasOrdenadosLaborales, $laboralesOrdenados))) {
            return 'Lunes a Viernes';
        }

        return collect($diasArray)
            ->map(fn($d) => $mapaDias[$d] ?? $d)
            ->implode(', ');
    }

}
