<?php

namespace App\Http\Controllers;

use App\Models\articolo;
use Illuminate\Http\Request;

class ArticoloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
      
        $articoli = articolo::with(['autori' => function ($query) {
            $query->orderBy('cognome')->orderBy('nome');
        }])->orderBy('id', 'asc')->get();
        return view('articoli.index', compact('articoli'));
    }

    public function getAuthorsDetails(Articolo $articolo)
    {
        // Carica gli autori per l'articolo dato, ordinandoli
        $autori = $articolo->autori()->orderBy('cognome')->orderBy('nome')->get();

        // Restituisci i dati come risposta JSON
        return response()->json($autori);
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
    public function show(articolo $articolo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(articolo $articolo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, articolo $articolo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(articolo $articolo)
    {
        //
    }
}
