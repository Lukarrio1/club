<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function userPage()
    {
        return view('admin.user.users');
    }

    public function emailCheck(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        $email = htmlentities($request->email);
        $avail = User::where('email', $email)->first();
        return !empty($avail) ? ['status' => 1] : ['status' => 0];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'address' => 'required',
            'trn' => 'required|min:9|max:9',
            'phone' => 'required|min:10|max:10',
            'parish' => 'required',
            'age' => 'required',
            'password' => 'required|min:6',
            'gender' => 'required',
        ]);
        $store = new User;
        $name = htmlentities($request->name);
        $email = htmlentities($request->email);
        $address = htmlentities($request->address);
        $trn = htmlentities($request->trn);
        $phone = htmlentities($request->phone);
        $parish = htmlentities($request->parish);
        $age = htmlentities($request->age);
        $password = Hash::make(htmlentities($request->password));
        $gender = htmlentities($request->gender);
        $store->name = $name;
        $store->email = $email;
        $store->address = $address;
        $store->trn = $trn;
        $store->telephone = $phone;
        $store->parish = $parish;
        $store->age = $age;
        $store->password = $password;
        $store->gender = $gender;
        $store->save();
        return ['status' => 200];
    }
}
