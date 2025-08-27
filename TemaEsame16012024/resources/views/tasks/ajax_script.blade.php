<script>
    $(document).ready(function() { // Corrected 'docuemnt' to 'document'
        $('.task-toggle').change(function() {
            const taskId = $(this).data('task-id');
            const isChecked = $(this).is(':checked'); // Get current state of checkbox
            const label = $(this).next('label'); // Get the label next to the checkbox

            $.ajax({
                url: `/tasks/${taskId}/toggle`, // Corrected URL to match your route
                type: 'PATCH', // Corrected 'PATCH' to be a string
                data: {
                    completato: isChecked, // Send the actual checked status
                    _token: '{{ csrf_token() }}' // Laravel's CSRF token
                },
                success: function(response) {
                    // Update the label text based on the new status
                    if (isChecked) { // Changed 'isCompleted' to 'isChecked'
                        label.text('Sì');
                    } else {
                        label.text('No');
                    }
                    console.log('Task status updated successfully:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Error updating task status:', xhr.responseText);
                    // Revert the checkbox state if the update fails
                    $(this).prop('checked', !isChecked);
                    alert('Errore durante l\'aggiornamento dello stato dell\'attività.');
                }
            });
        });
    });
</script>