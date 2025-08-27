<?php

namespace App\Http\Controllers;

use App\Models\attivita;
use App\Http\Requests\StoreattivitaRequest;
use App\Http\Requests\UpdateattivitaRequest;

class AttivitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attivita = attivita::all();
        return view('tasks', compact('attivita'));
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
    public function store(StoreattivitaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(attivita $attivita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(attivita $attivita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateattivitaRequest $request, attivita $attivita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(attivita $attivita)
    {
        //
    }
}
