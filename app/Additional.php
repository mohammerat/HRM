<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    protected $fillable = [
        'amount', 'user_id', 'type'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
