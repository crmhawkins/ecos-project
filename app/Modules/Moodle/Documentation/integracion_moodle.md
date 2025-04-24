# Documentación del Módulo Moodle para Laravel 12

## Introducción

Este documento proporciona una guía completa para la integración del módulo Moodle con Laravel 12. El módulo permite la conexión con la API REST de Moodle 3.11.18 y ofrece funcionalidades para gestionar usuarios, cursos, matriculaciones y certificados.

## Arquitectura

El módulo sigue una arquitectura modular y está diseñado para funcionar en entornos multitenant. La estructura del módulo es la siguiente:

```
app/Modules/Moodle/
├── Config/
│   └── config.php
├── Controllers/
│   ├── AdminController.php
│   ├── CertificateController.php
│   └── StudentController.php
├── Database/
│   ├── Migrations/
│   │   └── 2025_04_21_000001_create_moodle_certificates_table.php
│   └── Seeders/
├── Models/
│   └── MoodleCertificate.php
├── Providers/
│   └── MoodleServiceProvider.php
├── Resources/
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   └── images/
│   └── views/
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── users.blade.php
│       │   ├── courses.blade.php
│       │   ├── enrollments.blade.php
│       │   ├── certificates.blade.php
│       │   ├── settings.blade.php
│       │   └── layout.blade.php
│       ├── student/
│       │   ├── dashboard.blade.php
│       │   ├── courses.blade.php
│       │   ├── course_detail.blade.php
│       │   ├── certificates.blade.php
│       │   └── layout.blade.php
│       ├── certificates/
│       │   ├── template_preview.blade.php
│       │   └── verification.blade.php
│       └── components/
│           └── notifications.blade.php
├── Routes/
│   ├── admin.php
│   ├── student.php
│   └── certificate.php
├── Services/
│   ├── MoodleApiService.php
│   ├── MoodleAuthService.php
│   ├── MoodleUserService.php
│   ├── MoodleCourseService.php
│   ├── MoodleEnrollmentService.php
│   └── CertificateGeneratorService.php
└── Tests/
    ├── Unit/
    └── Feature/
```

## Servicios

### MoodleApiService

Este servicio proporciona la funcionalidad base para comunicarse con la API REST de Moodle. Maneja la autenticación, las solicitudes HTTP y el procesamiento de respuestas.

```php
// Ejemplo de uso
$moodleApiService = app(MoodleApiService::class);
$response = $moodleApiService->call('core_user_get_users', ['criteria' => [['key' => 'email', 'value' => 'usuario@ejemplo.com']]]);
```

### MoodleAuthService

Gestiona la autenticación con Moodle, incluyendo la obtención y validación de tokens.

```php
// Ejemplo de uso
$moodleAuthService = app(MoodleAuthService::class);
$token = $moodleAuthService->getToken();
$isValid = $moodleAuthService->validateToken($token);
```

### MoodleUserService

Proporciona métodos para gestionar usuarios en Moodle, como crear, actualizar, eliminar y buscar usuarios.

```php
// Ejemplo de uso
$moodleUserService = app(MoodleUserService::class);
$user = $moodleUserService->createUser([
    'username' => 'usuario1',
    'password' => 'contraseña',
    'firstname' => 'Nombre',
    'lastname' => 'Apellido',
    'email' => 'usuario@ejemplo.com'
]);
```

### MoodleCourseService

Permite gestionar cursos en Moodle, incluyendo la creación, actualización, eliminación y búsqueda de cursos.

```php
// Ejemplo de uso
$moodleCourseService = app(MoodleCourseService::class);
$courses = $moodleCourseService->getCourses();
$course = $moodleCourseService->getCourse(1);
```

### MoodleEnrollmentService

Gestiona las matriculaciones de usuarios en cursos de Moodle.

```php
// Ejemplo de uso
$moodleEnrollmentService = app(MoodleEnrollmentService::class);
$moodleEnrollmentService->enrollUser(1, 2, 5); // userId, courseId, roleId
$enrolledUsers = $moodleEnrollmentService->getEnrolledUsers(2); // courseId
```

