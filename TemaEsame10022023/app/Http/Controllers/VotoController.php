<?php

namespace App\Http\Controllers;

use App\Models\Voto;
use Illuminate\Http\Request;

class VotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $voti = Voto::all();
        $votiStudentiPassati = $voti->where('voto', '>=', 18);

        $stats=[
            'totale'=>$voti->count(),
            'voto_medio'=>$votiStudentiPassati->avg('voto') ??0,
            'perc_sufficienti'=>($voti->count() > 0) ? $votiStudentiPassati->count() / $voti->count() * 100 : 0,
            'max' => $votiStudentiPassati->max('voto') ?? 'N/A',
            'min' => $votiStudentiPassati->min('voto') ?? 'N/A',
        ];
        

        return view('voti', compact('stats'));
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
        $request->validate([
            'nome' => ['required', 'string', 'max:255', 'not_regex:[0-9]'],
            'cognome' => ['required', 'string', 'max:255', 'not_regex:[0-9]'],
            'matricola' => 'required|integer|unique:votos,matricola|min:1',
            'voto' => ['required',function($string,$value,$fail){
                if(strtolower($value)!=='insufficiente'&& !is_numeric($value)){
                    $fail('Il voto deve essere un numero oppure scrivere:insufficiente ');
                }
                if(is_numeric($value) && ($value < 0 || $value > 30)){
                    $fail('Il voto deve essere compreso tra 0 e 30');
                }
            }],
            'lode' => 'sometimes|boolean',
            'data_esame' => 'required|date',
            'commento' => 'nullable|string',
        ]);
        $votonumerico=0;
        if(is_numeric($request->input('voto'))){
            $votonumerico=(int)$request->input('voto');
        }
        if($request->filled('lode')){
            if($votonumerico===30){
                $votonumerico=31;
            }else{
                return back()->withErrors(['lode'=>'La lode può essere assegnata solo con voto 30'])->withInput();
            }
        }
        if($votonumerico>=18){
            $votoGiaesiste=Voto::where('matricola', $request->input('matricola'))
                                ->where('voto', '>', 18)->exists();
            if($votoGiaesiste){
                return back()->withErrors(['matricola'=>'Uno studente può avere un solo voto superiore a 18'])->withInput();
            }
        }

        Voto::create([
            'nome' => $request->input('nome'),
            'cognome' => $request->input('cognome'),
            'matricola' => $request->input('matricola'),
            'voto' => $votonumerico,
            'lode' => $request->filled('lode'),
            'data_esame' => $request->input('data_esame'),
            'commento' => $request->input('commento'),
        ]);

        return redirect()->route('voti.index')->with('success', 'Voto aggiunto con successo');
    }

    /**
     * Cancella tutti i voti dal database.
     */
    public function destroyAll()
    {
        Voto::truncate();
        return redirect()->route('voti.index')->with('success', 'Tutti i voti sono stati cancellati.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Voto $voto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voto $voto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voto $voto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voto $voto)
    {
        //
    }
}
