<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;
use App\Models\Rental;
use App\Notifications\RentalApproved;
use App\Notifications\RentalRejected;


class AdminController extends Controller
{
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

    public function billing()
    {
        return view('admin.billing');
    }

    public function showNotifications()
    {
        $user = Auth::user();

        // Recupera todas las notificaciones, puedes ajustar para traer solo las no leídas
        $notifications = $user->notifications;

        return view('admin.notifications', compact('notifications'));
    }

    public function markNotificationAsRead($notificationId)
    {
        $user = Auth::user();
        $notification = DatabaseNotification::find($notificationId);
        if ($notification && $notification->notifiable_id === $user->id) {
            $notification->markAsRead();
        }

        return back();
    }

    public function approveRental($id)
    {
        $rental = Rental::findOrFail($id);
        $rental->status = 'approved';
        $rental->save();

        // Enviar notificación de aprobación al usuario
        $user = $rental->user;
        $adminName = Auth::user()->name ?? 'Administration';
        $user->notify(new RentalApproved($rental, $adminName));

        return redirect()->back()->with('success', 'Rental approved successfully.');
    }

    public function rejectRental($id)
    {
        $rental = Rental::findOrFail($id);
        $rental->status = 'rejected';
        $rental->save();

        // Enviar notificación de rechazo al usuario
        $user = $rental->user;
        $adminName = Auth::user()->name ?? 'Administration';
        $user->notify(new RentalRejected($rental, $adminName));

        return redirect()->back()->with('success', 'Rental rejected successfully.');
    }
}
