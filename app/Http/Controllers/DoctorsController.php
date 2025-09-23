<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    public function index(){
        $doctors = User::where('role', 'doctor')->get();
        return response()->json($doctors, 200);
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
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $data = $validator->validated();
        $data['role'] = 'doctor';
        $doctor = User::create($data);
        return response()->json($doctor, 200);
    }

    public function show(string $id)
    {
        $doctor = User::where('id', $id)->where('role', 'doctor')->first();

        if (!$doctor) {
            return response()->json(['message' => 'The doctor was not found'], 400);
        }

        return response()->json($doctor, 200);
    }

    public function update(Request $request, string $id)
    {
        $doctor = User::where('id', $id)->where('role', 'doctor')->first();

        if (!$doctor) {
            return response()->json(['message' => 'The doctor was not found'], 400);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'specialty_id' => 'required|numeric',
            'identification' => 'required|string',
            'genero' => 'required',
            'phone' => 'required|string',
            'email' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $doctor->update($validator->validated());
        return response()->json($doctor, 200);

    }

    public function destroy(string $id)
    {
        $doctor = User::where('id', $id)->where('role', 'doctor')->first();

        if (!$doctor) {
            return response()->json(['message' => 'The doctor was not found'], 400);
        }
        $doctor->delete();
        return response()->json(['message' => 'The doctor was deleted successfully'], 200);

    }

    public function listFemaleDoctors(){
        $femaleDoctors = User::where('role', 'doctor')->where('genero','F')->get();
        return response()->json($femaleDoctors,200);
    }

    public function listMaleDoctors(){
        $maleDoctors = User::where('role', 'doctor')->where('genero','M')->get();
        return response()->json($maleDoctors,200);
    }

    
}
