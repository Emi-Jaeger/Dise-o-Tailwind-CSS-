<?php
namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes', compact('clientes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
        ]);

        Cliente::create($data);
        return redirect()->route('clientes.index');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $id,
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
        ]);

        Cliente::findOrFail($id)->update($data);
        return redirect()->route('clientes.index');
    }

    public function destroy($id)
    {
        Cliente::findOrFail($id)->delete();
        return redirect()->route('clientes.index');
    }
}