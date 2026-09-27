<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\areas;

class AreasController extends Controller
{
    public function index()
    {
        $areas = areas::included()->filter()->sort()->getOrPaginate();

        return response()->json($areas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $area = areas::create($request->all());

        return response()->json($area);
    }

    public function show($id)
    {
        $area = areas::included()->findOrFail($id);

        return response()->json($area);
    }

    public function update(Request $request, areas $area)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $area->update($request->all());

        return response()->json($area);
    }

    public function destroy(areas $area)
    {
        $area->delete();

        return response()->json($area);
    }
}