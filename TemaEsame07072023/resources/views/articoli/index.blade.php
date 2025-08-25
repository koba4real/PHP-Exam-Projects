<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elenco Articoli Conferenza</title>
    <!-- Inclusione di Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Puoi mantenere il tuo app.css se hai stili personalizzati -->
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Elenco Articoli Conferenza</h1>

        <table class="table table-hover"> <!-- table-hover per un effetto migliore -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titolo</th>
                    <th>Autori (Iniziali)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articoli as $articolo)
                    <!-- Aggiunta classe .article-row, attributo data-id e stile per il cursore -->
                    <tr class="article-row" data-id="{{ $articolo->id }}" style="cursor: pointer;">
                        <td>{{ $articolo->id }}</td>
                        <td>{{ $articolo->titolo }}</td>
                        <td>
                            @foreach ($articolo->autori as $autore)
                                <!-- Requisito: iniziale nome e cognome -->
                                {{ substr($autore->nome, 0, 1) }}. {{ $autore->cognome }}@if (!$loop->last), @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- INIZIO: Finestra Modale di Bootstrap per i dettagli degli autori -->
    <div class="modal fade" id="authorDetailsModal" tabindex="-1" aria-labelledby="authorDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="authorDetailsModalLabel">Dettagli Autori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="authorDetailsBody">
                    <!-- Il contenuto verrà caricato qui tramite AJAX -->
                    <p>Caricamento...</p>
                </div>
            </div>
        </div>
    </div>
    <!-- FINE: Finestra Modale -->

    <!-- Inclusione di jQuery (necessario per AJAX) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Inclusione di Bootstrap 5 JS (necessario per la modale) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- INIZIO: Script AJAX -->
    <script>
    // Assicura che il DOM sia completamente caricato prima di eseguire lo script
    $(document).ready(function() {

        // 1. Intercetta il click su qualsiasi riga della tabella con la classe .article-row
        $('.article-row').on('click', function() {
            // 2. Recupera l'ID dell'articolo dall'attributo data-id della riga cliccata
            var articleId = $(this).data('id');

            // Prepara la modale (mostra un messaggio di caricamento)
            $('#authorDetailsBody').html('<p>Caricamento...</p>');
            var authorModal = new bootstrap.Modal(document.getElementById('authorDetailsModal'));
            authorModal.show();

            // 3. Esegui la chiamata AJAX al server
            $.ajax({
                // L'URL a cui inviare la richiesta. Laravel la gestirà.
                url: '/articoli/' + articleId + '/autori',
                type: 'GET', // Il metodo HTTP da usare

                // 4. Funzione da eseguire in caso di successo
                success: function(authors) {
                    // 'authors' è l'array di oggetti JSON restituito dal server
                    var modalContent = '<ul>';

                    // Controlla se ci sono autori
                    if (authors.length > 0) {
                        // Itera su ogni autore ricevuto e costruisci una lista HTML
                        authors.forEach(function(author) {
                            modalContent += '<li style="margin-bottom: 1rem;">';
                            modalContent += '<strong>' + author.nome + ' ' + author.cognome + '</strong><br>';
                            modalContent += 'Email: ' + author.email + '<br>';
                            modalContent += 'Istituto: ' + author.istituto;
                            modalContent += '</li>';
                        });
                    } else {
                        modalContent += '<li>Nessun autore trovato per questo articolo.</li>';
                    }

                    modalContent += '</ul>';

                    // 5. Inserisci il contenuto HTML generato nel corpo della modale
                    $('#authorDetailsBody').html(modalContent);
                },

                // Funzione da eseguire in caso di errore
                error: function() {
                    $('#authorDetailsBody').html('<p class="text-danger">Impossibile caricare i dettagli degli autori.</p>');
                }
            });
        });
    });
    </script>
    

    
</body>
</html>