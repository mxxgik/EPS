<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $table = 'appointments';

    protected $fillable = [
        'patientId',
        'doctorId',
        'appointment_date_time',
        'reason',
        'status'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctors::class, 'doctorId');
    }

    public function patient()
    {
        return $this->belongsTo(Patients::class, 'patientId');
    }
}
