<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\areas;
use Cloudinary\Cloudinary;

class AreasController extends Controller
{
    public function create()
    {
        return view('areas.create');
    }

    public function index()
    {
        $areas = areas::included()->filter()->sort()->getOrPaginate();

        return response()->json($areas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'imagen' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $file = $request->file('imagen');

        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key' => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret'),
            ],
            'url' => ['secure' => true],
        ]);

        $resultado = $cloudinary->uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder' => 'categories',
                'resource_type' => 'image',
            ]
        );

        $area = areas::create([
            'name' => $request->name,
            'imagen_url' => $resultado['secure_url'],
            'imagen_public_id' => $resultado['public_id'],
        ]);

        if ($request->routeIs('web.areas.store')) {
            return redirect()
                ->route('web.areas.create')
                ->with('createdArea', $area);
        }

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