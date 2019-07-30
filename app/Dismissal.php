<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dismissal extends Model
{
    public function demand()
    {
        return $this->hasOne('App\Demand');
    }
}
