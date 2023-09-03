<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddComponentsRequest;
use App\Http\Requests\TurbineRequest;
use App\Models\Component;
use App\Models\Turbine;
use Illuminate\Http\Request;

class TurbineController extends Controller
{

    public function show(Turbine $turbine)
    {
        return response()->json($turbine->load('components'));
    }

    public function index(Request $request)
    {
        $query = Turbine::query();

        // Filter by name if provided
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Pagination
        $turbines = $query->paginate(10);

        return response()->json($turbines);
    }

    public function store(TurbineRequest $request)
    {
        $data = $request->validated();
        $turbine = Turbine::create($data);

        return response()->json([
            'message' => 'Turbine created successfully',
            'data' => $turbine
        ], 201);
    }
    
    public function update(TurbineRequest $request, Turbine $turbine)
    {
        $data = $request->validated();
        $turbine->update($data);
    
        return response()->json([
            'message' => 'Turbine updated successfully',
            'data' => $turbine
        ]);
    }
    
    public function destroy(Turbine $turbine)
    {
        $turbine->delete();

        return response()->json([
            'message' => 'Turbine soft-deleted successfully'
        ]);
    }

    public function addComponents(AddComponentsRequest $request, Turbine $turbine)
    {
        $componentsData = $request->validated()['components'];

        foreach ($componentsData as $componentData) {
            $component = new Component($componentData);
            $turbine->components()->save($component);
        }

        return response()->json([
            'message' => 'Components added successfully',
            'turbine' => $turbine->load('components')
        ]);
    }

}