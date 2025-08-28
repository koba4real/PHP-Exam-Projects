<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crea transazione</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1>Crea Nuova Transazione</h1>
        <form action="{{ route('transazioni.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="descrizione" class="form-label">Descrizione</label>
                <input type="text" class="form-control" id="descrizione" name="descrizione" required>
            </div>
            <div class="mb-3">
                <label for="importo" class="form-label">Importo</label>
                <input type="number" class="form-control" id="importo" name="importo" required>
            </div>
            <div class="mb-3">
                <label for="data" class="form-label">Data</label>
                <input type="date" class="form-control" id="data" name="data" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select class="form-select" id="tipo" name="tipo" required>
                    <option value="Entrata">Entrata</option>
                    <option value="spesa">spesa</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Crea Transazione</button>
        </form>
    </div>
</body>
</html>