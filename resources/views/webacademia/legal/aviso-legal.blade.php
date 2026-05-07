@extends('webacademia.layouts.web_layout')
@section('title', 'Aviso Legal')
@section('content')
<section style="padding: 80px 0; background: #f8fafc; min-height: 60vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div style="background: white; border-radius: 20px; padding: 48px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                    <h1 style="color: #D93690; font-weight: 800; margin-bottom: 32px;">Aviso Legal</h1>
                    <h5>Titular del sitio</h5>
                    <p>Grupo ECOS — Centro de formación con más de 28 años de experiencia en Ceuta, Estepona y Melilla.</p>
                    <h5>Objeto</h5>
                    <p>El presente aviso legal regula el uso del sitio web de Grupo ECOS. El acceso y uso de este sitio implica la aceptación plena de las condiciones de uso vigentes en el momento del acceso.</p>
                    <h5>Propiedad intelectual</h5>
                    <p>Todos los contenidos del sitio web, incluyendo textos, fotografías, gráficos, imágenes, tecnología, software, links y demás contenidos audiovisuales o sonoros, son propiedad de Grupo ECOS o de terceros que han autorizado su uso.</p>
                    <h5>Responsabilidad</h5>
                    <p>Grupo ECOS no se hace responsable de los daños o perjuicios de cualquier naturaleza ocasionados a usuarios por el uso del sitio web.</p>
                    <p style="color: #9ca3af; font-size: 0.9rem; margin-top: 32px;">Última actualización: {{ date('d/m/Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
