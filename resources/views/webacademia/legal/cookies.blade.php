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

                    <p style="background:#fdf0f8;border-left:4px solid var(--primary-color,#D93690);padding:14px 18px;border-radius:6px;font-size:0.92rem;">
                        Esta política se elabora en cumplimiento de la <strong>Ley 34/2002 (LSSI-CE)</strong>, el <strong>RGPD (UE) 2016/679</strong> y las directrices de la <strong>AEPD</strong> sobre el uso de cookies.
                    </p>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">1. ¿Qué son las cookies?</h2>
                    <p>Las cookies son pequeños archivos de texto que los sitios web almacenan en el dispositivo del usuario al visitarlos. Permiten que el sitio recuerde información sobre tu visita (idioma, preferencias, sesión iniciada, etc.), facilitando una experiencia más fluida y personalizada.</p>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">2. Tipos de cookies según su titular</h2>
                    <ul>
                        <li><strong>Cookies propias:</strong> generadas y gestionadas directamente por Grupo ECOS.</li>
                        <li><strong>Cookies de terceros:</strong> actualmente este Sitio Web <strong>no utiliza cookies de terceros</strong> (analítica, publicidad, redes sociales, etc.).</li>
                    </ul>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">3. Cookies utilizadas en este sitio web</h2>
                    <p>Este Sitio Web utiliza exclusivamente cookies técnicas y funcionales, imprescindibles para su correcto funcionamiento. Por su naturaleza, <strong>no requieren consentimiento previo</strong> del usuario conforme al art. 22.2 LSSI-CE.</p>
                    <div class="table-responsive">
                        <table style="width:100%;border-collapse:collapse;margin-top:12px;font-size:0.9rem;">
                            <thead>
                                <tr style="background:var(--primary-color,#D93690);color:white;">
                                    <th style="padding:12px 16px;text-align:left;">Nombre</th>
                                    <th style="padding:12px 16px;text-align:left;">Tipo</th>
                                    <th style="padding:12px 16px;text-align:left;">Finalidad</th>
                                    <th style="padding:12px 16px;text-align:left;">Duración</th>
                                    <th style="padding:12px 16px;text-align:left;">Titular</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom:1px solid #eee;">
                                    <td style="padding:12px 16px;"><code>ecos_session</code></td>
                                    <td style="padding:12px 16px;">Técnica</td>
                                    <td style="padding:12px 16px;">Mantiene la sesión activa del usuario durante la navegación</td>
                                    <td style="padding:12px 16px;">Sesión (se elimina al cerrar el navegador)</td>
                                    <td style="padding:12px 16px;">Propia</td>
                                </tr>
                                <tr style="border-bottom:1px solid #eee;background:#fafafa;">
                                    <td style="padding:12px 16px;"><code>XSRF-TOKEN</code></td>
                                    <td style="padding:12px 16px;">Seguridad</td>
                                    <td style="padding:12px 16px;">Protección contra ataques de falsificación de solicitudes (CSRF)</td>
                                    <td style="padding:12px 16px;">Sesión</td>
                                    <td style="padding:12px 16px;">Propia</td>
                                </tr>
                                <tr style="border-bottom:1px solid #eee;">
                                    <td style="padding:12px 16px;"><code>remember_alumno_*</code></td>
                                    <td style="padding:12px 16px;">Funcional</td>
                                    <td style="padding:12px 16px;">Recuerda las credenciales del alumno para facilitar el acceso futuro (solo si seleccionó «Recuérdame»)</td>
                                    <td style="padding:12px 16px;">5 años</td>
                                    <td style="padding:12px 16px;">Propia</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">4. ¿Cómo gestionar o eliminar las cookies?</h2>
                    <p>Puedes configurar tu navegador para bloquear o eliminar las cookies en cualquier momento. A continuación encontrarás las instrucciones para los navegadores más utilizados:</p>
                    <ul>
                        <li><a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener noreferrer">Google Chrome</a></li>
                        <li><a href="https://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-sitios-web-rastrear-preferencias" target="_blank" rel="noopener noreferrer">Mozilla Firefox</a></li>
                        <li><a href="https://support.apple.com/es-es/guide/safari/sfri11471/mac" target="_blank" rel="noopener noreferrer">Safari (macOS)</a></li>
                        <li><a href="https://support.apple.com/es-es/105082" target="_blank" rel="noopener noreferrer">Safari (iOS / iPhone)</a></li>
                        <li><a href="https://support.microsoft.com/es-es/microsoft-edge/eliminar-las-cookies-en-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" rel="noopener noreferrer">Microsoft Edge</a></li>
                        <li><a href="https://help.opera.com/en/latest/web-preferences/#cookies" target="_blank" rel="noopener noreferrer">Opera</a></li>
                    </ul>
                    <p style="color:#e55;font-size:0.9rem;"><strong>Aviso:</strong> deshabilitar las cookies técnicas puede impedir el correcto funcionamiento del Sitio Web, incluyendo el inicio de sesión y el acceso a los cursos.</p>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">5. Cookies de terceros</h2>
                    <p>Actualmente este Sitio Web <strong>no instala cookies de terceros</strong> de ningún tipo (analítica, publicidad, redes sociales, mapas, etc.). Si en el futuro se incorporara alguna, esta Política de Cookies se actualizará con carácter previo a su instalación.</p>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">6. Más información</h2>
                    <p>Para más información sobre el tratamiento de datos personales, consulta nuestra <a href="{{ route('webacademia.privacidad') }}">Política de Privacidad</a>. También puedes consultar la guía sobre cookies de la <a href="https://www.aepd.es/guias/guia-cookies.pdf" target="_blank" rel="noopener noreferrer">Agencia Española de Protección de Datos (AEPD)</a>.</p>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">7. Actualizaciones de esta política</h2>
                    <p>Grupo ECOS puede actualizar esta Política de Cookies en cualquier momento para adaptarla a cambios técnicos, legislativos o de servicios. Le recomendamos revisarla periódicamente.</p>

                    <p style="margin-top:40px;font-size:0.85rem;color:#999;">Última actualización: mayo de 2026</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
