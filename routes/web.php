<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/galeria', function () {
    $items = [
        ['titulo' => 'Paisaje Natural', 'descripcion' => 'Una hermosa vista de la naturaleza.',            'imagen' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=800'],
        ['titulo' => 'Montañas',        'descripcion' => 'Paisajes increíbles rodeados de montañas.',      'imagen' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800'],
        ['titulo' => 'Bosque',          'descripcion' => 'Un tranquilo bosque rodeado de naturaleza.',     'imagen' => 'https://images.unsplash.com/photo-1448375240586-882707db888b?w=800'],
        ['titulo' => 'Playa',           'descripcion' => 'Un lugar perfecto para descansar.',              'imagen' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800'],
        ['titulo' => 'Ciudad',          'descripcion' => 'Arquitectura moderna en una gran ciudad.',       'imagen' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800'],
        ['titulo' => 'Aventura',        'descripcion' => 'Explora nuevos lugares y vive nuevas experiencias.', 'imagen' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800'],
    ];

    return view('galeria', compact('items'));
});

Route::get('/categoria', [CategoriaController::class, 'getCategorias'])->name('getCategoria');

Route::post('/create/categoria', [CategoriaController::class, 'createCategoria'])->name('categoria.create');

Route::put("update/categoria/{id}", [CategoriaController::class, 'updateCategoria'])->name('categoria.update');

Route::delete("delete/categoria/{id}", [CategoriaController::class, 'deleteCategoria'])->name('categoria.delete');