<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{


    public function index()
    {
        // Contar todos los usuarios excepto los administradores
        $totalUsers = User::where('role', '!=', 'admin')->count();
        
        // Pasar el total de usuarios a la vista
        return view('car.index', compact('totalUsers'));
    }
    

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function vehicle()
    {
        return view('admin.vehicle');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function notifications()
    {
        return view('admin.notifications');
    }

    public function vehicle2()
    {
        return view('admin.vehicle2');
    }
}
