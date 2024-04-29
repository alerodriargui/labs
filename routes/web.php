<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PedidoController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/greeting', function () {
    return 'Hello World';
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/', [PlantController::class, 'index']);
Route::post('/products', [App\Http\Controllers\PlantController::class, 'store'])->name('plants.store');
Route::get('/subir_producto', [App\Http\Controllers\PlantController::class, 'create'])->name('subir_producto');
Route::get('/plant/{id_plant}', [App\Http\Controllers\PlantController::class, 'details'])->name('detalles_planta');

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::post('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('remove-from-cart');
Route::post('/realizar-pedido', [PedidoController::class, 'realizarPedido'])->name('realizar-pedido');
Route::get('/formulario-pedido', [PedidoController::class, 'mostrarFormularioPedido'])->name('formulario-pedido');



