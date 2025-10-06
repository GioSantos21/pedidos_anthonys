<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\SucursalesController;

Route::get('/', function () {
    return view('modulos.users.Ingresar');
});

Route::get('/Inicio', function () {
    return view('modulos.Inicio');
});

//Route::get('Primer-Usuario',[UsuariosController::class, 'PrimerUsusario']);

Auth::routes();

Route::get('Sucursales', [SucursalesController::class, 'index']);
Route::post('Sucursales',[SucursalesController::class, 'store']);
Route::get('Editar-Sucursal/{cod_sucursal}',[SucursalesController::class, 'edit']);
Route::put('Actualizar-Sucursal', [SucursalesController::class, 'update']);
Route::get('Cambiar-Estado-Sucursal/{status}/{cod_sucursal}',[SucursalesController::class, 'CambiarEstado']);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
