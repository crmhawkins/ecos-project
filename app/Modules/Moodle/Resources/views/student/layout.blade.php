<?php

namespace App\Modules\Moodle\Resources\views\student;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Estudiante - Módulo Moodle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --sidebar-width: 250px;
            --primary-color: #3498db;
            --secondary-color: #2980b9;
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
            background-color: #2c3e50;
            padding-top: 20px;
            color: white;
            z-index: 1000;
        }
        .sidebar-header {
            padding: 0 15px 20px;
            border-bottom: 1px solid #34495e;
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
            color: #ecf0f1;
            text-decoration: none;
            transition: all 0.3s;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active {
            color: white;
            background-color: var(--primary-color);
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
            color: #2c3e50;
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
        .course-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .course-image {
            height: 160px;
            background-color: #e9ecef;
            background-size: cover;
            background-position: center;
        }
        .progress-bar {
            background-color: var(--primary-color);
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        .certificate-card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        .certificate-card:hover {
            background-color: #f8f9fa;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .certificate-icon {
            font-size: 2rem;
            color: #ffc107;
            margin-right: 15px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Módulo Moodle</h3>
            <small>Panel de Estudiante</small>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('moodle.student.dashboard') }}" class="{{ request()->routeIs('moodle.student.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('moodle.student.courses') }}" class="{{ request()->routeIs('moodle.student.courses') ? 'active' : '' }}">
                        <i class="fas fa-book"></i> Mis Cursos
                    </a>
                </li>
                <li>
                    <a href="{{ route('moodle.student.progress') }}" class="{{ request()->routeIs('moodle.student.progress') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i> Mi Progreso
                    </a>
                </li>
                <li>
                    <a href="{{ route('moodle.student.certificates') }}" class="{{ request()->routeIs('moodle.student.certificates') ? 'active' : '' }}">
                        <i class="fas fa-certificate"></i> Mis Certificados
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="content">
        <div class="content-header">
            <h1>@yield('title', 'Dashboard')</h1>
            <p class="text-muted">@yield('subtitle', 'Panel de estudiante del módulo Moodle')</p>
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
