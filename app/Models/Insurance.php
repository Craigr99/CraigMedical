<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    // Users that have belong to insurance
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
