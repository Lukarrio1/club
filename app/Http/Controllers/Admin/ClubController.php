<?php

namespace App\Http\Controllers\Admin;

use App\Club;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        // $this->dummyClub();
        $clubs = Club::orderBy('created_at', 'DESC')->get();
        $res = array();
        foreach ($clubs as $club) {
            $res[] = [
                'name' => $club->name,
                'location' => $club->location,
                'id' => $club->id,
                'created_at' => $club->created_at,
                'update_at' => $club->updated_at,
                'selected' => "",
                'edit' => false];

        }

        return $res;
    }

    public function dummyClub()
    {
        $name = str_random(8);
        $location = str_random(8);
        $club = new Club;
        $club->name = $name;
        $club->location = $location;
        $club->save();
    }

    public function clubPage()
    {
        return view('admin.user.club');
    }

    public function searchClubs(Request $request)
    {
        $search = htmlentities($request->search);
        $clubs = array();
        $results = $search != "all" ? Club::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('location', 'LIKE', '%' . $search . '%')
            ->orderby('created_at', 'desc')
            ->get() : Club::all();
        foreach ($results as $club) {
            $amount = User::where('club_id', $club->id)->get();
            $clubs[] = [
                'name' => $club->name,
                'location' => $club->location,
                'created_at' => $club->created_at,
                'updated_at' => $club->update_at,
                'member_count' => count($amount) > 0 ? count($amount) : 0,
                'id' => $club->id,
            ];
        }
        return $clubs;
    }

    public function store(Request $request)
    {
        $club = Club::where('name', $request->name)->first();
        if (!empty($club)) {
            return ['error' => true, 'status' => 'There is a club by that name already'];
        } else {
            $store = new Club;
            $store->name = htmlentities($request->name);
            $store->location = htmlentities($request->location);
            $store->save();
            return ['status' => 200, 'error' => false];

        }
    }

    public function delete(Club $id)
    {
        $users = User::where('club_id', $id->id)->get();
        foreach ($users as $user) {
            $user->club_id = 0;
            $user->save();
        }
        $id->delete();
        return ['status' => 200];
    }

    public function show(Club $club)
    {
        return $club;
    }

    public function update(Request $request, Club $club)
    {
        $this->validate($request, [
            'name' => 'required',
            'location' => 'required',
        ]);
        $check = Club::where('name', $request->name)->first();
        if (empty($check) || $check->id == $club->id) {
            $club->name = htmlentities($request->name);
            $club->location = htmlentities($request->location);
            $club->save();
            return ['status' => 200, 'error' => false];
        } else {
            return ['status' => "Club name is already in use.", 'error' => true];
        }
    }
}
