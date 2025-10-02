<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HandleSessionExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Solo procesar si la respuesta es una redirección de autenticación
        $response = $next($request);
        
        // Si la respuesta es una redirección a login y es una petición AJAX
        if ($response->isRedirection() && 
            ($request->expectsJson() || $request->ajax()) && 
            str_contains($response->getTargetUrl(), 'login')) {
            
            return response()->json([
                'message' => 'Tu sesión ha expirado. Por favor, inicia sesión nuevamente.',
                'redirect' => $response->getTargetUrl()
            ], 401);
        }

        return $response;
    }

}
