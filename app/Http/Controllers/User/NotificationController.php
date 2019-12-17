<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Notification;
use App\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getMessageNotifications()
    {
        $user = User::find(Auth::user()->id);
        $just_role = array();
        foreach ($user->roles as $role) {
            $just_role = [$role->role];
        }
        if (in_array('leader', $just_role)) {
            return $user->notifications;
        } else {
            return Notification::where('class', '!=', '.message')->where('re_id', $user->club_id)->get();
        }
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return ['status' => 200, 'error' => false];
    }
}
