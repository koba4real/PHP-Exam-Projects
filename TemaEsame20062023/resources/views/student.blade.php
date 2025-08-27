<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Studenti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  
</head>
<body>
    <div id="record-container" class="mb-3 mt-3 mv-3">
        @include('record_detail', [
            'studente' => $student,
            'is_first' => $is_first,
            'is_last' => $is_last,
        ])
        </div>
    <script>
        let currentId = {{ $student->id }};
        function loadRecord(id) {
            if (id === null) return;

            fetch(`/student/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('record-container').innerHTML = data.html;
                    currentId = data.current_id;
                });
        }

    </script>
</body>
</html>
