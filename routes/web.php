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

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarController;


// Ruta principal de la aplicación

Route::get('/', function () { //Vista vehicles
    return view('welcome');
})->name('vehicles');


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


Route::get('/vehicles',  [CarController::class, 'showCars']);

Route::get('/about', function () { //Vista about
    return view('about');
})->name('about');

Route::get('/contact', function () { //Vista contact
    return view('contact');
})->name('contact');

Route::get('/profile', function () { //Vista profile
    return view('profile');
})->name('profile');
















//ADMIN PANEL
Route::get('/admin', function () {
    if (auth()->user() && auth()->user()->is_admin) {
        return view('admin.dashboard');
    }
    abort(403, 'Unauthorized access.');
})->middleware(['auth']);


Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/vehicle', [AdminController::class, 'vehicle'])->name('admin.vehicle');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/admin/notifications', [AdminController::class, 'notifications'])->name('admin.notifications');
    Route::get('/admin/vehicle2', [AdminController::class, 'vehicle2'])->name('admin.vehicle2');
});

Route::resource('admin', CarController::class); //Routa dashboard coches
Route::resource('cars', CarController::class); //Routa vehicles coches
Route::delete('/cars/{id}', [CarController::class, 'destroy'])->name('cars.destroy');
//ADMIN PANEL