<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{


    public function demands()
    {
        return $this->hasMany('App\Demand');
    }
}
