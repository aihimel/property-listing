<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyGroupRequest;
use App\Models\PropertyGroup;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PropertyGroupController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => PropertyGroup::all()]);
    }

    public function store(PropertyGroupRequest $request): JsonResponse
    {
        return response()->json([
            'data' => PropertyGroup::create($request->all()),
        ], 201);
    }

    public function update(Request $request, PropertyGroup $propertyGroup): JsonResponse
    {
        return response()->json([
            'data' => tap($propertyGroup)->update($request->all())
        ]);
    }

    public function delete(PropertyGroup $propertyGroup): JsonResponse
    {
        $propertyGroup->delete();
        return response()->json([], 204);
    }
}
