<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    // User that belongs to the doctor
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    // Visits that a doctor has
    public function visit()
    {
        return $this->hasMany('App\Models\Visit');
    }
}
