<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkHour extends Model
{
    protected $fillable = [
        'id', 'start_hour', 'end_hour', 'max_overtime_hour', 'promotions_hour'
    ];

    public function salary()
    {
        return $this->hasOne('App\Salary', 'work_hour_id');
    }
}
