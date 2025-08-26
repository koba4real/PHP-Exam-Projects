<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Classifica Torneo</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Classifica Torneo</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="mt-4 mb-4">
            <form action="{{ url('/init') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-primary">Inizializza Classifica</button>
            </form>
            <form action="{{ route('reset') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Resetta Classifica</button>
            </form>

            <button id="btnPunteggioMedio" type="button" class="btn btn-info">3. Visualizza Punteggio Medio</button>
        </div>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nome Squadra</th>
                    <th>Punti Totali</th>
                    <th>Partite Giocate</th>
                    <th>Vittorie</th>
                    <th>Pareggi</th>
                    <th>Sconfitte</th>
                </tr>
            </thead>
            <tbody>
                @isset($squadre)
                    @forelse ($squadre as $squadra)
                       <tr>
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
    </div>
    
    <!-- Finestra Modale per il Punteggio Medio -->
    <div class="modal fade" id="punteggioMedioModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Punteggio Medio per Partita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalBodyContent">
                    <!-- Contenuto caricato via AJAX -->
                </div>
            </div>
        </div>
    </div>

    <!-- Includiamo le librerie UNA SOLA VOLTA, alla fine -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script AJAX per il pulsante 3 -->
    <script>
    $(document).ready(function() {
        $('#btnPunteggioMedio').on('click', function() {
            
            // 1. Prepara e mostra subito la modale con un messaggio di caricamento
            $('#modalBodyContent').html('<p>Caricamento in corso...</p>');
            var modal = new bootstrap.Modal(document.getElementById('punteggioMedioModal'));
            modal.show();

            // 2. Esegui la chiamata AJAX
            $.ajax({
                url: '{{ route("punteggio.medio") }}', // Assicurati che il nome della rotta sia corretto
                type: 'GET',
                success: function(response) {
                    var content = '<ul class="list-group">';
                    if (response.length > 0) {
                        response.forEach(function(item) {
                            var mediaPunti = item.punteggioMedio || 0; // Gestisce valori nulli se presenti
                            content += '<li class="list-group-item d-flex justify-content-between align-items-center">';
                            content += item.nome;
                            content += '<span class="badge bg-primary rounded-pill">' + mediaPunti.toFixed(2) + '</span>';
                            content += '</li>';
                        });
                    } else {
                        content += '<li class="list-group-item">Nessun dato da visualizzare.</li>';
                    }
                    content += '</ul>';

                    // 3. Aggiorna il contenuto della modale con i dati ricevuti
                    $('#modalBodyContent').html(content);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // 3b. In caso di errore, aggiorna la modale con un messaggio di errore
                    console.error("Errore AJAX: ", textStatus, errorThrown); // Logga l'errore in console
                    $('#modalBodyContent').html('<p class="text-danger">Errore nel caricamento dei dati. Controlla la console per i dettagli.</p>');
                }
            });
        });
    });
    </script>
</body>
</html>