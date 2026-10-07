<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/usuario_cadastro', [App\Http\Controllers\UsuarioController::class, 'salvar_usuario'])->name('usuario_cadastro');


Route::get('/ver_usuario', [App\Http\Controllers\UsuarioController::class, 'ver_usuario'])->name('ver_usuario');
Route::get('/listar_usuarios', [App\Http\Controllers\UsuarioController::class, 'listar_usuarios'])->name('listar_usuarios');
Route::get('/listar_usuarios_simples', [App\Http\Controllers\UsuarioController::class, 'listar_usuarios_simples'])->name('listar_usuarios_simples');

Route::put('/alterar_usuario', [App\Http\Controllers\UsuarioController::class, 'alterar_usuario'])->name('alterar_usuario');
Route::delete('/deletar_usuario', [App\Http\Controllers\UsuarioController::class, 'deletar_usuario'])->name('deletar_usuario');