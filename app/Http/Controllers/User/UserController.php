<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return User::find(Auth::user()->id);
    }

    public function userPage()
    {
        return view('user.index');
    }

    public function profilePage()
    {
        return view('user.profile');
    }
}
