<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $first = Student::orderBy('id')->first();

        return view('student', [
            'studente' => $first,
            'is_first' => true,
            'is_last' => Student::orderBy('id', 'desc')->first()->id === $first->id,
        ]);
    }

    public function show($id)
    {
        $studente = Student::findOrFail($id);

        $isFirst = (Student::orderBy('id')->first()->id === $studente->id);
        $isLast  = (Student::orderBy('id', 'desc')->first()->id === $studente->id);

        return response()->json([
            'html' => view('record_detail', [
                'studente' => $studente,
                'is_first' => $isFirst,
                'is_last'  => $isLast,
            ])->render(),
            'current_id' => $studente->id,
            'is_first'   => $isFirst,
            'is_last'    => $isLast,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