### CertificateGeneratorService

Genera certificados PDF para los usuarios que han completado cursos en Moodle.

```php
// Ejemplo de uso
$certificateGeneratorService = app(CertificateGeneratorService::class);
$certificate = $certificateGeneratorService->generateCertificate(1, 2); // userId, courseId
```

## Controladores

### AdminController

Gestiona las funcionalidades del panel de administración, incluyendo el dashboard y la configuración del módulo.

### StudentController

Maneja las funcionalidades del panel de estudiante, incluyendo la visualización de cursos, progreso y certificados.

### CertificateController

Controla la generación, descarga y verificación de certificados.

## Modelos

### MoodleCertificate

Representa un certificado emitido para un usuario que ha completado un curso en Moodle.

## Rutas

### admin.php

Define las rutas para el panel de administración.

```php
Route::prefix('moodle/admin')->name('moodle.admin.')->middleware(['web', 'auth', 'admin'])->group(function () {
    Route::get('/', 'AdminController@dashboard')->name('dashboard');
    Route::get('/users', 'AdminController@users')->name('users');
    Route::get('/courses', 'AdminController@courses')->name('courses');
    Route::get('/enrollments', 'AdminController@enrollments')->name('enrollments');
    Route::get('/certificates', 'AdminController@certificates')->name('certificates');
    Route::get('/settings', 'AdminController@settings')->name('settings');
    // ... más rutas
});
```

### student.php

Define las rutas para el panel de estudiante.

```php
Route::prefix('moodle/student')->name('moodle.student.')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', 'StudentController@dashboard')->name('dashboard');
    Route::get('/courses', 'StudentController@courses')->name('courses');
    Route::get('/course/{id}', 'StudentController@courseDetail')->name('course');
    Route::get('/certificates', 'StudentController@certificates')->name('certificates');
    // ... más rutas
});
```

### certificate.php

Define las rutas para la gestión de certificados.

```php
Route::prefix('moodle/certificates')->name('moodle.certificates.')->middleware(['web'])->group(function () {
    Route::get('/download/{filename}', 'CertificateController@download')->name('download');
    Route::get('/verify', 'CertificateController@verifyForm')->name('verify.get');
    Route::post('/verify', 'CertificateController@verify')->name('verify.post');
    // ... más rutas
});
```

## Vistas

### Panel de Administración

- **dashboard.blade.php**: Panel principal con resumen de estadísticas.
- **users.blade.php**: Gestión de usuarios de Moodle.
- **courses.blade.php**: Gestión de cursos de Moodle.
- **enrollments.blade.php**: Gestión de matriculaciones de usuarios en cursos.
- **certificates.blade.php**: Gestión de certificados emitidos.
- **settings.blade.php**: Configuración del módulo Moodle.

### Panel de Estudiante

- **dashboard.blade.php**: Panel principal con resumen de cursos y progreso.
- **courses.blade.php**: Lista de cursos matriculados y disponibles.
- **course_detail.blade.php**: Detalle de un curso específico.
- **certificates.blade.php**: Certificados obtenidos por el estudiante.

### Certificados

- **template_preview.blade.php**: Vista previa de la plantilla de certificado.
- **verification.blade.php**: Página de verificación de certificados.

## Configuración

El módulo se configura a través del archivo `config.php` en el directorio `Config`. Las principales opciones de configuración son:

