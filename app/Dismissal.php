<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dismissal extends Model
{
    protected $table = 'dismissal_hours';

    protected $fillable = [
        'id', 'start_hour', 'end_hour', 'demand_id'
    ];

    public function demand()
    {
        return $this->belongsTo('App\Demand', 'demand_id');
    }
}
