<?php

namespace App\Http\Middleware;

use App\Models\UserSettings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class ApplyUserSettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // Obtener configuraciones del usuario
            $settings = UserSettings::getForUser($user->id);
            
            // Aplicar idioma
            if ($settings->language) {
                app()->setLocale($settings->language);
            }
            
            // Aplicar zona horaria
            if ($settings->timezone) {
                config(['app.timezone' => $settings->timezone]);
                date_default_timezone_set($settings->timezone);
            }
            
            // Guardar configuraciones en sesión para acceso rápido
            Session::put('user_settings', $settings->toArray());
            Session::put('user_theme', $settings->theme);
            Session::put('user_language', $settings->language);
            Session::put('user_timezone', $settings->timezone);
        }

        return $next($request);
    }
}