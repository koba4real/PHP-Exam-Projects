
<h1>Voto Studenti</h1>
<form id="votoForm">
    @csrf
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Data Appello</th>
                <th>matricola</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Voto</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input type="date" class="form-control" value="{{ $studente->data_esame }}">
                </td>
                <td>
                    <input type="text" class="form-control" value="{{ $studente->matricola }}">
                </td>
                <td>
                    <input type="text" class="form-control" value="{{ $studente->nome }}">
                </td>
                <td>
                    <input type="text" class="form-control" value="{{ $studente->cognome }}">
                </td>
                <td>
                    <select>
                        <option>sciegli un opzione per il Voto</option>
                        <option value="-1" {{ $studente->voto == -1 ? 'selected' : '' }}>Insufficiente</option>
                        <option value="superato" {{ $studente->voto >= 18 && $studente->voto <= 30 ? 'selected' : '' }}>Esame superato</option>
                        <option value="33" {{ $studente->voto == 33 ? 'selected' : '' }}>Lode</option>
                    </select>
                    <input type="number" id="voto-num" min="18" max="30"
                        value="{{ ($studente->voto >= 18 && $studente->voto <= 30) ? $studente->voto : '' }}"
                        {{ ($studente->voto >= 18 && $studente->voto <= 30) ? '' : 'disabled' }}>
                    <input type="hidden" name="voto" id="voto-hidden" value="{{ $studente->voto }}">
                
                </td>
            </tr>
        </tbody>
    </table>
    <div class="text-center">
        <button type="submit" id="saveBtn" class="btn btn-primary" disabled>Salva</button>
        <button class="btn btn-primary" id="prev-button" onclick="loadRecord({{ $is_first ? 'null' : ($studente->id - 1) }})" {{ $is_first ? 'disabled' : '' }}>Precedente</button>
        <button class="btn btn-primary" id="next-button" onclick="loadRecord({{ $is_last ? 'null' : ($studente->id + 1) }})" {{ $is_last ? 'disabled' : '' }}>Successivo</button>
    </div>
</form>


<!-- ========== SAVE BUTTON SCRIPT (SALVA) ========== -->
    <script>
        // Initialize save button and form change tracking
        function initializeSaveButton() {
            document.getElementById('votoForm').addEventListener('submit', saveStudent);
        }
        
        // Initialize form change tracking
        function initializeFormChangeTracking() {
            // Track changes in all form inputs
            document.querySelectorAll('#votoForm input, #votoForm select').forEach(element => {
                element.addEventListener('input', checkForChanges);
                element.addEventListener('change', checkForChanges);
            });
        }
        
        // Check for changes in form data (highlights save button if modified)
        function checkForChanges() {
            const form = document.getElementById('votoForm');
            const currentData = {
                data_appello: form.data_appello.value,
                matricola: form.matricola.value,
                cognome: form.cognome.value,
                nome: form.nome.value,
                voto: form.voto.value
            };
            
            isModified = JSON.stringify(originalData) !== JSON.stringify(currentData);
            
            const saveBtn = document.getElementById('saveBtn');
            if (isModified) {
                saveBtn.classList.add('btn-save-modified');
            } else {
                saveBtn.classList.remove('btn-save-modified');
            }
        }
        
        // Save student data (called when form is submitted)
        function saveStudent(e) {
            e.preventDefault();
            
            const formData = new FormData(e.target);
            const studentId = document.getElementById('studentId').value;
            
            const data = {
                data_appello: formData.get('data_appello'),
                matricola: formData.get('matricola'),
                cognome: formData.get('cognome'),
                nome: formData.get('nome'),
                voto: formData.get('voto')
            };
            
            fetch(`/api/studenti/${studentId}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    showAlert('Dati salvati con successo!', 'success');
                    storeOriginalData();
                    checkForChanges();
                } else {
                    showAlert('Errore nel salvataggio: ' + JSON.stringify(result.errors), 'danger');
                }
            })
            .catch(error => {
                console.error('Error saving student:', error);
                showAlert('Errore nel salvataggio dei dati', 'danger');
            });
        }
    </script>



