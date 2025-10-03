<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserSettingsController extends Controller
{
    /**
     * Mostrar la página de configuración
     */
    public function index()
    {
        $user = Auth::user();
        $settings = UserSettings::getForUser($user->id);
        
        return view('crm.user.settings', compact('user', 'settings'));
    }

    /**
     * Actualizar configuraciones del usuario
     */
    public function update(Request $request)
    {
        $request->validate([
            'language' => 'required|string|in:es,en,fr,de',
            'timezone' => 'required|string|max:50',
            'theme' => 'required|string|in:light,dark',
            'email_notifications' => 'boolean',
            'system_notifications' => 'boolean',
        ], [
            'language.required' => 'El idioma es obligatorio',
            'language.in' => 'El idioma seleccionado no es válido',
            'timezone.required' => 'La zona horaria es obligatoria',
            'timezone.max' => 'La zona horaria no puede tener más de 50 caracteres',
            'theme.required' => 'El tema es obligatorio',
            'theme.in' => 'El tema seleccionado no es válido',
            'email_notifications.boolean' => 'Las notificaciones por email deben ser verdadero o falso',
            'system_notifications.boolean' => 'Las notificaciones del sistema deben ser verdadero o falso',
        ]);

        $user = Auth::user();
        
        // Preparar datos para guardar
        $settingsData = [
            'language' => $request->language,
            'timezone' => $request->timezone,
            'theme' => $request->theme,
            'email_notifications' => $request->boolean('email_notifications'),
            'system_notifications' => $request->boolean('system_notifications'),
        ];

        // Guardar configuraciones
        UserSettings::updateOrCreateForUser($user->id, $settingsData);

        // Aplicar configuraciones inmediatamente
        $this->applySettings($settingsData);

        return redirect()->route('user.settings')
            ->with('success', 'Configuraciones actualizadas exitosamente.');
    }

    /**
     * Aplicar configuraciones a la sesión actual
     */
    private function applySettings(array $settings): void
    {
        // Guardar en sesión para aplicación inmediata
        Session::put('user_settings', $settings);
        
        // Aplicar zona horaria
        if (isset($settings['timezone'])) {
            Session::put('user_timezone', $settings['timezone']);
        }
        
        // Aplicar idioma
        if (isset($settings['language'])) {
            Session::put('user_language', $settings['language']);
            app()->setLocale($settings['language']);
        }
        
        // Aplicar tema
        if (isset($settings['theme'])) {
            Session::put('user_theme', $settings['theme']);
        }
    }

    /**
     * Obtener configuraciones del usuario actual
     */
    public static function getCurrentSettings(): array
    {
        $user = Auth::user();
        if (!$user) {
            return UserSettings::getDefaults();
        }

        $settings = UserSettings::getForUser($user->id);
        return $settings->toArray();
    }

    /**
     * Aplicar configuraciones al cargar la aplicación
     */
    public static function applyUserSettings(): void
    {
        $user = Auth::user();
        if (!$user) {
            return;
        }

        $settings = UserSettings::getForUser($user->id);
        
        // Aplicar idioma
        if ($settings->language) {
            app()->setLocale($settings->language);
        }
        
        // Aplicar zona horaria
        if ($settings->timezone) {
            config(['app.timezone' => $settings->timezone]);
        }
        
        // Guardar en sesión para acceso rápido
        Session::put('user_settings', $settings->toArray());
    }
}