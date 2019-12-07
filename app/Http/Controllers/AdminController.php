<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }

    public function edit()
    {
        return view('admin.edit');
    }

    public function getAdmin()
    {
        return Admin::find(Auth::user()->id);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'email|required',
        ]);

        $admin = Admin::find(Auth::user()->id);
        $admin->name = htmlentities($request->name);
        $admin->email = htmlentities($request->email);
        $admin->save();
        return ['status' => 200];
    }
}
