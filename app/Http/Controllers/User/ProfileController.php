<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user profile page.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('login');
            }
            return view('crm.user.profile', compact('user'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the user profile.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('crm.user.profile-edit', compact('user'));
    }

    /**
     * Update the user profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ], [
            'name.required' => 'El nombre es requerido',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email debe tener un formato válido',
            'email.unique' => 'Este email ya está en uso',
            'phone.max' => 'El teléfono no puede tener más de 20 caracteres',
            'avatar.image' => 'El archivo debe ser una imagen',
            'avatar.mimes' => 'La imagen debe ser jpeg, png, jpg o gif',
            'avatar.max' => 'La imagen no puede ser mayor a 2MB',
            'new_password.min' => 'La nueva contraseña debe tener al menos 8 caracteres',
            'new_password.confirmed' => 'La confirmación de contraseña no coincide',
        ]);

        // Verificar contraseña actual si se proporciona
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta']);
            }
        }

        // Actualizar datos básicos
        $user->name = $request->name;
        $user->email = $request->email;
        
        // Solo actualizar phone si el campo existe
        if (isset($user->phone)) {
            $user->phone = $request->phone;
        }

        // Manejar avatar solo si el campo existe
        if ($request->hasFile('avatar') && isset($user->avatar)) {
            // Eliminar avatar anterior si existe
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // Actualizar contraseña si se proporciona
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Perfil actualizado exitosamente.');
    }

    /**
     * Display the settings page.
     */
    public function settings()
    {
        $user = Auth::user();
        return view('crm.user.settings', compact('user'));
    }

    /**
     * Update user settings.
     */
    public function updateSettings(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'language' => 'required|in:es,en',
            'timezone' => 'required|string',
            'notifications_email' => 'boolean',
            'notifications_system' => 'boolean',
            'theme' => 'required|in:light,dark',
        ], [
            'language.required' => 'El idioma es requerido',
            'language.in' => 'El idioma seleccionado no es válido',
            'timezone.required' => 'La zona horaria es requerida',
            'theme.required' => 'El tema es requerido',
            'theme.in' => 'El tema seleccionado no es válido',
        ]);

        // Actualizar configuraciones solo si los campos existen
        if (isset($user->language)) {
            $user->language = $request->language;
        }
        if (isset($user->timezone)) {
            $user->timezone = $request->timezone;
        }
        if (isset($user->notifications_email)) {
            $user->notifications_email = $request->boolean('notifications_email');
        }
        if (isset($user->notifications_system)) {
            $user->notifications_system = $request->boolean('notifications_system');
        }
        if (isset($user->theme)) {
            $user->theme = $request->theme;
        }

        $user->save();

        return redirect()->route('user.settings')->with('success', 'Configuración actualizada exitosamente.');
    }
}
