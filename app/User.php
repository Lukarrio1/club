<?php

namespace App;

use App\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'telephone', 'age', 'parish', 'trn', 'gender', 'club_id', 'position',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->hasMany('App\Role', 'user_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification', 're_id', 'id');
    }

    public function club()
    {
        return $this->belongsTo('App\User', 'club_id', 'id');
    }

}
