<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Classifica Torneo</title>
</head>
<body>
    <h1>Classifica Torneo</h1>

     <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Squadra</th>
                    <th>Punti</th>
                    <th>PG</th>
                    <th>V</th>
                    <th>N</th>
                    <th>P</th>
                </tr>
            </thead>
        <tbody >
             @isset($squadre)
                    @forelse ($squadre as $squadra)
                       <tr class="article-row" data-id="{{ $squadra->id }}" style="cursor: pointer;">
                            <td>{{ $squadra->nome }}</td>
                            <td><strong>{{ $squadra->punti }}</strong></td>
                            <td>{{ $squadra->partite_giocate }}</td>
                            <td>{{ $squadra->vittorie }}</td>
                            <td>{{ $squadra->pareggi }}</td>
                            <td>{{ $squadra->sconfitte }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Nessuna squadra nel database. Eseguire il seeder.</td>
                        </tr>
                    @endforelse
                @endisset
        </tbody>
    </table>
</body>
</html>