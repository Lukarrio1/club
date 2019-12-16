<?php

namespace App;

use App\Role;
use App\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

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

    public function leader()
    {
        $user = User::find(Auth::user()->id);
        $roles = Role::where('user_id', $user->id)->get();
        $just_role = array();
        foreach ($roles as $role) {
            $just_role[] = [$role->role];
        }
        if (in_array('leader', $just_role)) {
            return 1;
        } else {
            return redirect()->back();
        }
    }

}
