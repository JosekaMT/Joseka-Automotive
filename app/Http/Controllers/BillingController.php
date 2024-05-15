<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rental;
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
        $pdf = PDF::loadView('layouts.invoice.invoice', compact('rental'));
        return $pdf->download('invoice.pdf');
    }
}
