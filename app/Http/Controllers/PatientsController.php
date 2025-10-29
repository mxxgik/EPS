<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class PatientsController extends Controller
{
    public function index()
    {
        $patients = User::where('role', 'patient')->get();
        return response()->json(['success' => true, 'data' => $patients], 200);
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
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }
        $data = $validator->validated();
        $data['role'] = 'patient';
        $patient = User::create($data);
        return response()->json(['success' => true, 'data' => $patient], 200);
    }

    public function show(Request $request)
    {
        $patient = $request->user();

        if (!$patient || $patient->role !== 'patient') {
            return response()->json(['success' => false, 'message' => 'The patient was not found'], 400);
        }

        return response()->json(['success' => true, 'data' => $patient], 200);
    }

    public function update(Request $request, string $id)
    {

        $patient = User::find($id);

        if (!$patient || $patient->role !== 'patient') {
            return response()->json(['success' => false, 'message' => 'The patient was not found'], 400);
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
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }

        $patient->update($validator->validated());
        return response()->json(['success' => true, 'data' => $patient], 200);

    }

    public function updateSelf(Request $request)
    {
        $patient = $request->user();

        if (!$patient || $patient->role !== 'patient') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string',
            'last_name' => 'sometimes|string',
            'identification' => 'sometimes|string',
            'dob' => 'sometimes|date',
            'genero' => 'sometimes|in:M,F',
            'phone' => 'sometimes|string',
            'email' => 'sometimes|string|email|unique:users,email,' . $patient->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }

        $patient->update($validator->validated());
        return response()->json(['success' => true, 'data' => $patient], 200);
    }

    public function destroy(string $id)
    {
        $patient = User::where('id', $id)->where('role', 'patient')->first();

        if (!$patient) {
            return response()->json(['success' => false, 'message' => 'The patient was not found'], 400);
        }
        $patient->delete();
        return response()->json(['success' => true, 'message' => 'The patient was deleted successfully'], 200);

    }

    public function listFemalePatients(){
        $femalePatients = User::where('role', 'patient')->where('genero','F')->get();
        return response()->json(['success' => true, 'data' => $femalePatients],200);
    }

    public function listMalePatients(){
        $malePatients = User::where('role', 'patient')->where('genero','M')->get();
        return response()->json(['success' => true, 'data' => $malePatients],200);
    }
}
