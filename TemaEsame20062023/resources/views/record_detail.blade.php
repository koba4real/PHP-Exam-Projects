<table border="1" style="margin-bottom: 10px;">
    <tr>
        <th>Data appello</th>
        <th>Matricola</th>
        <th>Cognome</th>
        <th>Nome</th>
        <th>Voto</th>
    </tr>
    <tr>
        <td>{{ \Carbon\Carbon::parse($studente->data_appello)->format('d/m/Y') }}</td>
        <td>{{ $studente->matricola }}</td>
        <td>{{ $studente->cognome }}</td>
        <td>{{ $studente->nome }}</td>
        <td>
            <select>
                <option>Scegliere un'opzione</option>
                @for ($i = 18; $i <= 30; $i++)
                    <option value="{{ $i }}" {{ $studente->voto == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
                <option value="-1" {{ $studente->voto == -1 ? 'selected' : '' }}>Insufficiente</option>
                <option value="33" {{ $studente->voto == 33 ? 'selected' : '' }}>30 e Lode</option>
            </select>
        </td>
    </tr>
</table>

<button onclick="loadRecord({{ $studente->id - 1 }})" {{ $is_first ? 'disabled' : '' }}>&lt;</button>
<button onclick="loadRecord({{ $studente->id + 1 }})" {{ $is_last ? 'disabled' : '' }}>&gt;</button>
