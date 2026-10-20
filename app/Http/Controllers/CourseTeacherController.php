<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseTeacher;

class CourseTeacherController extends Controller
{
    public function index()
    {
        $courseTeachers = CourseTeacher::included()->filter()->sort()->getOrPaginate();

        return response()->json($courseTeachers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|integer|exists:courses,id',
            'teacher_id' => 'required|integer|exists:teachers,id',
        ]);

        $courseTeacher = CourseTeacher::create($request->all());

        return response()->json($courseTeacher);
    }

    public function show($id)
    {
        $courseTeacher = CourseTeacher::included()->findOrFail($id);

        return response()->json($courseTeacher);
    }

    public function update(Request $request, CourseTeacher $courseTeacher)
    {
        $request->validate([
            'course_id' => 'required|integer|exists:courses,id',
            'teacher_id' => 'required|integer|exists:teachers,id',
        ]);

        $courseTeacher->update($request->all());

        return response()->json($courseTeacher);
    }

    public function destroy(CourseTeacher $courseTeacher)
    {
        $courseTeacher->delete();

        return response()->json($courseTeacher);
    }
}
