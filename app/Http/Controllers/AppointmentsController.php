<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index()
    {
        $Appointments = Appointments::all();
        return response()->json($Appointments, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patientId'=>'required',
            'doctorId'=>'required',
            'appointment_date_time'=>'required',
            'reason'=>'required',
            'status'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $appointment = Appointments::create($validator->validated());
        return response()->json($appointment, 200);
    }

    public function show(string $id)
    {
        $appointment = Appointments::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'The appointment was not found'], 400);
        }

        return response()->json($appointment, 200);
    }

    public function update(Request $request, string $id)
    {
        $appointment = Appointments::find($id);

        $validator = Validator::make($request->all(), [
            'patientId'=>'required',
            'doctorId'=>'required',
            'appointment_date_time'=>'required',
            'reason'=>'required',
            'status'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $appointment -> update($validator->validated());
        return response()->json($appointment, 200);

    }

    public function destroy(string $id)
    {
        $appointment = Appointments::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'The appointment was not found'], 400);
        }
        $appointment->delete();
        return response()->json(['message' => 'The appointment was deleted successfully'], 400);

    }
}
