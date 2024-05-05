<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function create()
    {
        // Método para mostrar el formulario de creación de usuario
    }

    public function store(Request $request)
    {
        // Método para almacenar un nuevo usuario en la base de datos
    }

    public function show($id)
    {
        // Método para mostrar los detalles de un usuario específico
    }

    public function edit($id)
    {
        // Método para mostrar el formulario de edición de un usuario
    }







    public function update(Request $request)
    {
        $user = Auth::user();
    
        // Validación de todos los campos requeridos
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image',
            'password' => 'nullable|string|min:6|confirmed',
        ]);
    
        // Actualización de los campos básicos
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone_number = $validatedData['phone_number'];
        $user->city = $validatedData['city'];
    
        // Manejo de la carga de la foto de perfil
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $path;
        }
    
        // Actualizar la contraseña si se proporciona una nueva
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password); // Uso de Hash::make para asegurar la contraseña
        }
    
        // Guardar los cambios y manejar posibles errores
        if (!$user->save()) {
            Log::error('Failed to update user', ['user_id' => $user->id]);
            return redirect()->back()->with('error', 'Failed to update profile.');
        }
    
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
    
    






    public function destroy($id)
    {
        // Método para eliminar un usuario de la base de datos
    }
}
