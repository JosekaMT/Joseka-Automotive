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
        $user = Auth::user();
        $rentals = Rental::where('user_id', $user->id)->get();
        return view('billing', compact('user', 'rentals'));
    }
    public function downloadInvoice($rentalId)
{
    $rental = Rental::findOrFail($rentalId);
    $user = Auth::user();

    $pdf = PDF::loadView('layouts.invoice.invoice', compact('rental', 'user'));
    return $pdf->download('invoice_' . $rentalId . '.pdf');
}
}
