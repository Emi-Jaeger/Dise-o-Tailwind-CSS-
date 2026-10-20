<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;

Route::resource('productos', ProductoController::class)->only(['index', 'store', 'update', 'destroy']);
Route::resource('clientes', ClienteController::class)->only(['index', 'store', 'update', 'destroy']);
Route::resource('ventas', VentaController::class)->only(['index', 'store', 'update', 'destroy']);
Route::get('/categoria', [CategoriaController::class, 'getCategorias'])->name('getCategoria');
Route::post('/create/categoria', [CategoriaController::class, 'createCategoria'])->name('categoria.create');
Route::put('/update/categoria/{id}', [CategoriaController::class, 'updateCategoria'])->name('categoria.update');
Route::delete('/delete/categoria/{id}', [CategoriaController::class, 'deleteCategoria'])->name('categoria.delete');