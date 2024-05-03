<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

    public function update(Request $request, $id)
    {
        // Método para actualizar los datos de un usuario en la base de datos
    }

    public function destroy($id)
    {
        // Método para eliminar un usuario de la base de datos
    }
}
