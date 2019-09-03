<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'id', 'pay_amount', 'insurance', 'tax', 'penalty', 'reward', 'other', 'role_id', 'work_hour_id'
    ];

    public function workHour()
    {
        return $this->belongsTo('App\WorkHour', 'work_hour_id');
    }
}
