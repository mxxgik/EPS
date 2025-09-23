<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class PatientsController extends Controller
{
    public function index()
    {
        $patients = User::where('role', 'patient')->get();
        return response()->json($patients, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'entity_id' => 'required|numeric',
            'name' => 'required|string',
            'last_name' => 'required|string',
            'identification' => 'required|string',
            'dob' => 'required|date',
            'genero' => 'required',
            'phone' => 'required|string',
            'email' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $data = $validator->validated();
        $data['role'] = 'patient';
        $patient = User::create($data);
        return response()->json($patient, 200);
    }

    public function show(Request $request)
    {
        $patient = $request->user();

        if (!$patient || $patient->role !== 'patient') {
            return response()->json(['message' => 'The patient was not found'], 400);
        }

        return response()->json($patient, 200);
    }

    public function update(Request $request, string $id)
    {

        $patient = $request->user();

        if (!$patient || $patient->role !== 'patient') {
            return response()->json(['message' => 'The patient was not found'], 400);
        }

        $validator = Validator::make($request->all(), [
            'entity_id' => 'required|numeric',
            'name' => 'required|string',
            'last_name' => 'required|string',
            'identification' => 'required|string',
            'dob' => 'required|date',
            'genero' => 'required',
            'phone' => 'required|string',
            'email' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $patient->update($validator->validated());
        return response()->json($patient, 200);

    }

    public function destroy(string $id)
    {
        $patient = User::where('id', $id)->where('role', 'patient')->first();

        if (!$patient) {
            return response()->json(['message' => 'The patient was not found'], 400);
        }
        $patient->delete();
        return response()->json(['message' => 'The patient was deleted successfully'], 200);

    }

    public function listFemalePatients(){
        $femalePatients = User::where('role', 'patient')->where('genero','F')->get();
        return response()->json($femalePatients,200);
    }

    public function listMalePatients(){
        $malePatients = User::where('role', 'patient')->where('genero','M')->get();
        return response()->json($malePatients,200);
    }
}
