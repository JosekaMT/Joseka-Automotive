<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rental;
use App\Models\User; // Asegúrate de importar el modelo User
use PDF;

class BillingController extends Controller
{
    public function index()
    {
        $rentals = Rental::where('user_id', Auth::id())
            ->where('status', 'approved')
            ->with('car', 'user')
            ->get();

        return view('billing', compact('rentals'));
    }

    public function downloadInvoice(Rental $rental)
    {
        $admin = Auth::user(); // Suponemos que el administrador está autenticado
        $pdf = PDF::loadView('layouts.invoice.invoice', compact('rental', 'admin'));
        return $pdf->download('invoice.pdf');
    }

    public function adminIndex()
    {
        // Obtener todas las facturas aprobadas de todos los usuarios
        $rentals = Rental::where('status', 'approved')
            ->with('car', 'user')
            ->get();

        return view('admin.billing', compact('rentals'));
    }

    public function downloadAdminInvoice(Rental $rental)
    {
        $admin = Auth::user(); // Suponemos que el administrador está autenticado
        $pdf = PDF::loadView('layouts.invoice.invoice', compact('rental', 'admin'));
        return $pdf->download('invoice.pdf');
    }
}
