<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DetalleCompraController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\GastosOperativoController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TallaController;
use App\Http\Controllers\VariantesProductoController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login.login');
})->name('panel');

Route::get('/inicio', function () {
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

Route::resource('ventas', VentaController::class);
Route::get('/detalleVenta/{idVenta}',[DetalleVentaController::class, 'show']);
Route::resource('compras',CompraController::class);
Route::get('/detalleCompra/{idCompra}',[DetalleCompraController::class, 'show']);


Route::post('/empleado/login', [EmpleadoController::class, 'login'])->name('empleado.login');


Route::resource('clientes', ClienteController::class);


Route::resource('pedidos', PedidoController::class);
Route::put('pedidos/{pedido}/anular', [PedidoController::class, 'anular'])->name('pedidos.anular');


