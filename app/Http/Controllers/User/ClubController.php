<?php

namespace App\Http\Controllers\User;

use App\Club;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = htmlentities($request->search);
        $clubs = array();
        $results = $search != "all" ? Club::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('location', 'LIKE', '%' . $search . '%')
            ->orderby('created_at', 'desc')
            ->get() : Club::all();
        foreach ($results as $club) {
            $amount = User::where('club_id', $club->id)->get();
            $userRole = array();
            foreach ($amount as $user) {
                $userRole = Role::where(['user_id' => $user->id], ['role', 'leader'])->first();
            }
            if (!empty($userRole)) {

                $clubs[] = [
                    'name' => $club->name,
                    'location' => $club->location,
                    'created_at' => $club->created_at,
                    'updated_at' => $club->update_at,
                    'member_count' => count($amount) > 0 ? count($amount) : 0,
                    'id' => $club->id,
                    'leader' => !empty($userRole) ? $user : null,
                ];
            }
        }
        return $clubs;
    }

    public function single(Club $club)
    {
        return $club;
    }
}
