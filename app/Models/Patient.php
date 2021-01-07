<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    // User that belongs to the patient
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // Insurance company that belongs to the patient
    public function insuranceCompany()
    {
        return $this->belongsTo('App\Models\Insurance', 'insurance_id');
    }

    // Vists that a patient has
    public function visit()
    {
        return $this->hasMany('App\Models\Visit');
    }
}
