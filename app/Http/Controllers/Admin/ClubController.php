<?php

namespace App\Http\Controllers\Admin;

use App\Club;
use App\Http\Controllers\Controller;

class ClubController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        //$this->dummyClub();
        return Club::all();
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

    }