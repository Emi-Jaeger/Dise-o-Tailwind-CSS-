<?php
namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    private function reglas(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'nullable|exists:categorias,id',
        ];
    }

    public function index()
    {
        $productos = Producto::with('categoria')->get();
        $categorias = Categoria::all();
        return view('productos', compact('productos', 'categorias'));
    }

    public function store(Request $request)
    {
        Producto::create($request->validate($this->reglas()));
        return redirect()->route('productos.index');
    }

    public function update(Request $request, $id)
    {
        Producto::findOrFail($id)->update($request->validate($this->reglas()));
        return redirect()->route('productos.index');
    }

    public function destroy($id)
    {
        Producto::findOrFail($id)->delete();
        return redirect()->route('productos.index');
    }
}
