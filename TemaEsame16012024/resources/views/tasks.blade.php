<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lista attività</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  
</head>
<body>
    
    <div class="container mt-5">
        <h1>Attività</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Completato</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($attivita as $attivita)
                    <tr>
                        <td>{{ $attivita->id }}</td>
                        <td>{{ $attivita->titolo }}</td>
                        <td>{{ $attivita->descrizione }}</td>
                        <td>{{ $attivita->completato ? 'Sì' : 'No' }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>