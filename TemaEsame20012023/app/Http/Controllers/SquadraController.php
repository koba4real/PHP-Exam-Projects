<?php

namespace App\Http\Controllers;

use App\Models\squadra;
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
