<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crea Lucido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4 mb-4">
        <h2>Crea Lucido</h2>
        <form id="lucido-form" action="{{ route('lucidis.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="  mb-3">
                <label for="titolo" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="titolo" name="titolo" required>
            </div>
            <div class="mb-3">
                <label for="file_path" class="form-label">Carica Documento</label>
                <input type="file" class="form-control" id="file_path" name="file_path" required>
            </div>
            <div class="mb-3">
                <label for="commento" class="form-label">Commento</label>
                <textarea class="form-control" id="commento" name="commento" rows="3"></textarea>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="pubblico">
                <label class="form-check-label" for="defaultCheck1">
                    rendi pubblico
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Salva</button>
        </form>
    </div>

    <!-- 1. Include the jQuery library from a CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    <script>
        // 2. Wait for the page to be fully loaded before running any script
        $(document).ready(function() {

            // 3. When the form is submitted...
            $('#lucido-form').on('submit', function(event) {
                // ...stop it from reloading the page
                event.preventDefault();

                // 4. Clear old errors
                $('.error-message').remove(); // Remove old error messages
                $('.is-invalid').removeClass('is-invalid'); // Remove red borders

                var form = this;
                var formData = new FormData(form);

                // 5. Send the data to the server using jQuery AJAX
                $.ajax({
                    url: $(form).attr('action'), // The URL is taken from the form's 'action' attribute
                    method: 'POST',
                    data: formData,
                    processData: false, // Important for sending files
                    contentType: false, // Important for sending files

                    // 6. This function runs if the server says everything is OK
                    success: function(response) {
                        alert('Lucido salvato con successo!');
                        form.reset(); // Empties the form fields
                    },

                    // 7. This function runs if the server returns an error (like a validation error)
                    error: function(jqXHR) {
                        // Check if it's a validation error (status 422)
                        if (jqXHR.status === 422) {
                            var errors = jqXHR.responseJSON.errors;
                            var firstErrorField = null;

                            // Loop through each error the server sent back
                            $.each(errors, function(field, messages) {
                                var inputField = $('#' + field); // Find the input field by its ID
                                var message = messages[0]; // Get the first error message

                                // Add a red border and show the error message below the field
                                inputField.addClass('is-invalid');
                                inputField.after('<div class="error-message">' + message + '</div>');
                                
                                // Keep track of the first field that had an error
                                if (!firstErrorField) {
                                    firstErrorField = inputField;
                                }
                            });

                            // Finally, move the cursor to the first field with an error
                            if (firstErrorField) {
                                firstErrorField.focus();
                            }
                        } else {
                            // Handle other kinds of errors (like server down)
                            alert('Si è verificato un errore inaspettato.');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>