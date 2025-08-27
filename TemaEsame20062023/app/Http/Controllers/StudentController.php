<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    

    public function index()
    {
        $first = Student::orderBy('id')->first();

        return view('student', [
            'student' => $first,
            'is_first' => true,
            'is_last' => Student::orderBy('id', 'desc')->first()->id === $first->id,
        ]);
    }

    public function show($id){
        $student = Student::find($id);
        if (!$student) {
            abort(404);
        }

        $is_first = $student->id === Student::orderBy('id')->first()->id;
        $is_last = $student->id === Student::orderBy('id', 'desc')->first()->id;

        return response()->json([
            'html' => view('record_detail', [
                'studente' => $student,
                'is_first' => $is_first,
                'is_last' => $is_last,
            ])->render(),
            'student' => $student,
            'is_first' => $is_first,
            'is_last' => $is_last,
        ]);
    }
    public function update(Request $request, $id)
    {
        $studente = Student::findOrFail($id);

        $validated = $request->validate([
            'data_appello' => 'required|date',
            'matricola'    => 'required|numeric',
            'cognome'      => 'required|string|max:100',
            'nome'         => 'required|string|max:100',
            'voto'         => 'required|integer',
        ]);

        $studente->update([
            'data_appello' => $request->data_appello,
            'matricola' => $request->matricola,
            'cognome' => $request->cognome,
            'nome' => $request->nome,
            'voto' => $request->voto
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Record aggiornato con successo',
            'student' => $studente
        ]);
    }




 
    
}
