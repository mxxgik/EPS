<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    protected $table = 'patients';

    protected $fillable = [
        'entity_id',
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

    public function entity()
    {
        return $this->belongsTo(Entities::class);
    }

    
}
