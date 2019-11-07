<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'personal_number', 'melli_code', 'birthdate', 'user_level', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'created_at', 'updated_at'
    ];

    // protected $appends = ['name'];

    protected $guard_name = 'api';

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'personal_number' => $this->personal_number,
            'role' => $this->roles->pluck('name')
        ];
    }

    // public function getNameAttribute()
    // {
    //     return "{$this->firstname} {$this->lastname}";
    // }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function attendances()
    {
        return $this->hasMany('App\Attendance');
    }

    public function demands()
    {
        return $this->hasMany('App\Demand');
    }

    public function promotions()
    {
        return $this->hasMany('App\Promotion');
    }

    public function additionals()
    {
        return $this->hasMany('App\Additional');
    }
}
