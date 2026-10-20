<?php
namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('cliente', 'detalles.producto')->latest()->get();
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas', compact('ventas', 'clientes', 'productos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha_venta' => 'required|date',
            'estado' => 'required|in:pendiente,confirmada,cancelada',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($data['producto_id']);

        if ($producto->stock < $data['cantidad']) {
            return back()
                ->withErrors(['cantidad' => "Stock insuficiente de {$producto->nombre}. Disponible: {$producto->stock}"])
                ->withInput();
        }

        DB::transaction(function () use ($data, $producto) {
            $total = $producto->precio * $data['cantidad'];

            $venta = Venta::create([
                'cliente_id' => $data['cliente_id'],
                'fecha_venta' => $data['fecha_venta'],
                'estado' => $data['estado'],
                'total' => $total,
            ]);

            $venta->detalles()->create([
                'producto_id' => $producto->id,
                'cantidad' => $data['cantidad'],
                'precio_unitario' => $producto->precio,
                'total' => $total,
            ]);

            if ($data['estado'] === 'confirmada') {
                $producto->decrement('stock', $data['cantidad']);
            }
        });

        return redirect()->route('ventas.index');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha_venta' => 'required|date',
            'estado' => 'required|in:pendiente,confirmada,cancelada',
        ]);

        $venta = Venta::with('detalles.producto')->findOrFail($id);

        DB::transaction(function () use ($venta, $data) {
            $anterior = $venta->estado;
            $nuevo = $data['estado'];

            if ($anterior !== 'confirmada' && $nuevo === 'confirmada') {
                foreach ($venta->detalles as $detalle) {
                    if ($detalle->producto->stock < $detalle->cantidad) {
                        throw ValidationException::withMessages([
                            'estado' => "Stock insuficiente de {$detalle->producto->nombre} para confirmar la venta.",
                        ]);
                    }
                }
                foreach ($venta->detalles as $detalle) {
                    $detalle->producto->decrement('stock', $detalle->cantidad);
                }
            }

            if ($anterior === 'confirmada' && $nuevo !== 'confirmada') {
                foreach ($venta->detalles as $detalle) {
                    $detalle->producto->increment('stock', $detalle->cantidad);
                }
            }

            $venta->update($data);
        });

        return redirect()->route('ventas.index');
    }

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);

        if (!in_array($venta->estado, ['pendiente', 'cancelada'])) {
            return back()->withErrors(['estado' => 'Solo se pueden eliminar ventas pendientes o canceladas.']);
        }

        $venta->delete();
        return redirect()->route('ventas.index');
    }
}