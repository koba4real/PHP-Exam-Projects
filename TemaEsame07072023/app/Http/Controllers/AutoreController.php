<?php

namespace App\Http\Controllers;

use App\Models\autore;
use Illuminate\Http\Request;

class AutoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$autori = autore::orderBy('cognome')->orderBy('nome')->get();
        //return view('autori.index', compact('autori'));
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
    public function show(autore $autore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(autore $autore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, autore $autore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(autore $autore)
    {
        //
    }
}
