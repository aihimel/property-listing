<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\StructureType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StructureTypeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => StructureType::all()
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json([
            'data' => StructureType::create($request->all())
        ], 201);
    }

    public function update(Request $request, StructureType $structureType): JsonResponse
    {
        return response()->json([
            'data' => tap($structureType)->update($request->all())
        ]);
    }

    public function delete(Request $request, StructureType $structureType)
    {
        $structureType->delete();
        return response()->json([], 204);
    }
}
