<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $fillable = [
        're_id', 'class', 'icon', 'notify', 'ref_id', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 're_id');
    }
}
