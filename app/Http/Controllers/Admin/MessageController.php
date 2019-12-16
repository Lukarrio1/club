<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index($id)
    {
        // $this->Fac();
        $messages =
        Message::where(function ($q) use ($id) {
            $q->where('from', Auth::user()->id);
            $q->where('to', $id);
        })->orWhere(function ($q) use ($id) {
            $q->where('from', $id);
            $q->where('to', Auth::user()->id);
        })->get();
        return $messages;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'to' => 'required',
            'message' => 'required',
        ]);
        $to = htmlentities($request->to);
        $from = Auth::user()->id;
        $message = htmlentities($request->message);
        $store = new Message;
        $store->to = $to;
        $store->from = $from;
        $store->message = $message;
        $store->save();
        return ['status' => 200, 'error' => false];
    }

    public function messagePage()
    {
        return view('admin.user.message');
    }

    public function Fac()
    {
        $store = new Message;
        $store->to = 1;
        $store->from = 3;
        $store->message = "man a shella";
        $store->save();
    }

    public function delete(Message $message)
    {
        $message->delete();
        return ['status' => 200, 'error' => false];
    }
}
