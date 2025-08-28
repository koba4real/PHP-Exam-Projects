<?php

namespace App\Http\Controllers;

use App\Models\Transazione;
use App\Http\Requests\StoreTransazioneRequest;
use App\Http\Requests\UpdateTransazioneRequest;
use Illuminate\Http\Request;

class TransazioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transazioni = Transazione::all();
        return view('transazioni.index', compact('transazioni'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transazioni.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'descrizione' => 'required|string|max:255',
            'importo' => 'required|numeric',
            'data' => 'required|date',
            'tipo' => 'required|in:Entrata,spesa',
        ]);

        Transazione::create($validated);

        return redirect()->route('transazioni.index')->with('success', 'Transazione creata con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transazione $transazione)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) // Changed back to $id to manually find
    {
        $transazione = Transazione::findOrFail($id); // Find even soft-deleted
        return view('transazioni.update', compact('transazione'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'descrizione' => 'required|string|max:255',
            'importo' => 'required|numeric',
            'data' => 'required|date',
            'tipo' => 'required|in:Entrata,spesa',
        ]);

        $transazione = Transazione::findOrFail($id);
        $transazione->update($validated);

        return redirect()->route('transazioni.index')->with('success', 'Transazione aggiornata con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transazione = Transazione::findOrFail($id);
        $transazione->delete();
        return redirect()->route('transazioni.index')->with('success', 'Transazione eliminata con successo.');
    }
}
