<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Patients;

class PatientsController extends Controller
{
    public function index()
    {
        $Patients = Patients::all();
        return response()->json($Patients, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'entity_id' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'identification' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required',
            'phone' => 'required|string',
            'email' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $patient = Patients::create($validator->validated());
        return response()->json($patient, 200);
    }

    public function show(string $id)
    {
        $patient = Patients::find($id);

        if (!$patient) {
            return response()->json(['message' => 'The patient was not found'], 400);
        }

        return response()->json($patient, 200);
    }

    public function update(Request $request, string $id)
    {
        $patient = Patients::find($id);

        $validator = Validator::make($request->all(), [
            'entity_id' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'identification' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required',
            'phone' => 'required|string',
            'email' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $patient -> update($validator->validated());
        return response()->json($patient, 200);

    }

    public function destroy(string $id)
    {
        $patient = Patients::find($id);

        if (!$patient) {
            return response()->json(['message' => 'The patient was not found'], 400);
        }
        $patient->delete();
        return response()->json(['message' => 'The patient was deleted successfully'], 400);

    }

    public function listFemalePatients(){
        $femalePatients = Patients::where('gender','F')->get();
        return response()->json($femalePatients,200);
    }

    public function listMalePatients(){
        $malePatients = Patients::where('gender','M')->get();
        return response()->json($malePatients,200);
    }
}
