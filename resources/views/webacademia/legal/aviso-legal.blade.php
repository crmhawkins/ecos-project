@extends('webacademia.layouts.web_layout')

@section('title', 'Aviso Legal — Grupo ECOS')

@section('content')
<section class="section-top">
    <div class="container">
        <div class="col-lg-10 offset-lg-1 text-center">
            <div class="section-top-title">
                <h1>Aviso Legal</h1>
                <ul>
                    <li><a href="/">Inicio</a></li>
                    <li> / Aviso Legal</li>
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

                    <h2 style="color:var(--primary-color,#D93690);margin-bottom:8px;">1. Datos identificativos</h2>
                    <p>En cumplimiento del artículo 10 de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y de Comercio Electrónico (LSSI-CE), se informa de los siguientes datos identificativos del titular del sitio web:</p>
                    <ul>
                        <li><strong>Denominación social:</strong> Grupo ECOS</li>
                        <li><strong>Actividad:</strong> Centro de formación con más de 28 años de experiencia en Ceuta, Estepona y Melilla</li>
                        <li><strong>Correo electrónico:</strong> <a href="mailto:info@grupoecos.net">info@grupoecos.net</a></li>
                        <li><strong>Sitio web:</strong> grupoecos.net</li>
                    </ul>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">2. Objeto y ámbito de aplicación</h2>
                    <p>El presente Aviso Legal regula el acceso, navegación y uso del sitio web <strong>grupoecos.net</strong> (en adelante, «el Sitio Web»). La navegación por el Sitio Web implica la aceptación expresa y sin reservas de todas las disposiciones incluidas en este Aviso Legal, así como en la Política de Privacidad y la Política de Cookies.</p>
                    <p>Grupo ECOS se reserva el derecho a modificar, en cualquier momento y sin previo aviso, la presentación y configuración del Sitio Web, así como el presente Aviso Legal.</p>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">3. Condiciones de acceso y uso</h2>
                    <p>El acceso al Sitio Web es gratuito, salvo en lo relativo al coste de la conexión a través de la red de telecomunicaciones suministrada por el proveedor de acceso contratado por el usuario. El uso del Sitio Web está sujeto a las condiciones de uso descritas en este Aviso Legal.</p>
                    <p>El usuario se compromete a hacer un uso adecuado de los contenidos y servicios del Sitio Web, y en particular a no emplearlos para:</p>
                    <ul>
                        <li>Incurrir en actividades ilícitas, ilegales o contrarias a la buena fe y al orden público.</li>
                        <li>Difundir contenidos o propaganda de carácter racista, xenófobo, pornográfico, de apología del terrorismo o atentatorio contra los derechos humanos.</li>
                        <li>Provocar daños en los sistemas físicos y lógicos de Grupo ECOS, de sus proveedores o de terceras personas.</li>
                        <li>Introducir o difundir virus informáticos o cualquier otro sistema físico o lógico susceptible de provocar daños.</li>
                        <li>Intentar acceder, utilizar y/o manipular los datos de Grupo ECOS, terceros proveedores y otros usuarios.</li>
                    </ul>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">4. Propiedad intelectual e industrial</h2>
                    <p>Todos los contenidos del Sitio Web —incluyendo, sin carácter limitativo, textos, fotografías, gráficos, imágenes, iconos, tecnología, software, links y demás contenidos audiovisuales o sonoros, así como su diseño gráfico y código fuente— son propiedad intelectual de Grupo ECOS o de terceros con licencia, sin que puedan entenderse cedidos al usuario ninguno de los derechos de explotación reconocidos por la normativa vigente en materia de propiedad intelectual.</p>
                    <p>Queda expresamente prohibida la reproducción, distribución, comunicación pública o transformación de dichos contenidos sin la autorización previa y por escrito de Grupo ECOS, salvo para uso privado del usuario.</p>
                    <p>Las marcas, nombres comerciales o signos distintivos de Grupo ECOS no podrán ser utilizados sin el consentimiento previo y por escrito de su titular.</p>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">5. Exclusión de responsabilidad</h2>
                    <p>Grupo ECOS no garantiza la inexistencia de interrupciones o errores en el acceso al Sitio Web o a sus contenidos, ni que este se encuentre siempre actualizado, aunque pondrá su mayor diligencia en evitarlos o subsanarlos cuando los conozca.</p>
                    <p>Grupo ECOS no se responsabiliza de los contenidos de sitios web de terceros a los que pueda accederse mediante enlaces desde el Sitio Web. La presencia de enlaces no implica relación alguna entre Grupo ECOS y el titular del sitio enlazado, ni la aceptación o aprobación por parte de Grupo ECOS de sus contenidos o servicios.</p>
                    <p>Grupo ECOS queda exonerada de cualquier responsabilidad derivada de los daños y perjuicios de cualquier naturaleza que pudieran deberse al uso inadecuado de los servicios de libre disposición y uso por parte de los usuarios del Sitio Web.</p>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">6. Protección de datos personales</h2>
                    <p>El tratamiento de los datos personales que el usuario facilite a través del Sitio Web se realizará de conformidad con lo establecido en la <a href="{{ route('webacademia.privacidad') }}">Política de Privacidad</a>, que el usuario deberá leer y aceptar antes de facilitar sus datos personales.</p>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">7. Cookies</h2>
                    <p>El Sitio Web utiliza cookies técnicas y funcionales necesarias para su correcto funcionamiento. Puede obtener más información en nuestra <a href="{{ route('webacademia.cookies') }}">Política de Cookies</a>.</p>

                    <h2 style="color:var(--primary-color,#D93690);margin-top:32px;margin-bottom:8px;">8. Legislación aplicable y jurisdicción</h2>
                    <p>El presente Aviso Legal se rige íntegramente por la legislación española. Para la resolución de cualquier controversia que pudiera derivarse del acceso o uso del Sitio Web, las partes, con renuncia expresa a cualquier otro fuero que pudiera corresponderles, se someten a los Juzgados y Tribunales competentes conforme a la normativa vigente.</p>

                    <p style="margin-top:40px;font-size:0.85rem;color:#999;">Última actualización: mayo de 2026</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
