<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function getCategorias()
    {
        $categoria = Categoria::all();
        return view('categoria', compact('categoria'));
    }

    public function createCategoria(Request $request)
    {
        $request->validate([
            'categoria' => 'required|string|max:255',
        ]);

        Categoria::create([
            'categoria' => $request->categoria,
        ]);

        return redirect()->route('getCategoria');
    }

    public function updateCategoria(Request $request, $id)
    {
        $request->validate([
            'categoria' => 'required|string|max:255',
        ]);

        Categoria::findOrFail($id)->update([
            'categoria' => $request->categoria,
        ]);

        return redirect()->route('getCategoria');
    }

    public function deleteCategoria($id)
    {
        Categoria::findOrFail($id)->delete();

        return redirect()->route('getCategoria');
    }
}