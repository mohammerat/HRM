<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'id', 'name', 'parent_status_id', 'next_status_id', 'role_id'
    ];

    public function demands()
    {
        return $this->hasMany('App\Demand');
    }
}
