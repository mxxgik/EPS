<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    public function index(){
        $doctors = User::where('role', 'doctor')->get();
        return response()->json(['success' => true, 'data' => $doctors], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'specialty_id' => 'required|integer',
            'identification' => 'required|string',
            'genero' => 'required',
            'phone' => 'required|string',
            'email' => 'required|string',
            'dob' => 'sometimes|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }
        $data = $validator->validated();
        $data['role'] = 'doctor';
        $doctor = User::create($data);
        return response()->json(['success' => true, 'data' => $doctor], 200);
    }

    public function show(string $id)
    {
        $doctor = User::where('id', $id)->where('role', 'doctor')->first();

        if (!$doctor) {
            return response()->json(['success' => false, 'message' => 'The doctor was not found'], 400);
        }

        return response()->json(['success' => true, 'data' => $doctor], 200);
    }

    public function update(Request $request, string $id)
    {
        $doctor = User::where('id', $id)->where('role', 'doctor')->first();

        if (!$doctor) {
            return response()->json(['success' => false, 'message' => 'The doctor was not found'], 400);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'specialty_id' => 'required|numeric',
            'identification' => 'required|string',
            'genero' => 'required',
            'phone' => 'required|string',
            'email' => 'required|string',
            'dob' => 'sometimes|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }

        $doctor->update($validator->validated());
        return response()->json(['success' => true, 'data' => $doctor], 200);

    }

    public function updateSelf(Request $request)
    {
        $doctor = $request->user();

        if (!$doctor || $doctor->role !== 'doctor') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string',
            'last_name' => 'sometimes|string',
            'identification' => 'sometimes|string',
            'genero' => 'sometimes|in:M,F',
            'phone' => 'sometimes|string',
            'email' => 'sometimes|string|email|unique:users,email,' . $doctor->id,
            'dob' => 'sometimes|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }

        $doctor->update($validator->validated());
        return response()->json(['success' => true, 'data' => $doctor], 200);
    }

    public function destroy(string $id)
    {
        $doctor = User::where('id', $id)->where('role', 'doctor')->first();

        if (!$doctor) {
            return response()->json(['success' => false, 'message' => 'The doctor was not found'], 400);
        }
        $doctor->delete();
        return response()->json(['success' => true, 'message' => 'The doctor was deleted successfully'], 200);

    }

    public function listFemaleDoctors(){
        $femaleDoctors = User::where('role', 'doctor')->where('genero','F')->get();
        return response()->json(['success' => true, 'data' => $femaleDoctors],200);
    }

    public function listMaleDoctors(){
        $maleDoctors = User::where('role', 'doctor')->where('genero','M')->get();
        return response()->json(['success' => true, 'data' => $maleDoctors],200);
    }

    
}
