<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::included()->filter()->sort()->getOrPaginate();

        return response()->json($courses);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_number' => 'required|max:255',
            'day' => 'required|max:255',
            'area_id' => 'required|integer|exists:areas,id',
            'training_center_id' => 'required|integer|exists:training_centers,id',
        ]);

        $course = Course::create($request->all());

        return response()->json($course);
    }

    public function show($id)
    {
        $course = Course::included()->findOrFail($id);

        return response()->json($course);
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_number' => 'required|max:255',
            'day' => 'required|max:255',
            'area_id' => 'required|integer|exists:areas,id',
            'training_center_id' => 'required|integer|exists:training_centers,id',
        ]);

        $course->update($request->all());

        return response()->json($course);
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return response()->json($course);
    }
}
