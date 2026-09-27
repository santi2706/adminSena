<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apprentice;

class ApprenticeController extends Controller
{
    public function index()
    {
        $apprentices = Apprentice::included()->filter()->sort()->getOrPaginate();

        return response()->json($apprentices);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:apprentices,email',
            'cell_number' => 'required|max:255',
            'course_id' => 'required|integer|exists:courses,id',
            'computer_id' => 'required|integer|exists:computers,id',
        ]);

        $apprentice = Apprentice::create($request->all());

        return response()->json($apprentice);
    }

    public function show($id)
    {
        $apprentice = Apprentice::included()->findOrFail($id);

        return response()->json($apprentice);
    }

    public function update(Request $request, Apprentice $apprentice)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:apprentices,email,' . $apprentice->id,
            'cell_number' => 'required|max:255',
            'course_id' => 'required|integer|exists:courses,id',
            'computer_id' => 'required|integer|exists:computers,id',
        ]);

        $apprentice->update($request->all());

        return response()->json($apprentice);
    }

    public function destroy(Apprentice $apprentice)
    {
        $apprentice->delete();

        return response()->json($apprentice);
    }
}