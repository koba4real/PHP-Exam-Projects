<?php

namespace App\Http\Controllers;

use App\Models\Transazione;
use App\Http\Requests\StoreTransazioneRequest;
use App\Http\Requests\UpdateTransazioneRequest;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransazioneRequest $request)
    {
        //
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
    public function edit(Transazione $transazione)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransazioneRequest $request, Transazione $transazione)
    {
        //
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
