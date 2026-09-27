<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingCenter;

class TrainingCenterController extends Controller
{
    public function index()
    {
        $trainingCenters = TrainingCenter::included()->filter()->sort()->getOrPaginate();

        return response()->json($trainingCenters);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'location' => 'required|max:255',
        ]);

        $trainingCenter = TrainingCenter::create($request->all());

        return response()->json($trainingCenter);
    }

    public function show($id)
    {
        $trainingCenter = TrainingCenter::included()->findOrFail($id);

        return response()->json($trainingCenter);
    }

    public function update(Request $request, TrainingCenter $trainingCenter)
    {
        $request->validate([
            'name' => 'required|max:255',
            'location' => 'required|max:255',
        ]);

        $trainingCenter->update($request->all());

        return response()->json($trainingCenter);
    }

    public function destroy(TrainingCenter $trainingCenter)
    {
        $trainingCenter->delete();

        return response()->json($trainingCenter);
    }
}