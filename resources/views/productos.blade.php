<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Productos</title>
</head>
<body>
    <x-navbar/>
    <h1 class="text-center my-3">Productos</h1>

    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $e) <div>{{ $e }}</div> @endforeach
            </div>
        @endif

        <form action="{{ route('productos.store') }}" method="POST" class="row g-2 mb-4">
            @csrf
            <div class="col-md-3"><input type="text" name="nombre" class="form-control" placeholder="Nombre" required></div>
            <div class="col-md-2"><input type="number" step="0.01" name="precio" class="form-control" placeholder="Precio" required></div>
            <div class="col-md-2"><input type="number" name="stock" class="form-control" placeholder="Stock" required></div>
            <div class="col-md-3">
                <select name="categoria_id" class="form-select">
                    <option value="">Sin categoría</option>
                    @foreach($categorias as $c)
                        <option value="{{ $c->id }}">{{ $c->categoria }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2"><button class="btn btn-primary w-100">Registrar</button></div>
        </form>

        <table class="table table-bordered align-middle">
            <thead class="table-info">
                <tr><th>id</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Categoría</th><th>Acciones</th></tr>
            </thead>
            <tbody>
                @foreach($productos as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td><input form="up-{{ $p->id }}" type="text" name="nombre" value="{{ $p->nombre }}" class="form-control form-control-sm"></td>
                    <td><input form="up-{{ $p->id }}" type="number" step="0.01" name="precio" value="{{ $p->precio }}" class="form-control form-control-sm"></td>
                    <td><input form="up-{{ $p->id }}" type="number" name="stock" value="{{ $p->stock }}" class="form-control form-control-sm"></td>
                    <td>
                        <select form="up-{{ $p->id }}" name="categoria_id" class="form-select form-select-sm">
                            <option value="">Sin categoría</option>
                            @foreach($categorias as $c)
                                <option value="{{ $c->id }}" @selected($p->categoria_id == $c->id)>{{ $c->categoria }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <form id="up-{{ $p->id }}" action="{{ route('productos.update', $p->id) }}" method="POST">
                                @csrf @method('PUT')
                                <button class="btn btn-warning btn-sm">Actualizar</button>
                            </form>
                            <form action="{{ route('productos.destroy', $p->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>