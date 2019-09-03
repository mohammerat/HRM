<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    protected $fillable = [
        'id', 'user_id', 'message', 'status_id', 'subject'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function status()
    {
        return $this->belongsTo('App\Status', 'status_id');
    }

    public function dismissal()
    {
        return $this->hasOne('App\Dismissal', 'demand_id');
    }
}