```php
return [
    'url' => env('MOODLE_API_URL', 'https://moodle.ejemplo.com'),
    'token' => env('MOODLE_API_TOKEN', ''),
    'protocol' => env('MOODLE_API_PROTOCOL', 'rest'),
    'format' => env('MOODLE_API_FORMAT', 'json'),
    'cache_enabled' => env('MOODLE_CACHE_ENABLED', false),
    'cache_ttl' => env('MOODLE_CACHE_TTL', 3600),
    'auto_create_users' => env('MOODLE_AUTO_CREATE_USERS', false),
    'auto_update_users' => env('MOODLE_AUTO_UPDATE_USERS', false),
    'default_role' => env('MOODLE_DEFAULT_ROLE', 'student'),
    'auto_enroll' => env('MOODLE_AUTO_ENROLL', false),
    'enroll_method' => env('MOODLE_ENROLL_METHOD', 'manual'),
    'certificates_path' => env('MOODLE_CERTIFICATES_PATH', storage_path('app/certificates')),
    'certificate_template' => env('MOODLE_CERTIFICATE_TEMPLATE', 'default'),
    'signature_image' => env('MOODLE_SIGNATURE_IMAGE', ''),
];
```

## Migraciones

El módulo incluye una migración para crear la tabla `moodle_certificates` que almacena la información de los certificados emitidos.

```php
Schema::create('moodle_certificates', function (Blueprint $table) {
    $table->id();
    $table->string('certificate_id')->unique();
    $table->unsignedBigInteger('user_id');
    $table->string('user_name');
    $table->unsignedBigInteger('course_id');
    $table->string('course_name');
    $table->string('filename');
    $table->timestamp('issued_at');
    $table->boolean('verified')->default(false);
    $table->timestamps();
});
```

## Integración con la API de Moodle

### Requisitos en Moodle

Para que el módulo funcione correctamente, se deben configurar los siguientes aspectos en Moodle:

1. **Habilitar servicios web**:
   - Ir a Administración del sitio > Características avanzadas
   - Habilitar los servicios web
   - Guardar los cambios

2. **Habilitar el protocolo REST**:
   - Ir a Administración del sitio > Plugins > Servicios web > Administrar protocolos
   - Habilitar el protocolo REST
   - Guardar los cambios

3. **Crear un servicio web personalizado**:
   - Ir a Administración del sitio > Plugins > Servicios web > Servicios externos
   - Crear un nuevo servicio (por ejemplo, "Laravel Integration")
   - Marcar las casillas "Habilitado", "Autorizado para usuarios" y "Puede descargar archivos"

4. **Añadir funciones al servicio**:
   - Añadir las siguientes funciones al servicio:
     - core_user_create_users
     - core_user_update_users
     - core_user_delete_users
     - core_user_get_users
     - core_course_get_courses
     - core_course_create_courses
     - core_course_update_courses
     - core_course_delete_courses
     - core_course_get_contents
     - core_enrol_get_enrolled_users
     - enrol_manual_enrol_users
     - enrol_manual_unenrol_users
     - gradereport_user_get_grade_items
     - mod_certificate_get_certificates
     - mod_certificate_issue_certificate

5. **Generar un token de API**:
   - Ir a Administración del sitio > Plugins > Servicios web > Administrar tokens
   - Crear un nuevo token para el servicio creado anteriormente
   - Copiar el token generado y configurarlo en el archivo `.env` de Laravel

### Funciones de la API utilizadas

El módulo utiliza las siguientes funciones de la API de Moodle:

- **core_user_create_users**: Crear usuarios en Moodle.
- **core_user_update_users**: Actualizar usuarios existentes en Moodle.
- **core_user_delete_users**: Eliminar usuarios de Moodle.
- **core_user_get_users**: Obtener información de usuarios de Moodle.
- **core_course_get_courses**: Obtener lista de cursos de Moodle.
- **core_course_create_courses**: Crear cursos en Moodle.
- **core_course_update_courses**: Actualizar cursos existentes en Moodle.
- **core_course_delete_courses**: Eliminar cursos de Moodle.
- **core_course_get_contents**: Obtener contenido de un curso de Moodle.
- **core_enrol_get_enrolled_users**: Obtener usuarios matriculados en un curso.
- **enrol_manual_enrol_users**: Matricular usuarios en un curso.
- **enrol_manual_unenrol_users**: Desmatricular usuarios de un curso.
- **gradereport_user_get_grade_items**: Obtener calificaciones de un usuario en un curso.
- **mod_certificate_get_certificates**: Obtener certificados de un usuario.
- **mod_certificate_issue_certificate**: Emitir un certificado para un usuario.

