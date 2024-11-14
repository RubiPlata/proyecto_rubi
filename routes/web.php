<?php

use App\Http\Middleware\isAuthenticated;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\UsuarioController;
use App\Http\Controllers\ProductController;

// Ruta para la página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes();

// Rutas protegidas con autenticación
Route::middleware([isAuthenticated::class])->group(function () {
    // Dashboard accesible solo para usuarios autenticados
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    // Rutas de usuarios
    Route::resource('usuarios', UsuarioController::class);

    // Rutas de productos
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});

// Ruta de inicio
Route::get('/home', [HomeController::class, 'index'])->name('home');
