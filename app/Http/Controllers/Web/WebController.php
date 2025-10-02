<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cursos\Cursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Alumnos\Alumno;
use App\Models\Carrito\ShoppingCartItem;
use App\Models\Company\CompanyDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Modules\Moodle\Services\MoodleEnrollmentService;
use App\Modules\Moodle\Services\MoodleUserService;
use App\Services\CoursesSyncService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WebController extends Controller
{

    public function courses(Request $request)
    {
        try {
            // Comentamos temporalmente la sincronización automática para mejorar el rendimiento
            // $coursesSyncService = app(CoursesSyncService::class);
            
            // // Sincronizar cursos de Moodle (con caché para evitar llamadas frecuentes)
            // $lastSync = cache('courses_last_sync');
            // if (!$lastSync || now()->diffInMinutes($lastSync) > 30) {
            //     $coursesSyncService->syncAllCourses();
            //     cache(['courses_last_sync' => now()], 30 * 60); // Cache por 30 minutos
            // }

            $offset = $request->input('offset', 0);
            $categoryId = $request->input('category_id');
            $search = $request->input('search');

            $query = Cursos::where('inactive', 0)
                ->where('published', 1)
                ->whereNotNull('moodle_id')
                ->with('category')
                ->select('id', 'name', 'description', 'price', 'image', 'category_id', 'moodle_id', 'duracion', 'plazas', 'lecciones', 'certificado', 'created_at');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->ajax()) {
            $cursos = $query->skip($offset)->take(3)->get();

            return response()->json([
                'html' => view('webacademia.partials.course_card', compact('cursos'))->render(),
                'count' => $cursos->count(),
            ]);
        }

            $initialCursos = $query->take(9)->orderBy('created_at', 'desc')->get();
            $categorias = \App\Models\Cursos\Category::where('inactive', 0)->get();
            
            // Verificar si el usuario está logueado
            $isLoggedIn = Auth::guard('alumno')->check();
            $user = $isLoggedIn ? Auth::guard('alumno')->user() : null;

            return view('webacademia.course', compact('initialCursos', 'categorias', 'isLoggedIn', 'user'));
            
        } catch (\Exception $e) {
            Log::error('Error loading courses page: ' . $e->getMessage());
            
            // En caso de error, mostrar cursos básicos sin sincronización
            $initialCursos = Cursos::where('inactive', 0)
                ->where('published', 1)
                ->whereNotNull('moodle_id')
                ->with('category')
                ->take(9)
                ->orderBy('created_at', 'desc')
                ->get();
            $categorias = \App\Models\Cursos\Category::where('inactive', 0)->get();
            
            $isLoggedIn = Auth::guard('alumno')->check();
            $user = $isLoggedIn ? Auth::guard('alumno')->user() : null;

            return view('webacademia.course', compact('initialCursos', 'categorias', 'isLoggedIn', 'user'))
                ->with('error', 'Algunos cursos pueden no estar actualizados. Intenta recargar la página.');
        }
    }

    public function singleCourse($id)
    {
        $coursesSyncService = app(CoursesSyncService::class);
        
        $curso = $coursesSyncService->getCourseDetails($id);
        
        if (!$curso) {
            abort(404, 'Curso no encontrado');
        }

        // Verificar si el usuario está logueado
        $isLoggedIn = Auth::guard('alumno')->check();
        $user = $isLoggedIn ? Auth::guard('alumno')->user() : null;
        
        // Verificar si el usuario ya tiene este curso
        $userHasCourse = false;
        $isInCart = false;
        
        if ($isLoggedIn) {
            // Verificar si ya compró el curso
            $userHasCourse = DB::table('alumnos_cursos')
                ->where('alumno_id', $user->id)
                ->where('curso_id', $curso->id)
                ->where('estado', 'activo')
                ->exists();
                
            // Verificar si está en el carrito
            $isInCart = ShoppingCartItem::where('alumno_id', $user->id)
                ->where('curso_id', $curso->id)
                ->exists();
        }

        // Obtener cursos relacionados
        $cursosRelacionados = Cursos::where('inactive', 0)
            ->where('published', 1)
            ->whereNotNull('moodle_id')
            ->where('category_id', $curso->category_id)
            ->where('id', '!=', $curso->id)
            ->limit(3)
            ->get();

        return view('webacademia.single_course', compact(
            'curso', 
            'isLoggedIn', 
            'user', 
            'userHasCourse', 
            'isInCart', 
            'cursosRelacionados'
        ));
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string|min:3|max:50|unique:alumnos|regex:/^[a-zA-Z0-9_]+$/',
                'name' => 'required|string|min:2|max:100|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
                'surname' => 'required|string|min:2|max:100|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
                'email' => 'required|email|max:255|unique:alumnos',
                'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).*$/',
                'password_confirmation' => 'required|string|min:8',
            ],[
                'name.required' => 'El nombre es obligatorio',
                'name.min' => 'El nombre debe tener al menos 2 caracteres',
                'name.max' => 'El nombre no puede tener más de 100 caracteres',
                'name.regex' => 'El nombre solo puede contener letras y espacios',
                
                'surname.required' => 'Los apellidos son obligatorios',
                'surname.min' => 'Los apellidos deben tener al menos 2 caracteres',
                'surname.max' => 'Los apellidos no pueden tener más de 100 caracteres',
                'surname.regex' => 'Los apellidos solo pueden contener letras y espacios',
                
                'username.required' => 'El nombre de usuario es obligatorio',
                'username.min' => 'El nombre de usuario debe tener al menos 3 caracteres',
                'username.max' => 'El nombre de usuario no puede tener más de 50 caracteres',
                'username.unique' => 'Este nombre de usuario ya está en uso',
                'username.regex' => 'El nombre de usuario solo puede contener letras, números y guiones bajos',
                
                'email.required' => 'El email es obligatorio',
                'email.email' => 'El email debe tener un formato válido',
                'email.max' => 'El email no puede tener más de 255 caracteres',
                'email.unique' => 'Este email ya está registrado',
                
                'password.required' => 'La contraseña es obligatoria',
                'password.min' => 'La contraseña debe tener al menos 8 caracteres',
                'password.confirmed' => 'Las contraseñas no coinciden',
                'password.regex' => 'La contraseña debe contener al menos una mayúscula, una minúscula y un número',
                
                'password_confirmation.required' => 'Debes confirmar tu contraseña',
                'password_confirmation.min' => 'La confirmación debe tener al menos 8 caracteres',
            ]);

            // Limpiar y preparar los datos
            $userData = [
                'username' => trim(strtolower($request->username)),
                'name' => trim(ucwords(strtolower($request->name))),
                'surname' => trim(ucwords(strtolower($request->surname))),
                'email' => trim(strtolower($request->email)),
                'password' => Hash::make($request->password),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $alumno = Alumno::create($userData);

            // Log del registro exitoso
            Log::info("Nuevo alumno registrado", [
                'id' => $alumno->id,
                'username' => $alumno->username,
                'email' => $alumno->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            Auth::guard('alumno')->login($alumno);

            return redirect()->route('webacademia.perfil')->with('success', '¡Bienvenido! Tu cuenta ha sido creada exitosamente.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput($request->except('password', 'password_confirmation'))
                ->with('error', 'Por favor, corrige los errores en el formulario.');
        } catch (\Exception $e) {
            Log::error("Error en registro de alumno: " . $e->getMessage(), [
                'email' => $request->email ?? 'N/A',
                'username' => $request->username ?? 'N/A',
                'ip' => $request->ip(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with('error', 'Hubo un error al crear tu cuenta. Por favor, inténtalo de nuevo.');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('alumno')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('webacademia.perfil'));
        }

        throw ValidationException::withMessages([
            'email' => ['Las credenciales proporcionadas no son válidas.'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('alumno')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showSlug($slug)
    {
        $view = 'webacademia.pages.' . $slug;

        if (!view()->exists($view)) {
            abort(404);
        }

        return view('webacademia.layouts.web_layout_slug', [
            'contentView' => $view,
        ]);
    }


    public function agregarAlCarrito($id)
    {
        $curso = Cursos::findOrFail($id);
        $user = Auth::guard('alumno')->user();

        $item = ShoppingCartItem::firstOrNew([
            'alumno_id' => $user->id,
            'curso_id' => $curso->id,
        ]);

        $item->cantidad += 1;
        $item->save();

        return redirect()->back()->with('success', 'Curso añadido al carrito.');
    }

    public function eliminarDelCarrito($id)
    {
        $user = Auth::guard('alumno')->user();
        ShoppingCartItem::where('alumno_id', $user->id)->where('curso_id', $id)->delete();

        return redirect()->back()->with('success', 'Curso eliminado del carrito.');
    }

    public function actualizarCantidad(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1|max:10'
        ]);

        $user = Auth::guard('alumno')->user();
        $item = ShoppingCartItem::where('alumno_id', $user->id)->where('curso_id', $id)->first();

        if ($item) {
            $item->cantidad = $request->cantidad;
            $item->save();
            return redirect()->back()->with('success', 'Cantidad actualizada correctamente.');
        }

        return redirect()->back()->with('error', 'Curso no encontrado en el carrito.');
    }

   public function vaciarCarrito()
    {
        $user = Auth::guard('alumno')->user();
        ShoppingCartItem::where('alumno_id', $user->id)->delete();

        return redirect()->back()->with('success', 'Carrito vaciado.');
    }

    public function verCarrito()
    {
        $user = Auth::guard('alumno')->user();
        $carrito = ShoppingCartItem::with('curso')->where('alumno_id', $user->id)->get();

        return view('webacademia.carrito', compact('carrito'));
    }


    public function checkout(Request $request)
    {
        $user = Auth::guard('alumno')->user();
        
        // Obtener los cursos del carrito
        $carrito = ShoppingCartItem::with('curso')->where('alumno_id', $user->id)->get();
        
        if ($carrito->isEmpty()) {
            return redirect()->route('carrito.ver')->with('error', 'Tu carrito está vacío.');
        }

        $configuracion = CompanyDetails::first();
        return view('webacademia.checkout_carrito', compact('carrito', 'configuracion'));
    }

    public function procesarPago(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email',
            'telefono' => 'required|string',
            'metodo_pago' => 'required|in:stripe,paypal,transferencia',
            'acepto_terminos' => 'required|accepted',
        ]);

        $user = Auth::guard('alumno')->user();
        
        try {
            // Obtener los cursos del carrito
            $carrito = ShoppingCartItem::with('curso')->where('alumno_id', $user->id)->get();
            
            if ($carrito->isEmpty()) {
                return redirect()->route('carrito.ver')->with('error', 'Tu carrito está vacío.');
            }

            // Calcular totales
            $subtotal = $carrito->sum(function($item) {
                return $item->curso->price * $item->cantidad;
            });
            $iva = $subtotal * 0.21;
            $total = $subtotal + $iva;

            // Procesar pago según el método seleccionado
            $pagoExitoso = $this->procesarMetodoPago($request->metodo_pago, $total, $request->all());

            if (!$pagoExitoso) {
                return redirect()->back()->with('error', 'Error al procesar el pago. Por favor, inténtalo de nuevo.');
            }

            // Si el pago es exitoso, procesar matriculación
            $enrollmentService = app(MoodleEnrollmentService::class);
            $userService = app(MoodleUserService::class);
            
            // Crear o sincronizar usuario en Moodle
            $moodleUserId = $userService->createOrUpdateUser([
                'username' => $user->username,
                'firstname' => $user->name,
                'lastname' => $user->surname,
                'email' => $user->email,
            ]);

            $enrolledCourses = [];
            $failedEnrollments = [];

            foreach ($carrito as $item) {
                try {
                    // Matricular en el curso de Moodle
                    if ($item->curso->moodle_course_id) {
                        $enrollmentService->enrollUser(
                            $moodleUserId,
                            $item->curso->moodle_course_id,
                            5 // Rol de estudiante
                        );
                        $enrolledCourses[] = $item->curso->title;
                    }

                    // Registrar la compra en la base de datos
                    DB::table('alumnos_cursos')->insert([
                        'alumno_id' => $user->id,
                        'curso_id' => $item->curso->id,
                        'fecha_compra' => now(),
                        'estado' => 'activo',
                        'precio_pagado' => $item->curso->price * $item->cantidad,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                } catch (\Exception $e) {
                    Log::error("Error al matricular usuario {$user->id} en curso {$item->curso->id}: " . $e->getMessage());
                    $failedEnrollments[] = $item->curso->title;
                }
            }

            // Limpiar carrito después del pago exitoso
            ShoppingCartItem::where('alumno_id', $user->id)->delete();

            $message = 'Compra completada exitosamente.';
            if (!empty($enrolledCourses)) {
                $message .= ' Te has matriculado en: ' . implode(', ', $enrolledCourses);
            }
            if (!empty($failedEnrollments)) {
                $message .= ' Hubo problemas con la matriculación en: ' . implode(', ', $failedEnrollments);
            }

            return redirect()->route('webacademia.perfil')->with('success', $message);

        } catch (\Exception $e) {
            Log::error("Error en procesarPago: " . $e->getMessage());
            return redirect()->back()->with('error', 'Hubo un error al procesar tu compra. Por favor, inténtalo de nuevo.');
        }
    }

    private function procesarMetodoPago($metodo, $total, $datosFacturacion)
    {
        switch ($metodo) {
            case 'stripe':
                return $this->procesarPagoStripe($total, $datosFacturacion);
            case 'paypal':
                return $this->procesarPagoPaypal($total, $datosFacturacion);
            case 'transferencia':
                return $this->procesarPagoTransferencia($total, $datosFacturacion);
            default:
                return false;
        }
    }

    private function procesarPagoStripe($total, $datos)
    {
        // Por ahora simulamos un pago exitoso
        // Aquí integrarías con Stripe API
        Log::info("Pago Stripe simulado por {$total}€", $datos);
        return true;
    }

    private function procesarPagoPaypal($total, $datos)
    {
        // Por ahora simulamos un pago exitoso
        // Aquí integrarías con PayPal API
        Log::info("Pago PayPal simulado por {$total}€", $datos);
        return true;
    }

    private function procesarPagoTransferencia($total, $datos)
    {
        // Para transferencia, siempre es exitoso (pago pendiente)
        Log::info("Pago por transferencia registrado por {$total}€", $datos);
        return true;
    }

    public function updatePerfil(Request $request)
    {
        try {
            $alumno = auth('alumno')->user();
            
            // Validar los datos
            $request->validate([
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'email' => 'required|email|unique:alumnos,email,' . $alumno->id,
                'phone' => 'nullable|string|max:20',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Actualizar datos básicos
            $alumno->name = $request->name;
            $alumno->surname = $request->surname;
            $alumno->email = $request->email;
            $alumno->phone = $request->phone;

            // Manejar la subida del avatar
            if ($request->hasFile('avatar')) {
                // Eliminar avatar anterior si existe
                if ($alumno->avatar && Storage::disk('public')->exists($alumno->avatar)) {
                    Storage::disk('public')->delete($alumno->avatar);
                }

                // Subir nuevo avatar
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $alumno->avatar = $avatarPath;
            }

            $alumno->save();

            return redirect()->route('webacademia.perfil')->with('success', '¡Perfil actualizado correctamente!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Por favor, corrige los errores en el formulario.');
        } catch (\Exception $e) {
            Log::error("Error actualizando perfil: " . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Hubo un error al actualizar tu perfil. Por favor, inténtalo de nuevo.');
        }
    }

}
