<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lucidi;
use App\Http\Requests\StorelucidiRequest;
use App\Http\Requests\UpdatelucidiRequest;
use Illuminate\Support\Facades\Storage;

class LucidiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lucidis = lucidi::all();
        return view('lucidis.index', compact('lucidis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lucidis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titolo' => 'required|string|max:255',
            'file_path' => 'required|file|mimes:pdf|max:2048',
            'commento' => 'nullable|string|max:1000',
        ]);

        $lucido = new lucidi();
        $lucido->titolo = $validated['titolo'];
        $lucido->file_path = $validated['file_path']->store('lucidi');
        $lucido->commento = $validated['commento'];
        $lucido->is_public = $request->has('pubblico') ? 1: 0;

        $lucido->save();

        return redirect()->route('lucidis.index')->with('success', 'Lucido creato con successo.');
    }

    

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $lucidis = lucidi::all();
        return view('lucidis.show', compact('lucidis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lucidi $lucidi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatelucidiRequest $request, lucidi $lucidi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lucido = lucidi::findOrFail($id);
        Storage::delete($lucido->file_path);
        $lucido->delete();
        return redirect()->route('lucidis.index')->with('success', 'Lucido eliminato con successo.');
    }
}
