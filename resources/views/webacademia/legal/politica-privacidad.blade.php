@extends('webacademia.layouts.web_layout')
@section('title', 'Política de Privacidad')
@section('content')
<section style="padding: 80px 0; background: #f8fafc; min-height: 60vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div style="background: white; border-radius: 20px; padding: 48px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                    <h1 style="color: #D93690; font-weight: 800; margin-bottom: 32px;">Política de Privacidad</h1>
                    <h5>Responsable del tratamiento</h5>
                    <p>Grupo ECOS es el responsable del tratamiento de los datos personales facilitados a través de este sitio web.</p>
                    <h5>Finalidad del tratamiento</h5>
                    <p>Los datos personales que nos facilites serán tratados con las siguientes finalidades: gestión de solicitudes de información, gestión de matrículas y formación, envío de comunicaciones relacionadas con nuestros servicios.</p>
                    <h5>Legitimación</h5>
                    <p>El tratamiento de tus datos se basa en el consentimiento que nos otorgas al facilitar tus datos, así como en la ejecución del contrato de formación.</p>
                    <h5>Conservación de datos</h5>
                    <p>Conservaremos tus datos durante el tiempo necesario para prestar el servicio solicitado y durante los plazos legalmente establecidos.</p>
                    <h5>Derechos</h5>
                    <p>Puedes ejercer tus derechos de acceso, rectificación, supresión, portabilidad y oposición al tratamiento enviando un correo a <strong>academia@grupoecos.net</strong>.</p>
                    <p style="color: #9ca3af; font-size: 0.9rem; margin-top: 32px;">Última actualización: {{ date('d/m/Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
