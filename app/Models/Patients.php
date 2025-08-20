<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    protected $table = 'patients';

    protected $fillable = [
        'first_name',
        'last_name',
        'identification',
        'dob',
        'gender',
        'phone',
        'email',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointments::class, 'patientId');
    }

    
}
