<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Mail\SendMail;
use App\Models\ImapAccount;

use Illuminate\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;

class ConfigController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {   
        $user = auth()->user();
        // Mail::to($user)->send(new SendMail($user));
        
        return redirect('imap/config');
    }

    public function getConfig()
    {   
        try {
            $config = DB::table('imap_accounts')->get();
            return view('home', ['config' => $config]);
        } catch(\Exception $e) {
            return $this->errHandler($e);
        }
    }

    public function getConfigById($id)
    {   
        try {
            $config = DB::table('imap_accounts')->where('id', '=', $id)->get();
            return $config;
        } catch(\Exception $e) {
            return $this->errHandler($e);
        }
    }

    public function add(Request $data)
    {
        try {
            $configurations = new ImapAccount($data->all());
            $configurations->save();
            return 'success';
        } catch(\Exception $e) {
            return $this->errHandler($e);
        }
    }

    public function edit(Request $req)
    {   
        $data = $req->all();
        try {
            DB::table('imap_accounts')->where('id', $data['id'])->update([
                'username' => $data['username'],
                'password' => $data['password'],
                'fqdn' => $data['fqdn'],
                'port' => $data['port'],
                'folder_name' => $data['folder_name'],
                'protocol' => isset($data['protocol'])? $data['protocol'] : 'SSL'
            ]);
            return 'success';
        } catch(\Exception $e) {
            return $this->errHandler($e);
        }
    }

    public function delete($id)
    {
        try {
            DB::table('imap_accounts')->where('id', '=', $id)->delete();
            return redirect('imap/config');
        } catch(\Exception $e) {
            return $this->errHandler($e);
        }
    }

    public function errHandler($e) {
        return Response::json(['error'=>$e->getMessage()], 400);
    }
}
