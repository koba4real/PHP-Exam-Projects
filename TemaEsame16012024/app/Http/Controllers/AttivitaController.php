<?php

namespace App\Http\Controllers;

use App\Models\attivita;
use App\Http\Requests\StoreattivitaRequest;
use App\Http\Requests\UpdateattivitaRequest;
use Illuminate\Http\Request;

class AttivitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attivita = attivita::all();
        return view('tasks.index', compact('attivita'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titolo' => 'required|string|max:255',
            'descrizione' => 'required|string|max:1000',
            'completato' => 'required|boolean',
        ]);

        attivita::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Attività aggiunta con successo!');;
    }

  

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $attivita = attivita::findOrFail($id);
        $attivita->completato = !$attivita->completato;
        $attivita->save();

        return redirect()->route('tasks.index')->with('success', 'Stato dell\'attività aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $attivita = attivita::findOrFail($id);
        $attivita->delete();
        return redirect()->route('tasks.index')->with('success', 'Attività eliminata con successo!');   
    }
}
