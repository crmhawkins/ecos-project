<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // Si el guard que falló es 'alumno', redirigir al login de la web academia
        if (in_array('alumno', (array) $this->guards)) {
            return url('/weblogin');
        }

        // Determinar la ruta de redirección basada en el contexto
        if ($request->is('crm/*') || $request->is('moodle/*')) {
            return route('login');
        }

        // Para rutas de la web academia
        if ($request->is('weblogin') || $request->is('webregister') || $request->is('perfil') || $request->is('perfil/*') || $request->is('carrito') || $request->is('carrito/*')) {
            return url('/weblogin');
        }

        // Por defecto, redirigir al login del CRM
        return route('login');
    }
}
