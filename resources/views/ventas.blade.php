<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Ventas</title>
</head>
<body>
    <x-navbar/>
    <h1 class="text-center my-3">Ventas</h1>

    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $e) <div>{{ $e }}</div> @endforeach
            </div>
        @endif

        <form action="{{ route('ventas.store') }}" method="POST" class="row g-2 mb-4">
            @csrf
            <div class="col-md-2">
                <select name="cliente_id" class="form-select" required>
                    <option value="">Cliente</option>
                    @foreach($clientes as $c)
                        <option value="{{ $c->id }}" @selected(old('cliente_id') == $c->id)>{{ $c->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2"><input type="date" name="fecha_venta" class="form-control" value="{{ old('fecha_venta', now()->toDateString()) }}" required></div>
            <div class="col-md-2">
                <select name="estado" class="form-select" required>
                    <option value="pendiente">Pendiente</option>
                    <option value="confirmada">Confirmada</option>
                    <option value="cancelada">Cancelada</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="producto_id" class="form-select" required>
                    <option value="">Producto</option>
                    @foreach($productos as $p)
                        <option value="{{ $p->id }}" @selected(old('producto_id') == $p->id)>{{ $p->nombre }} (stock: {{ $p->stock }}, ${{ $p->precio }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1"><input type="number" min="1" name="cantidad" class="form-control" placeholder="Cant." value="{{ old('cantidad') }}" required></div>
            <div class="col-md-2"><button class="btn btn-primary w-100">Registrar</button></div>
        </form>

        <table class="table table-bordered align-middle">
            <thead class="table-info">
                <tr><th>id</th><th>Cliente</th><th>Fecha</th><th>Producto</th><th>Cant.</th><th>Total</th><th>Estado</th><th>Acciones</th></tr>
            </thead>
            <tbody>
                @foreach($ventas as $v)
                <tr>
                    <td>{{ $v->id }}</td>
                    <td>
                        <select form="up-{{ $v->id }}" name="cliente_id" class="form-select form-select-sm">
                            @foreach($clientes as $c)
                                <option value="{{ $c->id }}" @selected($v->cliente_id == $c->id)>{{ $c->nombre }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input form="up-{{ $v->id }}" type="date" name="fecha_venta" value="{{ $v->fecha_venta }}" class="form-control form-control-sm"></td>
                    <td>{{ $v->detalles->first()->producto->nombre ?? '-' }}</td>
                    <td>{{ $v->detalles->sum('cantidad') }}</td>
                    <td>${{ number_format($v->total, 2) }}</td>
                    <td>
                        <select form="up-{{ $v->id }}" name="estado" class="form-select form-select-sm">
                            @foreach(['pendiente', 'confirmada', 'cancelada'] as $e)
                                <option value="{{ $e }}" @selected($v->estado == $e)>{{ ucfirst($e) }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <form id="up-{{ $v->id }}" action="{{ route('ventas.update', $v->id) }}" method="POST">
                                @csrf @method('PUT')
                                <button class="btn btn-warning btn-sm">Actualizar</button>
                            </form>
                            @if(in_array($v->estado, ['pendiente', 'cancelada']))
                            <form action="{{ route('ventas.destroy', $v->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>