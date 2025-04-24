<?php

namespace App\Modules\Moodle\Resources\views\admin;

?>

@extends('moodle::admin.layout')

@section('title', 'Dashboard')
@section('subtitle', 'Panel de control del módulo Moodle')

@section('content')
    <!-- Connection Status -->
    <div class="connection-status {{ $connectionStatus ? 'connected' : 'disconnected' }}">
        <i class="fas {{ $connectionStatus ? 'fa-check-circle' : 'fa-exclamation-circle' }} me-2"></i>
        @if($connectionStatus)
            Conexión establecida con Moodle
        @else
            No se pudo establecer conexión con Moodle. Por favor, verifique la configuración.
        @endif
    </div>

    @if($connectionStatus && isset($siteInfo))
    <!-- Site Information -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-info-circle me-2"></i> Información del Sitio Moodle
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nombre del sitio:</strong> {{ $siteInfo['sitename'] }}</p>
                    <p><strong>Versión de Moodle:</strong> {{ $siteInfo['release'] }}</p>
                    <p><strong>URL del sitio:</strong> <a href="{{ $siteInfo['siteurl'] }}" target="_blank">{{ $siteInfo['siteurl'] }}</a></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Usuario:</strong> {{ $siteInfo['username'] }}</p>
                    <p><strong>Nombre completo:</strong> {{ $siteInfo['firstname'] }} {{ $siteInfo['lastname'] }}</p>
                    <p><strong>Idioma:</strong> {{ $siteInfo['lang'] }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Statistics -->
    <div class="row">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value">{{ $siteInfo['userscount'] ?? 0 }}</div>
                <div class="stat-label">Usuarios Totales</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="stat-value">{{ $siteInfo['coursescount'] ?? 0 }}</div>
                <div class="stat-label">Cursos Totales</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="stat-value">{{ $siteInfo['enrollmentscount'] ?? 0 }}</div>
                <div class="stat-label">Matriculaciones</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <div class="stat-value">{{ $siteInfo['certificatescount'] ?? 0 }}</div>
                <div class="stat-label">Certificados Emitidos</div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card mt-4">
        <div class="card-header">
            <i class="fas fa-bolt me-2"></i> Acciones Rápidas
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <a href="{{ route('moodle.admin.users') }}" class="btn btn-primary w-100">
                        <i class="fas fa-users me-2"></i> Gestionar Usuarios
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('moodle.admin.courses') }}" class="btn btn-success w-100">
                        <i class="fas fa-book me-2"></i> Gestionar Cursos
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('moodle.admin.enrollments') }}" class="btn btn-info w-100 text-white">
                        <i class="fas fa-user-graduate me-2"></i> Gestionar Matriculaciones
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('moodle.admin.certificates') }}" class="btn btn-warning w-100">
                        <i class="fas fa-certificate me-2"></i> Gestionar Certificados
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card mt-4">
        <div class="card-header">
            <i class="fas fa-history me-2"></i> Actividad Reciente
        </div>
        <div class="card-body">
            @if(isset($recentActivity) && count($recentActivity) > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Usuario</th>
                                <th>Acción</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentActivity as $activity)
                                <tr>
                                    <td>{{ $activity['date'] }}</td>
                                    <td>{{ $activity['user'] }}</td>
                                    <td>{{ $activity['action'] }}</td>
                                    <td>{{ $activity['details'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">No hay actividad reciente para mostrar.</p>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Dashboard specific scripts can be added here
    $(document).ready(function() {
        console.log('Dashboard loaded');
    });
</script>
@endsection
