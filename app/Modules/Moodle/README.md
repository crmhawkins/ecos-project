# Módulo Moodle para Laravel 12

Este módulo proporciona una integración completa entre Laravel 12 y Moodle 3.11.18, permitiendo gestionar usuarios, cursos, matriculaciones y certificados desde una aplicación Laravel.

## Características

- Conexión completa con la API REST de Moodle 3.11.18
- Gestión de usuarios (crear, actualizar, eliminar)
- Matriculación automática tras el pago
- Consulta de cursos, progreso, calificaciones y finalización
- Gestión de cursos, categorías, roles y grupos
- Generación de certificados PDF personalizados
- Panel de administración para gestión del módulo
- Panel de estudiante con información de progreso y certificados
- Notificaciones visuales para errores y acciones exitosas

## Requisitos

- Laravel 12
- PHP 8.1 o superior
- Moodle 3.11.18
- Extensión PHP TCPDF para generación de certificados

## Instalación

1. Copie la carpeta `Modules/Moodle` a la carpeta `app/Modules` de su proyecto Laravel.

2. Registre el proveedor de servicios en `config/app.php`:

```php
'providers' => [
    // ...
    App\Modules\Moodle\Providers\MoodleServiceProvider::class,
],
```

3. Publique los archivos de configuración:

```bash
php artisan vendor:publish --tag=moodle-config
```

4. Ejecute las migraciones:

```bash
php artisan migrate
```

5. Configure las variables de entorno en su archivo `.env`:

```
MOODLE_API_URL=https://su-moodle.ejemplo.com
MOODLE_API_TOKEN=su_token_de_api
MOODLE_API_PROTOCOL=rest
MOODLE_API_FORMAT=json
```

## Configuración de la API de Moodle

### Obtener un token de API

Para conectar Laravel con Moodle, necesita generar un token de API en su instalación de Moodle:

1. Inicie sesión en Moodle como administrador.
2. Vaya a **Administración del sitio > Plugins > Servicios web > Administrar tokens**.
3. Haga clic en **Crear token**.
4. Seleccione un usuario con permisos adecuados.
5. Seleccione el servicio que incluya todas las funciones necesarias (o cree uno nuevo).
6. Establezca una fecha de caducidad si es necesario.
7. Haga clic en **Guardar cambios**.
8. Copie el token generado y configúrelo en su archivo `.env`.

### Habilitar servicios web en Moodle

Si los servicios web no están habilitados en su instalación de Moodle:

1. Vaya a **Administración del sitio > Características avanzadas**.
2. Marque la casilla **Habilitar servicios web**.
3. Guarde los cambios.
4. Vaya a **Administración del sitio > Plugins > Servicios web > Administrar protocolos**.
5. Habilite el protocolo **REST**.
6. Guarde los cambios.

### Crear un servicio web personalizado

Para crear un servicio web personalizado con todas las funciones necesarias:

1. Vaya a **Administración del sitio > Plugins > Servicios web > Servicios externos**.
2. Haga clic en **Añadir**.
3. Proporcione un nombre para el servicio (por ejemplo, "Laravel Integration").
4. Marque las casillas "Habilitado", "Autorizado para usuarios" y "Puede descargar archivos".
5. Guarde los cambios.
6. Haga clic en **Añadir funciones** para el servicio recién creado.
7. Añada las siguientes funciones (mínimo requerido):

```
core_user_create_users
core_user_update_users
core_user_delete_users
core_user_get_users
core_course_get_courses
core_course_get_contents
core_course_create_courses
core_course_update_courses
core_course_delete_courses
core_course_get_categories
core_enrol_get_enrolled_users
enrol_manual_enrol_users
enrol_manual_unenrol_users
core_enrol_get_users_courses
gradereport_user_get_grade_items
core_completion_get_course_completion_status
core_webservice_get_site_info
```

8. Guarde los cambios.

## Uso del Módulo

### Panel de Administración

Acceda al panel de administración en `/moodle/admin`. Desde aquí puede:

- Ver el estado de la conexión con Moodle
- Gestionar usuarios
- Gestionar cursos y categorías
- Gestionar matriculaciones
- Gestionar certificados
- Configurar los ajustes del módulo

### Panel de Estudiante

Los estudiantes pueden acceder a su panel en `/moodle/student`. Desde aquí pueden:

- Ver sus cursos matriculados
- Consultar su progreso y calificaciones
- Descargar certificados de cursos completados

## Integración con el Sistema de Pagos

Para habilitar la matriculación automática tras el pago, debe integrar su sistema de pagos con el módulo Moodle. Ejemplo de código para matricular a un usuario después de un pago exitoso:

```php
use App\Modules\Moodle\Services\MoodleEnrollmentService;

// En su controlador de pagos
public function handleSuccessfulPayment($userId, $courseId, $paymentData)
{
    $enrollmentService = app(MoodleEnrollmentService::class);
    
    try {
        // Matricular al usuario en el curso después del pago
        $enrollmentService->enrollAfterPayment($userId, $courseId, $paymentData);
        
        return redirect()->route('moodle.student.courses')
            ->with('success', 'Has sido matriculado correctamente en el curso.');
    } catch (\Exception $e) {
        // Manejar el error
        return redirect()->route('moodle.student.courses')
            ->with('error', 'Error al matricularte en el curso: ' . $e->getMessage());
    }
}
```

## Generación de Certificados

El módulo incluye un sistema de generación de certificados PDF para cursos completados. Los certificados se generan automáticamente cuando un estudiante completa un curso, o pueden ser solicitados manualmente desde el panel de estudiante.

Para personalizar la plantilla de certificados, modifique el archivo `Resources/views/certificates/template_preview.blade.php`.

## Endpoints de la API

El módulo utiliza los siguientes endpoints principales de la API de Moodle:

- **Autenticación**: `/login/token.php`
- **API REST**: `/webservice/rest/server.php`

Ejemplo de llamada a la API:

```
https://su-moodle.ejemplo.com/webservice/rest/server.php?wstoken=su_token&wsfunction=core_user_get_users&moodlewsrestformat=json&criteria[0][key]=email&criteria[0][value]=usuario@ejemplo.com
```

## Solución de Problemas

### Problemas de Conexión

Si experimenta problemas de conexión con la API de Moodle:

1. Verifique que la URL de Moodle sea correcta y accesible.
2. Compruebe que el token de API sea válido y no haya expirado.
3. Asegúrese de que el usuario asociado al token tenga los permisos necesarios.
4. Verifique que los servicios web y el protocolo REST estén habilitados en Moodle.

### Errores en la Generación de Certificados

Si hay problemas con la generación de certificados:

1. Asegúrese de que la extensión TCPDF esté instalada y habilitada.
2. Verifique que la ruta de almacenamiento de certificados sea accesible y tenga permisos de escritura.
3. Compruebe que el usuario haya completado realmente el curso según los criterios de Moodle.

## Contribución

Si desea contribuir a este módulo, por favor envíe un pull request o abra un issue para discutir los cambios propuestos.

## Licencia

Este módulo está licenciado bajo la Licencia MIT.
