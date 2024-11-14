<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Asegúrate de tener la vista 'auth/login.blade.php'
    }

    /**
     * Procesa la solicitud de inicio de sesión.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirigir al usuario después del inicio de sesión exitoso
            return redirect()->intended('/dashboard'); // Cambia '/dashboard' por la ruta deseada
        }

        // En caso de fallo, lanzar una excepción de validación
        throw ValidationException::withMessages([
            'email' => __('auth.failed'), // Mensaje de error de autenticación
        ]);
    }

    /**
     * Cierra la sesión del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salir(Request $request)
    {
        Auth::salir();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Redirige al usuario a la página de inicio después de cerrar sesión
    }
}

{
    return view('auth.login');

}

