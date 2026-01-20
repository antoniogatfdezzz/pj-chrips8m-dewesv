<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\MemeController;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Ruta pública
Route::get('/', [MemeController::class, 'index']);

// Rutas de autenticación (guest)
Route::view('/register', 'auth.register')
	->middleware('guest')
	->name('register');

Route::post('/register', Register::class)
	->middleware('guest');

Route::view('/login', 'auth.login')
	->middleware('guest')
	->name('login');

Route::post('/login', Login::class)
	->middleware('guest');

Route::post('/logout', function (Request $request) {
	Auth::logout();
	$request->session()->invalidate();
	$request->session()->regenerateToken();

	return redirect('/')->with('success', 'Has cerrado sesión correctamente.');
})->middleware('auth')->name('logout');

// Ruta pública para publicar memes (usuarios registrados o anónimos)
Route::post('/memes', [MemeController::class, 'store']);

// Rutas de memes protegidas (editar / eliminar solo con sesión)
Route::middleware('auth')->group(function () {
	Route::get('/memes/{meme}/edit', [MemeController::class, 'edit']);
	Route::put('/memes/{meme}', [MemeController::class, 'update']);
	Route::delete('/memes/{meme}', [MemeController::class, 'destroy']);
});

// Chirps routes (still available)
Route::get('/chirps', [ChirpController::class, 'index']);
Route::post('/chirps/store', [ChirpController::class, 'store']);

