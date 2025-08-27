<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Studenti</title>
</head>
<body>
    <div id="record-container">
        @include('record_detail', [
            'studente' => $studente,
            'is_first' => $is_first,
            'is_last' => $is_last,
        ])
    </div>

    <script>
    let currentId = {{ $studente->id }};

    function loadRecord(id) {
        fetch(`/studenti/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('record-container').innerHTML = data.html;
                currentId = data.current_id;
            });
    }
    </script>
</body>
</html>
