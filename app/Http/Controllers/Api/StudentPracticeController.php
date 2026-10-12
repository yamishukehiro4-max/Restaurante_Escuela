<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentPractice;
use Illuminate\Http\Request;

class StudentPracticeController extends Controller
{
    public function index()
    {
        return response()->json(StudentPractice::with('user')->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'       => 'required|exists:users,id',
            'practice_date' => 'required|date',
            'start_time'    => 'required',
            'end_time'      => 'nullable',
            'area'          => 'required|string|max:100',
            'hours'         => 'integer|min:0',
            'activities'    => 'nullable|string',
            'observations'  => 'nullable|string',
        ]);
        return response()->json(StudentPractice::create($data)->load('user'), 201);
    }

    public function show(StudentPractice $studentPractice)
    {
        return response()->json($studentPractice->load('user'), 200);
    }

    public function update(Request $request, StudentPractice $studentPractice)
    {
        $data = $request->validate([
            'end_time'     => 'nullable',
            'hours'        => 'integer|min:0',
            'activities'   => 'nullable|string',
            'observations' => 'nullable|string',
        ]);
        $studentPractice->update($data);
        return response()->json($studentPractice, 200);
    }

    public function destroy(StudentPractice $studentPractice)
    {
        $studentPractice->delete();
        return response()->json(['message' => 'Práctica eliminada'], 200);
    }
}