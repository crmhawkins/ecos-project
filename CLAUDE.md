# Memoria de sesión — Proyecto ECOS

## Descripción del proyecto
**ECOS** es una plataforma enterprise Laravel 12 que combina:
- CRM interno (`/crm/*`) — gestión de clientes, presupuestos, facturas, tareas, RRHH
- E-learning público (`/course`, `/cart`) — cursos, alumnos, integración Moodle
- Website builder (GrapesJS)
- Asistente AI (OpenAI + Hawkins AI)

**Stack:** Laravel 12, PHP 8.2+, MySQL, Livewire 3.6, Tailwind 4, Bootstrap 5, Vite 6

---

## Entornos

### Producción
- URL: `https://ecos.hawkins.es`
- DB: MySQL local (`127.0.0.1`), base `Ecos`, usuario `Ecos`
- Session: `database`
- Cache: `database`

### Pruebas (Docker)
- URL: `https://nginx-r8w8c8sg04csgsoscgkgw48o.217.160.39.81.sslip.io`
- URL pública: `https://ecosprueba.hawkins.es`
- DB: MariaDB (`mariadb`), base `Ecos-prueba-db`
- Session: `file`
- Cache: `file`
- IP del servidor: `217.160.39.81`
- Contenedores: `laravel`, `nginx`, `mariadb`, `phpmyadmin`

---

## Moodle

- URL: `https://grupoecos.net/moodle`
- Token producción: `abf0080b9db0bbc9db8f16cb80883f9a` (servicio: Laravel Integration, usuario: Hawkins desarrollo)
- Token pruebas: `3dc95d1d08d03c43e7f040711af3578f` (restringido a IP 217.160.39.81)
- **Problema conocido:** El servidor de Moodle (`217.76.132.137`) bloquea conexiones desde la IP del entorno de prueba (`217.160.39.81`). Moodle no funciona en pruebas por firewall — funciona correctamente en producción.
- Protocolo: REST, Formato: JSON

---

## Problema resuelto en esta sesión

### 1. Tabla `sessions` no encontrada
- **Síntoma:** 500 en todas las peticiones, log lleno de `Table 'Ecos.sessions' doesn't exist`
- **Causa:** La tabla existía pero se cayó en algún momento. La migración ya estaba marcada como ejecutada.
- **Solución:** Recrear la tabla manualmente vía SQL o tinker.

### 2. Panel Moodle daba 500
- **Causa:** 14 archivos blade del módulo Moodle tenían un bloque `<?php namespace App\Modules\Moodle\Resources\views\...; ?>` al inicio, lo que hacía que PHP compilara las vistas dentro de ese namespace, rompiendo toda resolución de clases.
- **Fix:** Script Node.js eliminó el bloque de los 14 archivos.
- **Archivos afectados:** Todos los `.blade.php` en `app/Modules/Moodle/Resources/views/`

---

## Cambios implementados (branch `claude/quirky-cerf`)

### Seguridad
| Archivo | Cambio |
|---------|--------|
| `routes/web.php` | Rutas PDF (`/invoice/generate-pdf`, `/budget/generate-pdf`) movidas dentro del grupo `auth` |
| `app/Http/Controllers/Users/UserController.php` | Validación MIME en `avatar()`: solo jpg/jpeg/png/gif/webp, máx 2MB |
| `app/Http/Controllers/Builder/BuilderController.php` | Whitelist de MIME types en `upload()` — bloquea ejecutables |
| `app/Http/Controllers/Web/WebController.php` | Slug sanitizado con regex `[a-zA-Z0-9_\-]+` en `showSlug()` |

### Funcional / Moodle
| Archivo | Cambio |
|---------|--------|
| `app/Modules/Moodle/Controllers/CertificateController.php` | `->filename` → `->file_path` en `download()` |
| `app/Modules/Moodle/Services/MoodleUserService.php` | ID hardcodeado `8813` eliminado de `searchUsers()` |
| `app/Http/Controllers/Alumnos/AlumnosController.php` | `syncMoodle()` implementado: busca alumno en Moodle por email y guarda ID real |
| `app/Modules/Moodle/Services/CertificateGeneratorService.php` | Ruta de verificación: `verify.get` → `verify.id` |
| `app/Modules/Moodle/Resources/views/**/*.blade.php` | Eliminados bloques PHP namespace inválidos de 14 vistas |

---

## Estado del PR
- **Branch:** `claude/quirky-cerf`
- **Repo:** `https://github.com/crmhawkins/ecos-project`
- **URL para crear PR:** `https://github.com/crmhawkins/ecos-project/pull/new/claude/quirky-cerf`
- **Commits:**
  - `de5d094` — Fix security vulnerabilities and Moodle integration bugs
  - `bae3c42` — Fix 500 error on Moodle admin panel - remove invalid PHP namespaces from blade views
- **Estado:** Listo para mergear a producción

---

## Variables de entorno importantes

### Producción (`/var/www/vhosts/hawkins.es/ecos.hawkins.es/.env`)
```
MOODLE_API_TOKEN=abf0080b9db0bbc9db8f16cb80883f9a
MOODLE_CERTIFICATES_PATH=/var/www/vhosts/hawkins.es/ecos.hawkins.es/storage/app/certificates
SESSION_DRIVER=database
CACHE_STORE=database
```

### Pruebas
```
MOODLE_API_TOKEN=3dc95d1d08d03c43e7f040711af3578f
MOODLE_CERTIFICATES_PATH=/var/www/html/storage/app/certificates
SESSION_DRIVER=file
CACHE_STORE=file
```

---

## Comandos útiles post-deploy
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan migrate
```
