<?php

namespace App\Http\Controllers\User;

use App\Club;
use App\Http\Controllers\Controller;
use App\Message;
use App\Notification;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function messagePage()
    {
        return view('user.message');

    }

    public function getMessages($club)
    {
        $messages =
        Message::where(function ($q) use ($club) {
            $q->where('from', Auth::user()->club_id);
            $q->where('to', $club);
        })->orWhere(function ($q) use ($club) {
            $q->where('from', $club);
            $q->where('to', Auth::user()->club_id);
        })->get();
        return $messages;

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'to' => 'required',
            'message' => 'required',
        ]);
        $leader = [];
        $just_role = [];
        $users = User::Where('club_id', $request->to)->get();
        foreach ($users as $user) {
            foreach ($user->roles as $role) {
                $just_role = [$role->role];
            }
            if (in_array('leader', $just_role)) {
                $leader = $user;
            }
        }
        if (empty($leader)) {
            return ['status' => 'Sorry this club does not have a leader', 'error' => true];
        }
        $to = $leader->club_id;
        $from = Auth::user()->club_id;
        $message = htmlentities($request->message);
        $club = Club::where('id', $from)->first();
        $ref_id = Message::create([
            'to' => $to,
            'from' => $from,
            'message' => $message,
        ])->id;

        Notification::create([
            're_id' => $to,
            'user_id' => Auth::user()->id,
            'class' => "message",
            'notify' => "You have a new message from $club->name .",
            'icon' => "fas fa-envelope",
            'ref_id' => $ref_id,
        ]);

        return ['status' => 200, 'error' => false];
    }

}