## Generación de Certificados

El módulo incluye un servicio para generar certificados PDF para los usuarios que han completado cursos en Moodle. Los certificados se generan utilizando la biblioteca TCPDF y se almacenan en el directorio configurado en `certificates_path`.

### Proceso de generación

1. Se verifica que el usuario haya completado el curso.
2. Se genera un ID único para el certificado.
3. Se crea un PDF utilizando la plantilla configurada.
4. Se almacena el certificado en el sistema de archivos.
5. Se registra el certificado en la base de datos.
6. Se genera un código QR para la verificación del certificado.

### Verificación de certificados

Los certificados pueden ser verificados a través de la página de verificación, utilizando el ID del certificado o escaneando el código QR.

## Eventos y Listeners

El módulo define los siguientes eventos y listeners para automatizar ciertas tareas:

### Eventos

- **UserCreated**: Se dispara cuando se crea un usuario en Laravel.
- **UserUpdated**: Se dispara cuando se actualiza un usuario en Laravel.
- **UserDeleted**: Se dispara cuando se elimina un usuario en Laravel.
- **PaymentCompleted**: Se dispara cuando se completa un pago.
- **CourseCompleted**: Se dispara cuando un usuario completa un curso.

### Listeners

- **CreateMoodleUser**: Crea un usuario en Moodle cuando se crea en Laravel.
- **UpdateMoodleUser**: Actualiza un usuario en Moodle cuando se actualiza en Laravel.
- **DeleteMoodleUser**: Elimina un usuario en Moodle cuando se elimina en Laravel.
- **EnrollUserAfterPayment**: Matricula a un usuario en un curso después de completar un pago.
- **GenerateCertificate**: Genera un certificado cuando un usuario completa un curso.

## Multitenant

El módulo está diseñado para funcionar en entornos multitenant, donde cada tenant puede tener su propia configuración de Moodle. La configuración específica de cada tenant se almacena en la base de datos y se carga dinámicamente según el tenant actual.

## Caché

El módulo incluye soporte para caché, lo que mejora el rendimiento al reducir el número de solicitudes a la API de Moodle. La caché se puede habilitar o deshabilitar a través de la configuración.

## Pruebas

El módulo incluye pruebas unitarias y de integración para verificar su correcto funcionamiento. Las pruebas se encuentran en el directorio `Tests`.

## Solución de problemas

### Problemas comunes

1. **Error de conexión con la API de Moodle**:
   - Verificar que la URL y el token de API sean correctos.
   - Comprobar que los servicios web estén habilitados en Moodle.
   - Verificar que el protocolo REST esté habilitado.

2. **Error al crear usuarios en Moodle**:
   - Verificar que el servicio web tenga permisos para crear usuarios.
   - Comprobar que los datos del usuario sean válidos.

3. **Error al matricular usuarios en cursos**:
   - Verificar que el método de matriculación manual esté habilitado en el curso.
   - Comprobar que el usuario y el curso existan en Moodle.

4. **Error al generar certificados**:
   - Verificar que el directorio de certificados tenga permisos de escritura.
   - Comprobar que el usuario haya completado el curso.
   - Verificar que la plantilla de certificado exista.

### Logs

El módulo registra información detallada en los logs de Laravel, lo que facilita la depuración de problemas. Los logs se encuentran en el directorio `storage/logs`.

## Conclusión

Este módulo proporciona una integración completa con Moodle, permitiendo gestionar usuarios, cursos, matriculaciones y certificados desde Laravel. La arquitectura modular y el diseño multitenant facilitan su integración en proyectos existentes.

Para más información, consulte la documentación oficial de la API de Moodle: [https://docs.moodle.org/dev/Web_service_API_functions](https://docs.moodle.org/dev/Web_service_API_functions)
