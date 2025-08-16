<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\GastosOperativoController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TallaController;
use App\Http\Controllers\VariantesProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('panel.panel');
})->name('panel');

Route::resource('categorias', CategoriaController::class);
Route::resource('productos', ProductoController::class);
Route::resource('tallas', TallaController::class);
Route::resource('variantes-productos', VariantesProductoController::class);
Route::resource('permisos', PermisoController::class);
Route::resource('empleados', EmpleadoController::class);
Route::resource('logs', LogController::class);
Route::get('/producto-datos/{id_producto}', [VariantesProductoController::class, 'getDatosProducto']);
Route::resource('gastos-operativos', GastosOperativoController::class);
