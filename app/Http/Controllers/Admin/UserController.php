<?php

namespace App\Http\Controllers\Admin;

// use App\Club
use App\Club;
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
        return ['status' => !empty($avail) ? 1 : 0];
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
        $club = Club::where('name', $request->club)->first();
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
        $store->club_id = $club->id;
        $store->save();
        // $this->newUSer(new newUser($name, $request->password));
        return ['status' => 200];
    }

    public function searchUser(Request $request)
    {
        $search = htmlentities($request->search);
        $results = $search != "all" ? User::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->orWhere('parish', 'LIKE', '%' . $search . '%')
            ->orWhere('trn', 'LIKE', '%' . $search . '%')
            ->orWhere('address', 'LIKE', '%' . $search . '%')
            ->orWhere('gender', 'LIKE', '%' . $search . '%')
            ->orWhere('age', 'LIKE', '%' . $search . '%')
            ->orWhere('telephone', 'LIKE', '%' . $search . '%')
            ->orderby('created_at', 'desc')
            ->get() : User::all();
        $users = array();
        foreach ($results as $user) {
            $club = Club::find($user->club_id);
            $users[] = [
                'name' => $user->name,
                'email' => $user->email,
                'age' => $user->age,
                'phone' => $user->telephone,
                'address' => $user->address,
                'trn' => $user->trn,
                'id' => $user->id,
                'gender' => $user->gender,
                'club' => $club,
                'parish' => $user->parish,
                'created_at' => $user->created_at,
            ];
        }
        return $users;
    }
}
