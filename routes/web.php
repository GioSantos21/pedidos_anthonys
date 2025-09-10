<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

Route::get('/', function () {
    return view('modulos.users.Ingresar');
});

Route::get('/Inicio', function () {
    return view('modulos.Inicio');
});

Route::get('Primer-Usuario',[UsuariosController::class, 'PrimerUsusario']);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
