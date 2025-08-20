<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    protected $table = 'doctors';

    protected $fillable = [
        'first_name',
        'last_name',
        'specialty',
        'identification',
        'gender',
        'phone',
        'email',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointments::class, 'doctorId');
    }
}
