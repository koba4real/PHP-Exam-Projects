<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lucidi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    
    <div class="container mt-4 mb-4">
        <h2>Elenco Lucidi</h2>
        <a href="{{ route('lucidis.create') }}" class="btn btn-primary mb-3">Aggiungi Lucido</a>
        <form>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titolo</th>
                        <th>link documento</th>
                        <th>commento prof</th>
                        <th>Data Caricamento</th>
                        <th>visibilità</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lucidis as $lucidi)
                    <tr>
                        <td>{{ $lucidi->id }}</td>
                        <td>{{ $lucidi->titolo }}</td>
                        <td>
                           {{ $lucidi->file_path }}
                        </td>
                        <td>{{ $lucidi->commento }}</td>
                        <td>{{ $lucidi->created_at }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $lucidi->is_public ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexSwitchCheckChecked">{{ $lucidi->is_public ? ' pubblico' : 'privato' }}</label>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('lucidis.destroy', $lucidi->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</body>
</html>