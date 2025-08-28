<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transazioni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="container mt-5">
        <h1>Elenco delle Transazioni</h1>
        <form id="transazioni">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Descrizione</th>
                    <th>Importo</th>
                    <th>Data</th>
                    <th>Tipo</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($transazioni as $transazione)
                        @if ($transazione->tipo === 'Entrata')
                            <tr class="table-success">
                        @else
                            <tr class="table-danger">
                        @endif
                                <td>{{ $transazione->id }}</td>
                                <td>{{ $transazione->descrizione }}</td>
                                <td>{{ $transazione->importo }}</td>
                                <td>{{ $transazione->data }}</td>
                                <td>{{ $transazione->tipo }}</td>
                                <td>
                                    <form action="{{ route('transazioni.destroy', $transazione->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                                    </form>
                                    <button type="button" class="btn btn-primary btn-sm">Modifica</button>
                                </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</body>
</html>