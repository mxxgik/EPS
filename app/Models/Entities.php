<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entities extends Model
{
    protected $table = "entities";

    protected $fillable = [
        'name',
        'code',
    ];

    public function patients()
    {
        return $this->hasMany(Patients::class);
    }
}
