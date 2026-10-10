<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function getCategorias()
    {
        // select * from categoria
        $categoria = Categoria::all();
        return view('categoria', compact('categoria'));
    }

    public function createCategoria(Request $request)
    {
        $request->validate([
            'categoria' => 'required'
        ]);

        Categoria::create([
            'categoria' => $request->categoria
        ]);

        return redirect()->back();
    }

    public function updateCategoria($id, Request $request)
    {
        // select * from categoria where id = 1
        $categoria = Categoria::find($id);
        $categoria->update([
            "categoria" => $request->categoria
        ]);
        $categoria->save();
        return redirect("/categorias")->with(["mensaje" => "categoria Actualizada"]);
    }

    public function deleteCategoria($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();
        $categoria->save();
        return redirect("/categorias")->with(["mensaje" => "categoria Eliminada"]);
    }
}

