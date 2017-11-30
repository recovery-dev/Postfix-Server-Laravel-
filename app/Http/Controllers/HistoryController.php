<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Exception;

class HistoryController extends Controller
{
    public function index()
    {
        $history = DB::table('history')->get();
        return view('history/history', ['history' => $history]);
    }
}
