<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <x-navbar/>

    <h1 class="text-center my-3">Categorías</h1>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $e)
                            <div>{{ $e }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="mb-3">
                    <x-create-categoria/>
                </div>

                <table class="table table-bordered align-middle">
                    <thead class="table-info">
                        <tr>
                            <th>id</th>
                            <th>categorías</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categoria as $i)
                        <tr>
                            <td>{{ $i->id }}</td>
                            <td>{{ $i->categoria }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <form action="{{ route('categoria.update', $i->id) }}" method="POST" class="d-flex gap-2 flex-grow-1">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="categoria" value="{{ $i->categoria }}" class="form-control form-control-sm" required>
                                        <button type="submit" class="btn btn-warning btn-sm">Actualizar</button>
                                    </form>
                                    <form action="{{ route('categoria.delete', $i->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>