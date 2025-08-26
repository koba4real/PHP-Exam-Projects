<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione Voti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <!-- Colonna Form -->
            <div class="col-md-6">
                <h2>Registra Voto Esame</h2>
                <hr>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('voti.store') }}" method="POST">
                    @csrf
                    <!-- Nome e Cognome -->
                    <div class="mb-3">
                        <label for="studente" class="form-label">Nome</label>
                        <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}">
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="cognome" class="form-label">Cognome</label>
                        <input type="text" class="form-control @error('cognome') is-invalid @enderror" id="cognome" name="cognome" value="{{ old('cognome') }}">
                        @error('cognome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Matricola -->
                    <div class="mb-3">
                        <label for="matricola" class="form-label">Matricola</label>
                        <input type="number" class="form-control @error('matricola') is-invalid @enderror" id="matricola" name="matricola" value="{{ old('matricola') }}">
                         @error('matricola')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Voto -->
                    <div class="mb-3">
                        <label for="voto" class="form-label">Voto (18-30 o "insufficiente")</label>
                        <input type="text" class="form-control @error('voto') is-invalid @enderror" id="voto" name="voto" value="{{ old('voto') }}">
                         @error('voto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Lode -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="lode" name="lode" value="1" {{ old('lode') ? 'checked' : '' }}>
                        <label class="form-check-label" for="lode">Lode</label>
                    </div>

                    <!-- Data Esame -->
                    <div class="mb-3">
                        <label for="data_esame" class="form-label">Data Esame</label>
                        <input type="date" class="form-control @error('data_esame') is-invalid @enderror" id="data_esame" name="data_esame" value="{{ old('data_esame') }}">
                         @error('data_esame')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Commenti -->
                    <div class="mb-3">
                        <label for="commenti" class="form-label">Commenti</label>
                        <textarea class="form-control" id="commenti" name="commenti" rows="3">{{ old('commenti') }}</textarea>
                    </div>

                    <!-- Pulsanti -->
                    <button type="submit" class="btn btn-primary">Salva Voto</button>
                </form>
                <form action="{{ route('voti.destroyAll') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler cancellare tutti i voti?')">Cancella Tutto</button>
                </form>
            </div>

            <!-- Colonna Statistiche -->
            <div class="col-md-5 offset-md-1">
                <h2>Statistiche</h2>
                <hr>
                @isset($stats)
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Voti registrati
                            <span class="badge bg-primary rounded-pill">{{ $stats['totale'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Voto medio (sufficienti)
                            <span class="badge bg-info rounded-pill">{{ number_format($stats['voto_medio'], 2) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Percentuale sufficienti
                            <span class="badge bg-success rounded-pill">{{ number_format($stats['perc_sufficienti'], 1) }}%</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Voto massimo
                            <span class="badge bg-warning text-dark rounded-pill">{{ $stats['max'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Voto minimo (sufficienti)
                            <span class="badge bg-secondary rounded-pill">{{ $stats['min'] }}</span>
                        </li>
                    </ul>
                @else
                    <p>Nessun dato presente per calcolare le statistiche.</p>
                @endisset
            </div>
        </div>
    </div>
</body>
</html>