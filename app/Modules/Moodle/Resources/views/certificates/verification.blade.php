<?php

namespace App\Modules\Moodle\Resources\views\certificates;

?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-certificate me-2"></i> Verificación de Certificado</h4>
                </div>
                <div class="card-body">
                    @if(isset($certificate) && $certificate)
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i> Este certificado es válido y ha sido emitido por nuestra institución.
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <h5>Información del Certificado</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 30%">ID de Certificado:</th>
                                        <td>{{ $certificate->certificate_id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Estudiante:</th>
                                        <td>{{ $certificate->user_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Curso:</th>
                                        <td>{{ $certificate->course_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha de Emisión:</th>
                                        <td>{{ $certificate->issued_at->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Estado:</th>
                                        <td>
                                            <span class="badge bg-success">Verificado</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="qr-code-container border p-2">
                                    <img src="{{ asset('storage/certificates/qr/' . $certificate->certificate_id . '.png') }}" 
                                         class="img-fluid" alt="Código QR de verificación">
                                </div>
                                <p class="mt-2 small text-muted">Escanea el código QR para verificar</p>
                            </div>
                        </div>
                        
                        <div class="text-center mb-4">
                            <a href="{{ route('moodle.certificates.download', $certificate->filename) }}" class="btn btn-primary">
                                <i class="fas fa-download me-2"></i> Descargar Certificado
                            </a>
                        </div>
                        
                        <div class="certificate-preview text-center">
                            <h5 class="mb-3">Vista Previa del Certificado</h5>
                            <div class="border p-2">
                                <img src="{{ asset('storage/certificates/thumbnails/' . $certificate->filename) }}" 
                                     class="img-fluid" alt="Vista previa del certificado">
                            </div>
                        </div>
                    @elseif(isset($error))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ $error }}
                        </div>
                        
                        <div class="text-center mt-4">
                            <p>Si crees que esto es un error, por favor contacta con el administrador.</p>
                            <a href="{{ route('moodle.certificates.verify.get') }}" class="btn btn-primary">
                                <i class="fas fa-search me-2"></i> Verificar otro certificado
                            </a>
                        </div>
                    @else
                        <p class="mb-4">Ingresa el ID de verificación del certificado para comprobar su autenticidad.</p>
                        
                        <form action="{{ route('moodle.certificates.verify.post') }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="certificate_id" name="certificate_id" 
                                       placeholder="Ingresa el ID de verificación del certificado" required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-2"></i> Verificar
                                </button>
                            </div>
                        </form>
                        
                        <div class="mt-5">
                            <h5>¿Cómo verificar un certificado?</h5>
                            <ol>
                                <li>Localiza el ID de verificación en la parte inferior del certificado.</li>
                                <li>Ingresa el ID en el campo de texto anterior.</li>
                                <li>Haz clic en el botón "Verificar".</li>
                                <li>El sistema mostrará la información del certificado si es válido.</li>
                            </ol>
                            <p>También puedes escanear el código QR que aparece en el certificado para verificarlo automáticamente.</p>
                        </div>
                    @endif
                </div>
                <div class="card-footer text-center">
                    <p class="mb-0 small text-muted">
                        Este sistema de verificación de certificados está respaldado por tecnología blockchain para garantizar su autenticidad.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
