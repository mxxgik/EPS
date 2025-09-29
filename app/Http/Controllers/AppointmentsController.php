<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index()
    {
        $Appointments = Appointments::with('user', 'patient')->get();
        return response()->json(['success' => true, 'data' => $Appointments], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_user_id'=>'required',
            'user_id'=>'required',
            'appointment_date_time'=>'required',
            'reason'=>'required',
            'status'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }
        $appointment = Appointments::create($validator->validated());
        return response()->json(['success' => true, 'data' => $appointment], 200);
    }

    public function show(string $id)
    {
        $appointment = Appointments::find($id);

        if (!$appointment) {
            return response()->json(['success' => false, 'message' => 'The appointment was not found'], 400);
        }

        return response()->json(['success' => true, 'data' => $appointment], 200);
    }

    public function update(Request $request, string $id)
    {
        $appointment = Appointments::find($id);

        $validator = Validator::make($request->all(), [
            'patient_user_id'=>'required',
            'user_id'=>'required',
            'appointment_date_time'=>'required',
            'reason'=>'required',
            'status'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }

        $appointment -> update($validator->validated());
        return response()->json(['success' => true, 'data' => $appointment], 200);

    }

    public function destroy(string $id)
    {
        $appointment = Appointments::find($id);

        if (!$appointment) {
            return response()->json(['success' => false, 'message' => 'The appointment was not found'], 400);
        }
        $appointment->delete();
        return response()->json(['success' => true, 'message' => 'The appointment was deleted successfully'], 200);

    }

    public function listScheduledAppointments(){
        $scheduledAppointments = Appointments::where('status','scheduled')->orderBy('created_at','desc')->get();
        return response()->json(['success' => true, 'data' => $scheduledAppointments],200);
    }
}
