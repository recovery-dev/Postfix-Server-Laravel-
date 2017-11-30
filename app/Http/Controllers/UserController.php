<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Update() {
        return view('users\user');
    }

    public function getUserProfile()
    {
        $users = DB::table('users')->get();

        return view('users\profile', ['users' => $users]);
    }

    public function getRoles() {
        return view('users\role');
    }

}
