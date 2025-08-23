<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    protected $table = 'doctors';

    protected $fillable = [
        'first_name',
        'last_name',
        'specialty_id',
        'identification',
        'gender',
        'phone',
        'email',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointments::class, 'doctorId');
    }

    public function specialty()
    {
        return $this->belongsTo(Specialties::class);
    }
}
