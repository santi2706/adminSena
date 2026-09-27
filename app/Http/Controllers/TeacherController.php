<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::included()->filter()->sort()->getOrPaginate();

        return response()->json($teachers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:teachers,email',
            'area_id' => 'required|integer|exists:areas,id',
            'training_center_id' => 'required|integer|exists:training_centers,id',
        ]);

        $teacher = Teacher::create($request->all());

        return response()->json($teacher);
    }

    public function show($id)
    {
        $teacher = Teacher::included()->findOrFail($id);

        return response()->json($teacher);
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:teachers,email,' . $teacher->id,
            'area_id' => 'required|integer|exists:areas,id',
            'training_center_id' => 'required|integer|exists:training_centers,id',
        ]);

        $teacher->update($request->all());

        return response()->json($teacher);
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return response()->json($teacher);
    }
}