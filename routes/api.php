<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CompraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(TrabajadorController::class)->group(function(){
    Route::get('/trabajadores', 'index');
    Route::get('/trabajador/{id}', 'show');
    Route::post('/crear-trabajador', 'store');
    Route::put('/editar-trabajador/{id}', 'update');
    Route::put('/eliminar-trabajador/{id}', 'destroy');
});

Route::controller(ClienteController::class)->group(function(){
    Route::get('/clientes', 'index');
    Route::get('/cliente/{id}', 'show');
    Route::post('/crear-cliente', 'store');
    Route::put('/editar-cliente/{id}', 'update');
    Route::put('/eliminar-cliente/{id}', 'destroy');
});

Route::controller(ProductoController::class)->group(function(){
    Route::get('/productos', 'index');
    Route::get('/producto/{id}', 'show');
    Route::post('/crear-producto', 'store');
    Route::put('/editar-producto/{id}', 'update');
    Route::put('/eliminar-producto/{id}', 'destroy');
});

Route::controller(VentaController::class)->group(function(){
    Route::get('/ventas', 'index');
    Route::get('/venta/{id}', 'show');
    Route::post('/crear-venta', 'store');
    Route::put('/editar-venta/{id}', 'update');
    Route::put('/eliminar-venta/{id}', 'destroy');
});

Route::controller(CompraController::class)->group(function(){
    Route::get('/compras', 'index');
    Route::get('/compra/{id}', 'show');
    Route::put('/editar-compra/{id}', 'update');
    Route::put('/eliminar-compra/{id}', 'destroy');
});