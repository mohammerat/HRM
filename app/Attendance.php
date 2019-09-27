<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'id', 'user_id', 'start_hour', 'end_hour', 'works_mins'
    ];

    protected $hidden = ['updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
