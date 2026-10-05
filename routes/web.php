<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PedidoController;
use App\Http\Middleware\EnsureUsuarioAutenticado;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.entrar');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(EnsureUsuarioAutenticado::class)->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('materiais', MaterialController::class);
    Route::resource('emprestimos', EmprestimoController::class);
    Route::resource('pedidos', PedidoController::class);
});
