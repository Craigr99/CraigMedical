<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'f_name',
        'l_name',
        'email',
        'postal_address',
        'phone_num',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the doctor record associated with the user.
     */
    public function doctor()
    {
        return $this->hasOne('App\Models\Doctor');
    }

    /**
     * Get the patient record associated with the user.
     */

    public function patient()
    {
        return $this->hasOne('App\Models\Patient');
    }

    /**
     * Get the roles that a user has.
     */

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_role');
    }

    // Check if a user has roles
    public function authorizeRoles($roles)
    {
        // if > 1 role passed in
        if (is_array($roles)) {
            return $this->hasAnyRole($roles);
        }
        return $this->hasRole($roles);
    }

    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }
}
