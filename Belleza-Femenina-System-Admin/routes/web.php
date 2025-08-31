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

use App\Http\Middleware\CheckPermission; // Importamos el middleware

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página de login
Route::get('/', function () {
    return view('login.login');
})->name('panel');

// Página principal después de loguearse
Route::get('/inicio', function () {
    return view('panel.panel');
})->name('panel');

// -----------------------------
// Rutas protegidas con permisos
// -----------------------------

// Categorías
Route::middleware([CheckPermission::class.':categoriaProductos'])->group(function () {
    Route::resource('categorias', CategoriaController::class);
});

// Productos
Route::middleware([CheckPermission::class.':productos'])->group(function () {
    Route::resource('productos', ProductoController::class);
});

// Tallas
Route::middleware([CheckPermission::class.':tallas'])->group(function () {
    Route::resource('tallas', TallaController::class);
});

// Variantes de productos
Route::middleware([CheckPermission::class.':variantesProducto'])->group(function () {
    Route::resource('variantes-productos', VariantesProductoController::class);
    Route::get('/producto-datos/{id_producto}', [VariantesProductoController::class, 'getDatosProducto']);
});

// Permisos
Route::middleware([CheckPermission::class.':permisos'])->group(function () {
    Route::resource('permisos', PermisoController::class);
});

// Empleados
Route::middleware([CheckPermission::class.':empleados'])->group(function () {
    Route::resource('empleados', EmpleadoController::class);
});

// Logs
Route::resource('logs', LogController::class);

// Gastos operativos
Route::middleware([CheckPermission::class.':gastosOperativos'])->group(function () {
    Route::resource('gastos-operativos', GastosOperativoController::class);
});

// Ventas
Route::middleware([CheckPermission::class.':ventas'])->group(function () {
    Route::resource('ventas', VentaController::class);
    Route::get('/detalleVenta/{idVenta}', [DetalleVentaController::class, 'show']);
});

// Compras
Route::middleware([CheckPermission::class.':compras'])->group(function () {
    Route::resource('compras', CompraController::class);
    Route::get('/detalleCompra/{idCompra}', [DetalleCompraController::class, 'show']);
});

// Clientes
Route::middleware([CheckPermission::class.':clientes'])->group(function () {
    Route::resource('clientes', ClienteController::class);
});

// Pedidos
Route::middleware([CheckPermission::class.':pedidos'])->group(function () {
    Route::resource('pedidos', PedidoController::class);
    Route::put('pedidos/{pedido}/anular', [PedidoController::class, 'anular'])->name('pedidos.anular');
});

// -----------------------------
// Login empleados
// -----------------------------
Route::post('/empleado/login', [EmpleadoController::class, 'login'])->name('empleado.login');
Route::post('/empleado/logout', [EmpleadoController::class, 'logout'])->name('empleado.logout');
