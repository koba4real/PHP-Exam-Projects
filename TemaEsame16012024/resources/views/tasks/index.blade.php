<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lista attività</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
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
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input task-toggle" type="checkbox" role="switch"
                                    id="flexSwitchCheckDefault_{{ $attivita->id }}" {{-- Make ID unique for each checkbox --}}
                                    data-task-id="{{ $attivita->id }}"
                                    {{ $attivita->completato ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexSwitchCheckDefault_{{ $attivita->id }}">
                                    {{ $attivita->completato ? 'Sì' : 'No' }}
                                </label>
                            </div>
                        </td>
                        <td></td>
                        <td>
                           <form action="{{ route('tasks.destroy', $attivita->id) }}" method="post" onsubmit="return confirm('Sei sicuro di voler eliminare questa attività?');">
                               @csrf
                               @method('DELETE')
                               <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="attivita/create" class="btn btn-primary">Aggiungi Attività</a>
    </div>

@include('tasks.ajax_script')
</body>
</html>

