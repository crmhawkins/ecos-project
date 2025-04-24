<?php

namespace App\Modules\Moodle\Resources\views\admin;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Módulo Moodle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --sidebar-width: 250px;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
            color: white;
            z-index: 1000;
        }
        .sidebar-header {
            padding: 0 15px 20px;
            border-bottom: 1px solid #495057;
            text-align: center;
        }
        .sidebar-header h3 {
            margin-bottom: 0;
            font-size: 1.5rem;
        }
        .sidebar-menu {
            padding: 20px 0;
        }
        .sidebar-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar-menu li {
            margin-bottom: 5px;
        }
        .sidebar-menu a {
            display: block;
            padding: 10px 15px;
            color: #adb5bd;
            text-decoration: none;
            transition: all 0.3s;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active {
            color: white;
            background-color: #495057;
        }
        .sidebar-menu i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        .content {
            margin-left: var(--sidebar-width);
            padding: 20px;
        }
        .content-header {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #dee2e6;
        }
        .content-header h1 {
            margin-bottom: 5px;
        }
        .card {
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            font-weight: 600;
        }
        .connection-status {
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .connection-status.connected {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .connection-status.disconnected {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .stat-card {
            background-color: white;
            border-radius: 4px;
            padding: 20px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 20px;
        }
        .stat-card .stat-icon {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #6c757d;
        }
        .stat-card .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .stat-card .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Módulo Moodle</h3>
            <small>Panel de Administración</small>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('moodle.admin.dashboard') }}" class="{{ request()->routeIs('moodle.admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard moodel
                    </a>
                </li>
                <li>
                    <a href="{{ route('moodle.admin.users') }}" class="{{ request()->routeIs('moodle.admin.users') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Usuarios
                    </a>
                </li>
                <li>
                    <a href="{{ route('moodle.admin.courses') }}" class="{{ request()->routeIs('moodle.admin.courses') ? 'active' : '' }}">
                        <i class="fas fa-book"></i> Cursos
                    </a>
                </li>
                <li>
                    <a href="{{ route('moodle.admin.enrollments') }}" class="{{ request()->routeIs('moodle.admin.enrollments') ? 'active' : '' }}">
                        <i class="fas fa-user-graduate"></i> Matriculaciones
                    </a>
                </li>
                <li>
                    <a href="{{ route('moodle.admin.certificates') }}" class="{{ request()->routeIs('moodle.admin.certificates') ? 'active' : '' }}">
                        <i class="fas fa-certificate"></i> Certificados
                    </a>
                </li>
                <li>
                    <a href="{{ route('moodle.admin.settings') }}" class="{{ request()->routeIs('moodle.admin.settings') ? 'active' : '' }}">
                        <i class="fas fa-cog"></i> Configuración
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-arrow-left"></i> Volver al crm
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="content">
        <div class="content-header">
            <h1>@yield('title', 'Dashboard')</h1>
            <p class="text-muted">@yield('subtitle', 'Panel de control del módulo Moodle')</p>
        </div>

        @if(session('success'))
            @include('moodle::components.notifications', [
                'type' => 'success',
                'message' => session('success'),
                'dismissible' => true
            ])
        @endif

        @if(session('error'))
            @include('moodle::components.notifications', [
                'type' => 'error',
                'message' => session('error'),
                'dismissible' => true
            ])
        @endif

        @if(isset($error))
            @include('moodle::components.notifications', [
                'type' => 'error',
                'message' => $error,
                'dismissible' => true
            ])
        @endif

        <div class="container-fluid px-0">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>
</html>
