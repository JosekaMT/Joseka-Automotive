<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\NotificationController;

// Ruta principal de la aplicación

Route::get('/', function () { //Vista vehicles
    return view('welcome');
})->name('vehicles');

Route::get('/', [HomeController::class, 'showCars'])->name('home');


// Rutas de autenticación
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Rutas de registro
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Rutas de restablecimiento de contraseña
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');

// Rutas de verificación de correo electrónico
Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->name('verification.verify')->middleware(['signed', 'throttle:6,1']);
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Rutas de confirmación de contraseña
Route::get('/confirm-password', function () {
    return view('auth.confirm-password');
})->name('password.confirm');
Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);

// Rutas protegidas para usuarios autenticados y verificados
Route::middleware(['auth', 'verified'])->group(function () {
});

// Rutas protegidas para invitados (no autenticados)
Route::middleware(['guest'])->group(function () {
});

Auth::routes();


Route::get('/vehicles', function () { //Vista vehicles
    return view('vehicles');
})->name('vehicles');

Route::get('/vehicles',  [CarController::class, 'showCars']); //Vista vehicles(mostrar lista de coches)

Route::get('/rent-vehicles', function () { //Vista rentar vehicles
    return view('rent-vehicles');
})->name('rent-vehicles');


Route::get('/rent-vehicles/{id}', [CarController::class, 'rentVehicle'])->name('rent-vehicles.show'); //Vista rentar vehicles
Route::get('/vehicles', [CarController::class, 'showCars'])->name('vehicles.index'); //Redireccion bloquear otros coches noa available
Route::post('/car/{carId}/rent', [CarController::class, 'rent'])->name('car.rent');




Route::post('/rent/{id}', [RentController::class, 'rent'])->name('rent');
Route::post('/rent-car/{carId}', [CarController::class, 'rent'])->name('car.rent');


Route::get('/admin/notifications', 'AdminController@showNotifications')->name('admin.notifications');
Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead']);



Route::get('/profile', function () { //Vista profile
    return view('profile');
})->name('profile');













//ADMIN PANEL
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/vehicle', [AdminController::class, 'vehicle'])->name('admin.vehicle');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');


    Route::get('/admin/notifications', [AdminController::class, 'showNotifications'])->name('admin.notifications');
    Route::post('/admin/rentals/{id}/approve', [AdminController::class, 'approveRental'])->name('admin.rentals.approve');
    Route::post('/admin/rentals/{id}/reject', [AdminController::class, 'rejectRental'])->name('admin.rentals.reject');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
    Route::post('/rent-car/{carId}', [RentController::class, 'rent'])->name('car.rent');


    Route::get('/admin/billing', [AdminController::class, 'billing'])->name('admin.billing');
});

Route::middleware(['auth'])->group(function () {  //Meter todas las vistas admin aqui para restrigir el acceso al resto de usuarios
    Route::resource('admin', CarController::class); // Route dashboard coches
    Route::resource('cars', CarController::class); // Route vehicles coches
    Route::delete('/cars/{id}', [CarController::class, 'destroy'])->name('cars.destroy');

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/vehicle', [AdminController::class, 'vehicle'])->name('admin.vehicle');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');


    Route::get('/admin/notifications', [AdminController::class, 'showNotifications'])->name('admin.notifications');
    Route::post('/admin/rentals/{id}/approve', [AdminController::class, 'approveRental'])->name('admin.rentals.approve');
    Route::post('/admin/rentals/{id}/reject', [AdminController::class, 'rejectRental'])->name('admin.rentals.reject');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
    Route::post('/rent-car/{carId}', [RentController::class, 'rent'])->name('car.rent');



    Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');
    Route::get('/billing/download/{rental}', [BillingController::class, 'downloadInvoice'])->name('billing.downloadInvoice');

    Route::get('/admin/billing', [BillingController::class, 'adminIndex'])->name('admin.billing');
    Route::get('/admin/billing/download/{rental}', [BillingController::class, 'downloadAdminInvoice'])->name('admin.billing.downloadInvoice');

    Route::post('/admin/approve-rental/{id}', [RentController::class, 'approveRental'])->name('admin.approveRental');
    Route::post('/admin/reject-rental/{id}', [RentController::class, 'rejectRental'])->name('admin.rejectRental');

    Route::resource('users', UserAdminController::class)->except(['create', 'show', 'edit']);

    Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');
    Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');
});
