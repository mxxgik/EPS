<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialties extends Model
{
    protected $table = "specialties";

    protected $fillable = [
        'specialty',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
