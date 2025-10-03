<div>
    @if ( $servicios )

        <!-- Tabla moderna -->
        <div class="table-card">
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            @foreach ([
                                'titulo' => 'TÍTULO',
                                'aula_id' => 'AULA',
                                'solicitante' => 'SOLICITANTE',
                                'fecha_inicio' => 'FECHA INICIO',
                                'fecha_fin' => 'FECHA FIN',
                                'estado' => 'ESTADO',
                            ] as $field => $label)
                                <th>
                                    <a href="#" wire:click.prevent="sortBy('{{ $field }}')" class="sort-link">
                                        {{ $label }}
                                        @if ($sortColumn == $field)
                                            <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                        @else
                                            <i class="fas fa-sort"></i>
                                        @endif
                                    </a>
                                </th>
                            @endforeach
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servicios as $reserva)
                            <tr class="table-row">
                                <td class="course-cell">
                                    <div class="course-info">
                                        <strong>{{ $reserva->titulo }}</strong>
                                        @if($reserva->descripcion)
                                            <small class="course-description">{{ Str::limit($reserva->descripcion, 100) }}</small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($reserva->aula)
                                        <span class="category-badge">{{ $reserva->aula->name }}</span>
                                    @else
                                        <span class="category-badge">Sin Aula</span>
                                    @endif
                                </td>
                                <td class="requester-cell">
                                    <div class="requester-name">{{ $reserva->solicitante }}</div>
                                    @if($reserva->email_contacto)
                                        <div class="requester-email">{{ $reserva->email_contacto }}</div>
                                    @endif
                                </td>
                                <td class="date-cell">{{ $reserva->fecha_inicio ? \Carbon\Carbon::parse($reserva->fecha_inicio)->format('d/m/Y H:i') : 'N/A' }}</td>
                                <td class="date-cell">{{ $reserva->fecha_fin ? \Carbon\Carbon::parse($reserva->fecha_fin)->format('d/m/Y H:i') : 'N/A' }}</td>
                                <td class="status-cell">
                                    @php
                                        $estadoClass = match($reserva->estado) {
                                            'confirmada' => 'status-confirmada',
                                            'pendiente' => 'status-pendiente',
                                            'cancelada' => 'status-cancelada',
                                            default => 'status-pendiente'
                                        };
                                        $estadoIcon = match($reserva->estado) {
                                            'confirmada' => 'check-circle',
                                            'pendiente' => 'clock',
                                            'cancelada' => 'times-circle',
                                            default => 'clock'
                                        };
                                        $estadoText = match($reserva->estado) {
                                            'confirmada' => 'Confirmada',
                                            'pendiente' => 'Pendiente',
                                            'cancelada' => 'Cancelada',
                                            default => 'Pendiente'
                                        };
                                    @endphp
                                    <span class="status-badge {{ $estadoClass }}">
                                        <i class="fas fa-{{ $estadoIcon }}"></i>
                                        {{ $estadoText }}
                                    </span>
                                </td>
                                <td class="actions-cell">
                                    <div class="action-buttons">
                                        <a href="{{ route('reservas.show', $reserva->id) }}" class="btn-action btn-view" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('reservas.edit', $reserva->id) }}" class="btn-action btn-edit" title="Editar reserva">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($reserva->estado == 'pendiente')
                                            <button wire:click="confirmarReserva({{ $reserva->id }})" class="btn-action btn-confirm" title="Confirmar reserva">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button wire:click="rechazarReserva({{ $reserva->id }})" class="btn-action btn-reject" title="Rechazar reserva">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif
                                        <button @click="reservaToDelete = {{ $reserva->id }}; showDeleteModal = true" class="btn-action btn-delete" title="Eliminar reserva">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    @else
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h3>No hay reservas disponibles</h3>
            <p>No se encontraron reservas que coincidan con los filtros aplicados.</p>
            <a href="{{ route('reservas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Crear Primera Reserva
            </a>
        </div>
    @endif

    <!-- Modal de confirmación de eliminación -->
    <div x-data="{ showDeleteModal: false, reservaToDelete: null }" x-show="showDeleteModal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-exclamation-triangle"></i> Confirmar Eliminación</h3>
                <button @click="showDeleteModal = false" class="modal-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar esta reserva?</p>
                <p><strong>Esta acción no se puede deshacer.</strong></p>
            </div>
            <div class="modal-actions">
                <button @click="showDeleteModal = false" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button x-show="reservaToDelete" wire:click="delete(reservaToDelete)" @click="showDeleteModal = false" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
            </div>
        </div>
    </div>
</div>