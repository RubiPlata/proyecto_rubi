<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Mostrar todos los usuarios
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    // Mostrar el formulario para crear un nuevo usuario
    public function create()
    {
        return view('usuarios.create');
    }

    // Almacenar un nuevo usuario
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crear el nuevo usuario
        $user = new User;
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito');
    }

    // Mostrar los detalles de un usuario
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    // Mostrar el formulario para editar un usuario
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Actualizar los detalles de un usuario
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Actualizar el usuario
        $usuario->name = $validated['name'];
        $usuario->email = $validated['email'];

        if ($request->filled('password')) {
            $usuario->password = Hash::make($validated['password']);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito');
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado con éxito');



        {
            $usuarios = User::all();
            return view('usuarios.index', compact('usuarios'));
        }

    }
}

