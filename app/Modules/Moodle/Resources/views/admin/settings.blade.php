<?php

namespace App\Modules\Moodle\Resources\views\admin;

?>

@extends('moodle::admin.layout')

@section('title', 'Configuración')
@section('subtitle', 'Configurar la integración con Moodle')

@section('content')
    <!-- Connection Status -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-plug me-2"></i> Estado de la Conexión
        </div>
        <div class="card-body">
            <div class="connection-status {{ isset($connectionStatus) && $connectionStatus ? 'connected' : 'disconnected' }}">
                <i class="fas {{ isset($connectionStatus) && $connectionStatus ? 'fa-check-circle' : 'fa-exclamation-circle' }} me-2"></i>
                @if(isset($connectionStatus) && $connectionStatus)
                    Conexión establecida con Moodle
                @else
                    No se pudo establecer conexión con Moodle. Por favor, verifique la configuración.
                @endif
            </div>

            @if(isset($connectionStatus) && $connectionStatus && isset($siteInfo))
                <div class="mt-3">
                    <h5>Información del Sitio Moodle</h5>
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
            @endif

            <div class="mt-3">
                <button type="button" class="btn btn-primary" id="testConnectionBtn">
                    <i class="fas fa-sync-alt me-2"></i> Probar Conexión
                </button>
            </div>
        </div>
    </div>

    <!-- Configuration Form -->
    <div class="card">
        <div class="card-header">
            <i class="fas fa-cog me-2"></i> Configuración de la Integración
        </div>
        <div class="card-body">
            <form action="{{ route('moodle.admin.settings.update') }}" method="POST">
                @csrf

                <h5 class="mb-3">Conexión con Moodle</h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="url" class="form-label">URL de Moodle</label>
                            <input type="url" class="form-control" id="url" name="url" value="{{ $settings['url'] ?? '' }}" required>
                            <small class="form-text text-muted">URL completa de su instalación de Moodle (ej. https://moodle.ejemplo.com)</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="token" class="form-label">Token de API</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="token" name="token" value="{{ $settings['token'] ?? '' }}" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleToken">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small class="form-text text-muted">Token de acceso a la API de Moodle</small>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="protocol" class="form-label">Protocolo</label>
                            <select class="form-select" id="protocol" name="protocol" required>
                                <option value="rest" {{ ($settings['protocol'] ?? '') == 'rest' ? 'selected' : '' }}>REST</option>
                                <option value="soap" {{ ($settings['protocol'] ?? '') == 'soap' ? 'selected' : '' }}>SOAP</option>
                                <option value="xmlrpc" {{ ($settings['protocol'] ?? '') == 'xmlrpc' ? 'selected' : '' }}>XML-RPC</option>
                            </select>
                            <small class="form-text text-muted">Protocolo de comunicación con la API de Moodle</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="format" class="form-label">Formato de Respuesta</label>
                            <select class="form-select" id="format" name="format" required>
                                <option value="json" {{ ($settings['format'] ?? '') == 'json' ? 'selected' : '' }}>JSON</option>
                                <option value="xml" {{ ($settings['format'] ?? '') == 'xml' ? 'selected' : '' }}>XML</option>
                            </select>
                            <small class="form-text text-muted">Formato de respuesta de la API de Moodle</small>
                        </div>
                    </div>
                </div>

                <h5 class="mb-3">Configuración de Caché</h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="cache_enabled" name="cache_enabled" {{ ($settings['cache_enabled'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="cache_enabled">Habilitar caché</label>
                            </div>
                            <small class="form-text text-muted">Almacenar en caché las respuestas de la API para mejorar el rendimiento</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="cache_ttl" class="form-label">Tiempo de vida de la caché (segundos)</label>
                            <input type="number" class="form-control" id="cache_ttl" name="cache_ttl" value="{{ $settings['cache_ttl'] ?? 3600 }}" min="60" max="86400">
                            <small class="form-text text-muted">Tiempo en segundos que se mantendrán los datos en caché</small>
                        </div>
                    </div>
                </div>

                <h5 class="mb-3">Sincronización de Usuarios</h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="auto_create_users" name="auto_create_users" {{ ($settings['auto_create_users'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="auto_create_users">Crear usuarios automáticamente</label>
                            </div>
                            <small class="form-text text-muted">Crear usuarios en Moodle cuando se registren en Laravel</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="auto_update_users" name="auto_update_users" {{ ($settings['auto_update_users'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="auto_update_users">Actualizar usuarios automáticamente</label>
                            </div>
                            <small class="form-text text-muted">Actualizar usuarios en Moodle cuando se actualicen en Laravel</small>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="default_role" class="form-label">Rol por defecto</label>
                            <select class="form-select" id="default_role" name="default_role">
                                <option value="student" {{ ($settings['default_role'] ?? '') == 'student' ? 'selected' : '' }}>Estudiante</option>
                                <option value="teacher" {{ ($settings['default_role'] ?? '') == 'teacher' ? 'selected' : '' }}>Profesor</option>
                                <option value="manager" {{ ($settings['default_role'] ?? '') == 'manager' ? 'selected' : '' }}>Gestor</option>
                                <option value="admin" {{ ($settings['default_role'] ?? '') == 'admin' ? 'selected' : '' }}>Administrador</option>
                            </select>
                            <small class="form-text text-muted">Rol asignado a los usuarios creados automáticamente</small>
                        </div>
                    </div>
                </div>

                <h5 class="mb-3">Matriculación</h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="auto_enroll" name="auto_enroll" {{ ($settings['auto_enroll'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="auto_enroll">Matriculación automática tras el pago</label>
                            </div>
                            <small class="form-text text-muted">Matricular automáticamente a los usuarios en cursos después de realizar un pago</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="enroll_method" class="form-label">Método de matriculación</label>
                            <select class="form-select" id="enroll_method" name="enroll_method">
                                <option value="manual" {{ ($settings['enroll_method'] ?? '') == 'manual' ? 'selected' : '' }}>Manual</option>
                                <option value="self" {{ ($settings['enroll_method'] ?? '') == 'self' ? 'selected' : '' }}>Auto-matriculación</option>
                                <option value="paypal" {{ ($settings['enroll_method'] ?? '') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                            </select>
                            <small class="form-text text-muted">Método de matriculación utilizado en Moodle</small>
                        </div>
                    </div>
                </div>

                <h5 class="mb-3">Certificados</h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="certificates_path" class="form-label">Ruta de almacenamiento</label>
                            <input type="text" class="form-control" id="certificates_path" name="certificates_path" value="{{ $settings['certificates_path'] ?? storage_path('app/certificates') }}">
                            <small class="form-text text-muted">Ruta donde se almacenarán los certificados generados</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="certificate_template" class="form-label">Plantilla de certificado</label>
                            <select class="form-select" id="certificate_template" name="certificate_template">
                                <option value="default" {{ ($settings['certificate_template'] ?? '') == 'default' ? 'selected' : '' }}>Predeterminada</option>
                                <option value="elegant" {{ ($settings['certificate_template'] ?? '') == 'elegant' ? 'selected' : '' }}>Elegante</option>
                                <option value="modern" {{ ($settings['certificate_template'] ?? '') == 'modern' ? 'selected' : '' }}>Moderna</option>
                                <option value="classic" {{ ($settings['certificate_template'] ?? '') == 'classic' ? 'selected' : '' }}>Clásica</option>
                            </select>
                            <small class="form-text text-muted">Plantilla utilizada para generar los certificados</small>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="signature_image" class="form-label">Imagen de firma</label>
                            <input type="text" class="form-control" id="signature_image" name="signature_image" value="{{ $settings['signature_image'] ?? '' }}">
                            <small class="form-text text-muted">Ruta a la imagen de firma para los certificados (opcional)</small>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="reset" class="btn btn-secondary me-md-2">
                        <i class="fas fa-undo me-2"></i> Restablecer
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> Guardar Configuración
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Toggle token visibility
        $('#toggleToken').click(function() {
            const tokenInput = $('#token');
            const icon = $(this).find('i');

            if (tokenInput.attr('type') === 'password') {
                tokenInput.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                tokenInput.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        // Test connection
        $('#testConnectionBtn').click(function() {
            const url = $('#url').val();
            const token = $('#token').val();
            const protocol = $('#protocol').val();
            const format = $('#format').val();

            if (!url || !token) {
                alert('Por favor, complete la URL y el token antes de probar la conexión.');
                return;
            }

            // Show loading indicator
            $(this).html('<i class="fas fa-spinner fa-spin me-2"></i> Probando conexión...').prop('disabled', true);

            // Make AJAX request to test connection
            $.ajax({
                url: '{{ route("moodle.admin.test-connection") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    url: url,
                    token: token,
                    protocol: protocol,
                    format: format
                },
                success: function(response) {
                    if (response.success) {
                        alert('Conexión exitosa con la API de Moodle.');
                        location.reload();
                    } else {
                        alert('Error al conectar con la API de Moodle: ' + response.message);
                    }
                },
                error: function() {
                    alert('Error al probar la conexión. Por favor, inténtelo de nuevo.');
                },
                complete: function() {
                    $('#testConnectionBtn').html('<i class="fas fa-sync-alt me-2"></i> Probar Conexión').prop('disabled', false);
                }
            });
        });
    });
</script>
@endsection
