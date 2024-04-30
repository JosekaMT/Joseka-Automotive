<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login based on their role.
     *
     * @var string
     */
    protected function redirectTo()
    {
        // Check if the authenticated user is an admin
        if (auth()->check() && auth()->user()->is_admin) {
            return '/admin';  // Redirige a los administradores al dashboard de administración
        }

        return '/';  // Redirige a los usuarios no administradores a la página de bienvenida
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
