<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;
use App\Models\Rental;
use App\Notifications\RentalRequestStatusChanged;

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

    public function vehicle2()
    {
        return view('admin.vehicle2');
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
        $rental = Rental::find($id);
        if ($rental) {
            $rental->status = 'approved';
            $rental->save();

            $user = $rental->user;
            if ($user) {  // Verificar si el usuario no es null
                Notification::send($user, new RentalRequestStatusChanged($rental, 'approved', 'Your rental request has been approved.'));
            }

            return redirect()->route('admin.notifications')->with('success', 'Rental request approved.');
        }
        return redirect()->route('admin.notifications')->with('error', 'Rental request not found.');
    }

    public function rejectRental($id)
    {
        $rental = Rental::find($id);
        if ($rental) {
            $rental->status = 'rejected';
            $rental->save();

            $user = $rental->user;
            if ($user) {  // Verificar si el usuario no es null
                Notification::send($user, new RentalRequestStatusChanged($rental, 'rejected', 'Your rental request has been rejected.'));
            }

            return redirect()->route('admin.notifications')->with('success', 'Rental request rejected.');
        }
        return redirect()->route('admin.notifications')->with('error', 'Rental request not found.');
    }
}
