@extends('webacademia.layouts.web_layout')

@section('title', 'Política de Cookies — Grupo ECOS')

@section('content')
<section class="section-top">
    <div class="container">
        <div class="col-lg-10 offset-lg-1 text-center">
            <div class="section-top-title">
                <h1>Política de Cookies</h1>
                <ul>
                    <li><a href="/">Inicio</a></li>
                    <li> / Política de Cookies</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section" style="padding: 60px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div style="background:#fff;border-radius:12px;padding:40px;box-shadow:0 2px 20px rgba(0,0,0,0.06);">

                    <h2 style="color:var(--primary-color,#D93690);margin-bottom:8px;">1. ¿Qué son las cookies?</h2>
                    <p>Las cookies son pequeños archivos de texto que los sitios web colocan en su dispositivo al visitarlos. Se utilizan ampliamente para que los sitios web funcionen correctamente, así como para proporcionar información a los propietarios del sitio.</p>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">2. Cookies utilizadas en este sitio web</h2>
                    <div class="table-responsive">
                        <table style="width:100%;border-collapse:collapse;margin-top:12px;">
                            <thead>
                                <tr style="background:var(--primary-color,#D93690);color:white;">
                                    <th style="padding:12px 16px;text-align:left;">Nombre</th>
                                    <th style="padding:12px 16px;text-align:left;">Tipo</th>
                                    <th style="padding:12px 16px;text-align:left;">Finalidad</th>
                                    <th style="padding:12px 16px;text-align:left;">Duración</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom:1px solid #eee;">
                                    <td style="padding:12px 16px;"><code>ecos_session</code></td>
                                    <td style="padding:12px 16px;">Técnica</td>
                                    <td style="padding:12px 16px;">Mantiene la sesión del usuario durante la navegación</td>
                                    <td style="padding:12px 16px;">Sesión</td>
                                </tr>
                                <tr style="border-bottom:1px solid #eee;background:#fafafa;">
                                    <td style="padding:12px 16px;"><code>XSRF-TOKEN</code></td>
                                    <td style="padding:12px 16px;">Seguridad</td>
                                    <td style="padding:12px 16px;">Protección contra ataques CSRF</td>
                                    <td style="padding:12px 16px;">Sesión</td>
                                </tr>
                                <tr style="border-bottom:1px solid #eee;">
                                    <td style="padding:12px 16px;"><code>remember_alumno_*</code></td>
                                    <td style="padding:12px 16px;">Funcional</td>
                                    <td style="padding:12px 16px;">Recuerda las credenciales del alumno para facilitar el acceso futuro (solo si marcó «Recuérdame»)</td>
                                    <td style="padding:12px 16px;">5 años</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">3. Tipos de cookies según su finalidad</h2>
                    <ul>
                        <li><strong>Cookies técnicas:</strong> imprescindibles para el correcto funcionamiento del sitio web. Sin ellas, algunos servicios no estarán disponibles.</li>
                        <li><strong>Cookies de seguridad:</strong> protegen la integridad de las transacciones y la autenticación del usuario.</li>
                        <li><strong>Cookies funcionales:</strong> permiten recordar las preferencias del usuario para mejorar su experiencia.</li>
                    </ul>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">4. Gestión de cookies</h2>
                    <p>Puede configurar su navegador para rechazar o eliminar las cookies. A continuación encontrará los enlaces a las instrucciones de los navegadores más comunes:</p>
                    <ul>
                        <li><a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener">Google Chrome</a></li>
                        <li><a href="https://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-sitios-web-rastrear-preferencias" target="_blank" rel="noopener">Mozilla Firefox</a></li>
                        <li><a href="https://support.apple.com/es-es/guide/safari/sfri11471/mac" target="_blank" rel="noopener">Safari</a></li>
                        <li><a href="https://support.microsoft.com/es-es/microsoft-edge/eliminar-las-cookies-en-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" rel="noopener">Microsoft Edge</a></li>
                    </ul>
                    <p>Tenga en cuenta que deshabilitar las cookies técnicas puede afectar al funcionamiento del sitio web.</p>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">5. Actualizaciones</h2>
                    <p>Grupo ECOS puede actualizar esta Política de Cookies en cualquier momento para adaptarla a cambios técnicos, legales o normativos. Le recomendamos revisarla periódicamente.</p>

                    <p style="margin-top:40px;font-size:0.85rem;color:#999;">Última actualización: mayo de 2026</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
