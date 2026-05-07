@extends('webacademia.layouts.web_layout')

@section('title', 'Política de Privacidad — Grupo ECOS')

@section('content')
<section class="section-top">
    <div class="container">
        <div class="col-lg-10 offset-lg-1 text-center">
            <div class="section-top-title">
                <h1>Política de Privacidad</h1>
                <ul>
                    <li><a href="/">Inicio</a></li>
                    <li> / Política de Privacidad</li>
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
                        En Grupo ECOS respetamos tu privacidad y nos comprometemos a proteger tus datos personales conforme al <strong>Reglamento (UE) 2016/679 (RGPD)</strong> y la <strong>Ley Orgánica 3/2018 (LOPDGDD)</strong>.
                    </p>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">1. Responsable del tratamiento</h2>
                    <ul>
                        <li><strong>Identidad:</strong> Grupo ECOS</li>
                        <li><strong>Correo electrónico:</strong> <a href="mailto:info@grupoecos.net">info@grupoecos.net</a></li>
                        <li><strong>Sitio web:</strong> grupoecos.net</li>
                    </ul>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">2. Finalidades y base jurídica del tratamiento</h2>
                    <div class="table-responsive">
                        <table style="width:100%;border-collapse:collapse;margin-top:12px;font-size:0.9rem;">
                            <thead>
                                <tr style="background:var(--primary-color,#D93690);color:white;">
                                    <th style="padding:12px 16px;text-align:left;">Finalidad</th>
                                    <th style="padding:12px 16px;text-align:left;">Base jurídica</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom:1px solid #eee;">
                                    <td style="padding:12px 16px;">Gestión de la cuenta de alumno (registro, acceso a la plataforma)</td>
                                    <td style="padding:12px 16px;">Ejecución de contrato — art. 6.1.b RGPD</td>
                                </tr>
                                <tr style="border-bottom:1px solid #eee;background:#fafafa;">
                                    <td style="padding:12px 16px;">Matriculación en cursos, seguimiento del progreso y emisión de certificados</td>
                                    <td style="padding:12px 16px;">Ejecución de contrato — art. 6.1.b RGPD</td>
                                </tr>
                                <tr style="border-bottom:1px solid #eee;">
                                    <td style="padding:12px 16px;">Atención al usuario y respuesta a consultas</td>
                                    <td style="padding:12px 16px;">Interés legítimo — art. 6.1.f RGPD</td>
                                </tr>
                                <tr style="border-bottom:1px solid #eee;background:#fafafa;">
                                    <td style="padding:12px 16px;">Envío de comunicaciones comerciales sobre cursos y promociones</td>
                                    <td style="padding:12px 16px;">Consentimiento expreso — art. 6.1.a RGPD</td>
                                </tr>
                                <tr style="border-bottom:1px solid #eee;">
                                    <td style="padding:12px 16px;">Cumplimiento de obligaciones legales (contables, fiscales)</td>
                                    <td style="padding:12px 16px;">Obligación legal — art. 6.1.c RGPD</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">3. Datos tratados</h2>
                    <p>En función de la actividad, tratamos los siguientes datos:</p>
                    <ul>
                        <li><strong>Registro de alumno:</strong> nombre, apellidos, correo electrónico, teléfono y contraseña cifrada.</li>
                        <li><strong>Contratación de cursos:</strong> datos de facturación y, en su caso, datos de pago (gestionados por el proveedor de pagos bajo su propia política de privacidad).</li>
                        <li><strong>Formulario de contacto:</strong> nombre, correo electrónico, asunto y mensaje.</li>
                        <li><strong>Navegación:</strong> datos técnicos recogidos mediante cookies necesarias (ver <a href="{{ route('webacademia.cookies') }}">Política de Cookies</a>).</li>
                    </ul>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">4. Conservación de datos</h2>
                    <div class="table-responsive">
                        <table style="width:100%;border-collapse:collapse;margin-top:12px;font-size:0.9rem;">
                            <thead>
                                <tr style="background:var(--primary-color,#D93690);color:white;">
                                    <th style="padding:12px 16px;text-align:left;">Tipo de dato</th>
                                    <th style="padding:12px 16px;text-align:left;">Período de conservación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom:1px solid #eee;">
                                    <td style="padding:12px 16px;">Cuenta de alumno activa</td>
                                    <td style="padding:12px 16px;">Mientras la cuenta esté activa</td>
                                </tr>
                                <tr style="border-bottom:1px solid #eee;background:#fafafa;">
                                    <td style="padding:12px 16px;">Datos de facturación y contratos</td>
                                    <td style="padding:12px 16px;">6 años (obligación mercantil y fiscal)</td>
                                </tr>
                                <tr style="border-bottom:1px solid #eee;">
                                    <td style="padding:12px 16px;">Comunicaciones comerciales (con consentimiento)</td>
                                    <td style="padding:12px 16px;">Hasta que retires el consentimiento</td>
                                </tr>
                                <tr style="border-bottom:1px solid #eee;background:#fafafa;">
                                    <td style="padding:12px 16px;">Consultas y mensajes de contacto</td>
                                    <td style="padding:12px 16px;">3 años desde la última comunicación</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p style="font-size:0.88rem;color:#666;margin-top:8px;">Transcurridos estos plazos, los datos serán suprimidos o anonimizados.</p>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">5. Destinatarios y encargados del tratamiento</h2>
                    <p>Sus datos no serán cedidos a terceros salvo obligación legal o cuando sea estrictamente necesario para la prestación del servicio:</p>
                    <ul>
                        <li><strong>Plataforma Moodle:</strong> gestión de la actividad formativa (acceso al campus virtual).</li>
                        <li><strong>Proveedor de alojamiento:</strong> infraestructura tecnológica del Sitio Web.</li>
                        <li><strong>Proveedores de pago:</strong> procesamiento seguro de transacciones (bajo su propia política de privacidad).</li>
                    </ul>
                    <p>No se realizan transferencias internacionales de datos fuera del Espacio Económico Europeo. En caso de que fuera necesario, se adoptarán las garantías adecuadas conforme al RGPD.</p>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">6. Tus derechos</h2>
                    <p>Puedes ejercer en cualquier momento los siguientes derechos escribiendo a <a href="mailto:info@grupoecos.net">info@grupoecos.net</a>, adjuntando una copia de tu documento de identidad:</p>
                    <ul>
                        <li><strong>Acceso:</strong> conocer qué datos tratamos sobre ti.</li>
                        <li><strong>Rectificación:</strong> corregir datos inexactos o incompletos.</li>
                        <li><strong>Supresión («derecho al olvido»):</strong> solicitar la eliminación de tus datos cuando ya no sean necesarios.</li>
                        <li><strong>Limitación:</strong> solicitar la restricción del tratamiento en determinadas circunstancias.</li>
                        <li><strong>Portabilidad:</strong> recibir tus datos en un formato estructurado, de uso común y lectura mecánica.</li>
                        <li><strong>Oposición:</strong> oponerte al tratamiento de tus datos basado en interés legítimo o con fines de marketing directo.</li>
                        <li><strong>Retirada del consentimiento:</strong> puedes retirar en cualquier momento el consentimiento otorgado, sin que ello afecte a la licitud del tratamiento anterior a su retirada.</li>
                    </ul>
                    <p>Responderemos a tu solicitud en el plazo máximo de <strong>un mes</strong> desde su recepción. Asimismo, tienes derecho a presentar una reclamación ante la <strong>Agencia Española de Protección de Datos (AEPD)</strong> en <a href="https://www.aepd.es" target="_blank" rel="noopener">www.aepd.es</a>.</p>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">7. Seguridad</h2>
                    <p>Grupo ECOS ha adoptado las medidas técnicas y organizativas necesarias para garantizar la seguridad e integridad de los datos personales y evitar su pérdida, alteración o acceso no autorizado, habida cuenta del estado de la tecnología, la naturaleza de los datos almacenados y los riesgos a los que están expuestos.</p>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">8. Modificaciones</h2>
                    <p>Grupo ECOS puede actualizar esta Política de Privacidad para adaptarla a cambios legislativos, jurisprudenciales o de sus servicios. Le notificaremos los cambios significativos mediante aviso en el Sitio Web o por correo electrónico.</p>

                    <p style="margin-top:40px;font-size:0.85rem;color:#999;">Última actualización: mayo de 2026</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
