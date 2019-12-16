<?php

namespace App\Http\Controllers\Admin;

// use App\Club
use App\Club;
use App\Http\Controllers\Controller;
use App\Role;
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
            'position' => 'required',
        ]);
        $store = new User;
        $name = htmlentities($request->name);
        $email = htmlentities($request->email);
        $address = htmlentities($request->address);
        $trn = htmlentities($request->trn);
        $phone = htmlentities($request->phone);
        $parish = htmlentities($request->parish);
        $age = htmlentities($request->age);
        $position = htmlentities($request->position);
        $club = Club::where('name', $request->club)->first();
        $isLeader = Role::where('role', 'leader');
        $users = array();
        foreach ($isLeader as $user) {
            $u = User::where('id', $user->user_id)->first();
            $users[] = [$u];
        }
        if (count($users) > 0) {
            return ['status' => 'There is already a leader for that club', 'error' => true];
        }
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
        $store->position = $position;
        $store->save();
        $use = User::where('email', $email)->first();
        $role = new Role;
        $role->user_id = $use->id;
        $role->role = $position;
        $role->save();
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
            $role = Role::where('user_id', $user->id)->first();
            $IsDeleted = empty($club) ? ['name' => 'Club Deleted', 'location' => 'Club deleted', 'id' => 0] : $club;
            $users[] = [
                'name' => $user->name,
                'email' => $user->email,
                'age' => $user->age,
                'phone' => $user->telephone,
                'address' => $user->address,
                'trn' => $user->trn,
                'id' => $user->id,
                'gender' => $user->gender,
                'club' => $IsDeleted,
                'parish' => $user->parish,
                'created_at' => $user->created_at,
                'role' => $role,
            ];
        }
        return $users;
    }

    public function removeMember(User $user)
    {

        $user->delete();
        return ['status' => 200];
    }

    public function single(User $user)
    {
        $club = Club::where('id', $user->club_id)->first();
        // $club_obj = [];
        // if (!empty($club)) {
        //     $club_obj = [
        //         'name' => $club->name,
        //         'location' => $club->location,
        //         'created_at' => $club->created_at,
        //         'updated_at' => $club->updated_at,
        //     ];
        // } else {
        //     $club_obj = [
        //         'name' => "Member Club",
        //         'location' => "Member Location",
        //         'created_at' => null,
        //         'updated_at' => null,
        //     ];
        // }
        $res = array();
        $res = [
            'club' => $club,
            'id' => $user->id,
            'name' => $user->name,
            'parish' => $user->parish,
            'address' => $user->address,
            'age' => $user->age,
            'gender' => $user->gender,
            'email' => $user->email,
            'trn' => $user->trn,
            'phone' => $user->telephone,
        ];
        return $res;
    }
}
