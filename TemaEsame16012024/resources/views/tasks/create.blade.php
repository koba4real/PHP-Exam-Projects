<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea attività</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  
</head>
<body>
    
    <div class="container mt-5">
        <h1>Crea Attività</h1>

        <form id="taskform" action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Titolo</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Completato</th>
                    </tr>
                </thead>
                <tbody>
                    <td><input type="text" class="form-control" name="titolo" placeholder="Titolo"></td>
                    <td><input type="text" class="form-control" name="descrizione" placeholder="Descrizione"></td>
                    <td>
                        <select class="form-select" name="completato">
                            <option value="0">No</option>
                            <option value="1">Sì</option>
                        </select>
                    
                </tbody>
            </table>
        </form>
        <button type="submit" form="taskform" class="btn btn-success">Salva Attività</button>    
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Annulla</a>

    </div>
</body>
</html>