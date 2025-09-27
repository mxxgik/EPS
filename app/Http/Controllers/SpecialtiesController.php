<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Specialties;


class SpecialtiesController extends Controller
{
    public function index()
    {
        $Specialties = Specialties::all();
        return response()->json(['success' => true, 'data' => $Specialties], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'specialty' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }
        $specialty = Specialties::create($validator->validated());
        return response()->json(['success' => true, 'data' => $specialty], 200);
    }

    public function show(string $id)
    {
        $specialty = Specialties::find($id);

        if (!$specialty) {
            return response()->json(['success' => false, 'message' => 'The specialty was not found'], 400);
        }

        return response()->json(['success' => true, 'data' => $specialty], 200);
    }

    public function update(Request $request, string $id)
    {
        $specialty = Specialties::find($id);

        $validator = Validator::make($request->all(), [
            'specialty' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }

        $specialty -> update($validator->validated());
        return response()->json(['success' => true, 'data' => $specialty], 200);

    }

    public function destroy(string $id)
    {
        $specialty = Specialties::find($id);

        if (!$specialty) {
            return response()->json(['success' => false, 'message' => 'The specialty was not found'], 400);
        }
        $specialty->delete();
        return response()->json(['success' => true, 'message' => 'The specialty was deleted successfully'], 200);

    }

    public function listFemalePatients(){
        $femalePatients = Specialties::where('gender','F')->get();
        return response()->json(['success' => true, 'data' => $femalePatients],200);
    }

    public function listMalePatients(){
        $malePatients = Specialties::where('gender','M')->get();
        return response()->json(['success' => true, 'data' => $malePatients],200);
    }
}
