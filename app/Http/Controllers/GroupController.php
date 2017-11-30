<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $groups = DB::table('groups')->get();
        return view('groups/groups', ['groups' => $groups]);
    }

    public function getGroups()
    {
        
    }
}
