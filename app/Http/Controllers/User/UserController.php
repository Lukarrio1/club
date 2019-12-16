<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

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