<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cursos\Cursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Alumnos\Alumno;
use App\Models\Carrito\ShoppingCartItem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class WebController extends Controller
{

    public function courses(Request $request)
    {
        $offset = $request->input('offset', 0);
        $categoryId = $request->input('category_id');

        $query = Cursos::where('inactive', 0)->with('category');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($request->ajax()) {
            $cursos = $query->skip($offset)->take(3)->get();

            return response()->json([
                'html' => view('webacademia.partials.course_card', compact('cursos'))->render(),
                'count' => $cursos->count(),
            ]);
        }

        $initialCursos = $query->take(9)->get();
        $categorias = \App\Models\Cursos\Category::all();

        return view('webacademia.course', compact('initialCursos', 'categorias'));
    }

    public function singleCourse($id)
    {
        $curso = Cursos::find($id);
        return view('webacademia.single_course',compact('curso'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:alumnos',
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:alumnos',
            'password' => 'required|min:6',
        ],[
            'name.required' => 'El nombre es requerido para continuar',
            'surname.required' => 'Los apellidos son requeridos para continuar',
            'username.required' => 'El nombre de usuario es requerido para continuar',
            'username.unique' => 'El nombre de usuario ya existe',
            'email.required' => 'El email es requerido para continuar',
            'email.email' => 'El email debe ser un email valido',
            'email.unique' => 'El email ya existe',
            'password.required' => 'El password es requerido para continuar',
            'password.min' => 'El password debe contener al menos 6 caracteres para continuar',
        ]);

        $alumno = Alumno::create([
            'username' => $request->username,
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('alumno')->login($alumno);

        return redirect()->route('webacademia.perfil');
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

        // Aquí puedes crear pedidos o procesar pagos
        ShoppingCartItem::where('alumno_id', $user->id)->delete();

        return redirect()->route('webacademia.courses')->with('success', 'Compra completada.');
    }


}
