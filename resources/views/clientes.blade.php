<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Clientes</title>
</head>
<body>
    <x-navbar/>
    <h1 class="text-center my-3">Clientes</h1>

    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $e) <div>{{ $e }}</div> @endforeach
            </div>
        @endif

        <form action="{{ route('clientes.store') }}" method="POST" class="row g-2 mb-4">
            @csrf
            <div class="col-md-2"><input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ old('nombre') }}" required></div>
            <div class="col-md-3"><input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required></div>
            <div class="col-md-3"><input type="text" name="direccion" class="form-control" placeholder="Dirección" value="{{ old('direccion') }}" required></div>
            <div class="col-md-2"><input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="{{ old('telefono') }}" required></div>
            <div class="col-md-2"><button class="btn btn-primary w-100">Registrar</button></div>
        </form>

        <table class="table table-bordered align-middle">
            <thead class="table-info">
                <tr><th>id</th><th>Nombre</th><th>Email</th><th>Dirección</th><th>Teléfono</th><th>Acciones</th></tr>
            </thead>
            <tbody>
                @foreach($clientes as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td><input form="up-{{ $c->id }}" type="text" name="nombre" value="{{ $c->nombre }}" class="form-control form-control-sm"></td>
                    <td><input form="up-{{ $c->id }}" type="email" name="email" value="{{ $c->email }}" class="form-control form-control-sm"></td>
                    <td><input form="up-{{ $c->id }}" type="text" name="direccion" value="{{ $c->direccion }}" class="form-control form-control-sm"></td>
                    <td><input form="up-{{ $c->id }}" type="text" name="telefono" value="{{ $c->telefono }}" class="form-control form-control-sm"></td>
                    <td>
                        <div class="d-flex gap-2">
                            <form id="up-{{ $c->id }}" action="{{ route('clientes.update', $c->id) }}" method="POST">
                                @csrf @method('PUT')
                                <button class="btn btn-warning btn-sm">Actualizar</button>
                            </form>
                            <form action="{{ route('clientes.destroy', $c->id) }}" method="POST">
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