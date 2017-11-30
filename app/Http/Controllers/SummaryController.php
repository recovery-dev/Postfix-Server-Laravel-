<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }    

    public function index()
    {
        $summary = DB::table('summary')->get();
        return view('summary/summary', ['summary' => $summary]);
    }

    public function sumary()
    {

    }

}
