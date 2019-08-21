<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function dismissal()
    {
        return $this->hasOne('App\Dismissal');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
