<?php

namespace App\Http\Controllers;

use App\Models\Squadra;
use Illuminate\Http\Request;

class SquadraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       // Ordina per punti decrescente, e in caso di parità, per nome crescente.
        $squadre = Squadra::orderBy('punti', 'desc')->orderBy('nome', 'asc')->get();
        return view('classifica', ['squadre' => $squadre]);
    }

    public function reset()
    {
        // Resetta tutte le statistiche delle squadre a zero
        Squadra::query()->update([
            'punti' => 0,
            'partite_giocate' => 0,
            'vittorie' => 0,
            'pareggi' => 0,
            'sconfitte' => 0,
        ]);

        return redirect()->route('classifica')->with('success', 'Classifica resettata con successo.');
    }



    /**
     * Inizializza le statistiche delle squadre con valori casuali ma coerenti.
     * Ogni squadra avrà lo stesso numero di partite giocate, e la somma delle vittorie e sconfitte sarà coerente.
     */
    public function init()
    {
        $squadre = Squadra::all();
        $numSquadre = $squadre->count();

        // Verifica che ci siano almeno 2 squadre per poter generare una classifica
        if ($numSquadre < 2) {
            return redirect()->route('classifica')->with('error', 'Sono necessarie almeno 2 squadre.');
        }

        $isCoerente = false;
        do {
            // 1. Definisce il numero di partite giocate (uguale per tutte le squadre)
            // In un girone A/R con N squadre, il massimo è (N-1)*2
            $partiteGiocate = rand(1, ($numSquadre - 1) * 2);

            $statisticheGenerate = [];
            $vittorieParziali = 0;
            $sconfitteParziali = 0;

            // 2. Genera statistiche casuali per le prime N-1 squadre
            for ($i = 0; $i < $numSquadre - 1; $i++) {
                $squadra = $squadre[$i];
                $vittorie = rand(0, $partiteGiocate);
                $pareggi = rand(0, $partiteGiocate - $vittorie);
                $sconfitte = $partiteGiocate - $vittorie - $pareggi;

                // Salva le statistiche generate per la squadra corrente
                $statisticheGenerate[$squadra->id] = [
                    'vittorie' => $vittorie,
                    'pareggi' => $pareggi,
                    'sconfitte' => $sconfitte,
                ];

                // Aggiorna i totali parziali di vittorie e sconfitte
                $vittorieParziali += $vittorie;
                $sconfitteParziali += $sconfitte;
            }

            // 3. Calcola le sconfitte necessarie per l'ultima squadra per mantenere la coerenza
            $squadraFinale = $squadre[$numSquadre - 1];
            $sconfitteSquadraFinale = $vittorieParziali - $sconfitteParziali;

            // 4. Verifica che il valore calcolato sia valido (tra 0 e partite giocate)
            if ($sconfitteSquadraFinale >= 0 && $sconfitteSquadraFinale <= $partiteGiocate) {
                $isCoerente = true;

                // Calcola vittorie e pareggi rimanenti per l'ultima squadra
                $vittoriePareggiRimanenti = $partiteGiocate - $sconfitteSquadraFinale;
                $vittorieSquadraFinale = rand(0, $vittoriePareggiRimanenti);
                $pareggiSquadraFinale = $vittoriePareggiRimanenti - $vittorieSquadraFinale;

                $statisticheGenerate[$squadraFinale->id] = [
                    'vittorie' => $vittorieSquadraFinale,
                    'pareggi' => $pareggiSquadraFinale,
                    'sconfitte' => $sconfitteSquadraFinale,
                ];
            }
            // Se non è coerente, il ciclo ripete la generazione

        } while (!$isCoerente);

        // 5. Aggiorna il database con le statistiche generate
        foreach ($squadre as $squadra) {
            $stats = $statisticheGenerate[$squadra->id];
            $squadra->update([
                'partite_giocate' => $partiteGiocate,
                'vittorie' => $stats['vittorie'],
                'pareggi' => $stats['pareggi'],
                'sconfitte' => $stats['sconfitte'],
                'punti' => ($stats['vittorie'] * 3) + $stats['pareggi'],
            ]);
        }

        // Reindirizza alla classifica con messaggio di successo
        return redirect()->route('classifica')->with('success', 'Classifica inizializzata con successo.');
    }

    public function punteggioMedio(){
        $squadre = Squadra::all();
        $risultato = [];
        foreach($squadre as $squadra){
            $punteggioMedio = $squadra->partite_giocate > 0 
                ? $squadra->punti / $squadra->partite_giocate 
                : 0;
            $risultato[] = [
                'nome' => $squadra->nome,
                'punteggioMedio' => round($punteggioMedio, 2)
            ];
        }

        return response()->json($risultato);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(squadra $squadra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(squadra $squadra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, squadra $squadra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(squadra $squadra)
    {
        //
    }
}
