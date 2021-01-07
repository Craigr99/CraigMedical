<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Users that belong to the roles
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_role'); // user_role is the table name
    }
}
