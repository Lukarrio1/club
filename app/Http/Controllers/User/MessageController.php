<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;

class MessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('leader');
    }

    public function messagePage()
    {
        return view('user.message');
    }
}
