<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    public function index(){
        $Doctors = Doctors::all();
        return response()->json($Doctors, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'specialty' => 'required|string',
            'identification' => 'required|string',
            'gender' => 'required',
            'phone' => 'required|string',
            'email' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $doctor = Doctors::create($validator->validated());
        return response()->json($doctor, 200);
    }

    public function show(string $id)
    {
        $doctor = Doctors::find($id);

        if (!$doctor) {
            return response()->json(['message' => 'The doctor was not found'], 400);
        }

        return response()->json($doctor, 200);
    }

    public function update(Request $request, string $id)
    {
        $doctor = Doctors::find($id);

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'specialty' => 'required|string',
            'identification' => 'required|string',
            'gender' => 'required',
            'phone' => 'required|string',
            'email' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $doctor -> update($validator->validated());
        return response()->json($doctor, 200);

    }

    public function destroy(string $id)
    {
        $doctor = Doctors::find($id);

        if (!$doctor) {
            return response()->json(['message' => 'The doctor was not found'], 400);
        }
        $doctor->delete();
        return response()->json(['message' => 'The doctor was deleted successfully'], 400);

    }

    public function listFemaleDoctors(){
        $femaleDoctors = Doctors::where('gender','F')->get();
        return response()->json($femaleDoctors,200);
    }

    public function listMaleDoctors(){
        $maleDoctors = Doctors::where('gender','M')->get();
        return response()->json($maleDoctors,200);
    }

    
}
