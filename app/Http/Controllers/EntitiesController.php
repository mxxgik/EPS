<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Entities;

class EntitiesController extends Controller
{
    public function index()
    {
        $Entities = Entities::all();
        return response()->json(['success' => true, 'data' => $Entities], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'code' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }
        $entity = Entities::create($validator->validated());
        return response()->json(['success' => true, 'data' => $entity], 200);
    }

    public function show(string $id)
    {
        $entity = Entities::find($id);

        if (!$entity) {
            return response()->json(['success' => false, 'message' => 'The entity was not found'], 400);
        }

        return response()->json(['success' => true, 'data' => $entity], 200);
    }

    public function update(Request $request, string $id)
    {
        $entity = Entities::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'code' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }

        $entity->update($validator->validated());
        return response()->json(['success' => true, 'data' => $entity], 200);

    }

    public function destroy(string $id)
    {
        $entity = Entities::find($id);

        if (!$entity) {
            return response()->json(['success' => false, 'message' => 'The entity was not found'], 400);
        }
        $entity->delete();
        return response()->json(['success' => true, 'message' => 'The entity was deleted successfully'], 200);

    }

    public function listFemalePatients()
    {
        $femalePatients = Entities::where('gender', 'F')->get();
        return response()->json(['success' => true, 'data' => $femalePatients], 200);
    }

    public function listMalePatients()
    {
        $malePatients = Entities::where('gender', 'M')->get();
        return response()->json(['success' => true, 'data' => $malePatients], 200);
    }
}
