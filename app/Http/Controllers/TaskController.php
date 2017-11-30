<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Task;
use Illuminate\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = DB::table('tasks')->get();
        return view('tasks/task', ['tasks' => $tasks]);
    }

    public function getTaskById($id)
    {   
        try {
            $task = DB::table('tasks')->where('id', '=', $id)->get();
            return $task;
        } catch(\Exception $e) {
            return $this->errHandler($e);
        }
    }

    public function add(Request $data)
    {
        try {
            $task = new Task($data->all());
            $task->save();
            return 'success';
        } catch(\Exception $e) {
            return $this->errHandler($e);
        }
    }

    public function edit(Request $req)
    {   
        $data = $req->all();
        try {
            $dateInterval = $data['reservation-time'];
            $date = $data['reservation-time'].split(' - ')[0]; $time = $data['reservation-time'].split(' - ')[1];
            DB::table('tasks')->where('id', $data['id'])->update([
                'task_name' => $data['task_name'],
                'description' => $data['description'],
                'reservation_time' => $data['reservation_time'],
                'date' => $date,
                'time' => $time,
                'from_equal' => $data['from_equal'],
                'from_contains' => '/' . $data['from_contains'] . '/',
                'from_start' => '/^' . $data['from_start'] . '/',
                'from_end' => '/' . $data['from_end'] . '$/',
                'from_regex' => $data['from_regex'],
                'recipient_equal' => $data['recipient_equal'],
                'recipient_contains' => '/' . $data['recipient_contains'] . '/',
                'recipient_start' => '/^' . $data['recipient_start'] . '/',
                'recipient_end' => '/' . $data['recipient_end'] . '$/',
                'recipient_regex' => $data['recipient_regex'],
                'subject_equal' => $data['subject_equal'],
                'subject_contains' => $data['subject_contains'],
                'subject_start' => '/^' . $data['subject_start']  . '/',
                'subject_end' => '/' . $data['subject_end'] . '$/',
                'subject_regex' => $data['subject_regex'],
                'body_equal' => $data['body_equal'],
                'body_contains' => $data['body_contains'],
                'body_start' => '/^' . $data['body_start'] . '/',
                'body_end' => '/' . $data['body_end'] . '$/',
                'body_regex' => $data['body_regex'],
                'everyhour' => isset($data['everyhour'])? 1 : 0,
                'everyday' => isset($data['everyday'])? 1 : 0,
                'everyweek' => isset($data['everyweek'])? 1 : 0,
                'everymonth' => isset($data['everymonth'])? 1 : 0,
                'everyyear' => isset($data['everyyear'])? 1 : 0
            ]);
            return 'success';
        } catch(\Exception $e) {
            return $this->errHandler($e);
        }
    }

    public function delete($id)
    {
        try {
            DB::table('tasks')->where('id', '=', $id)->delete();
            return redirect('task');
        } catch(\Exception $e) {
            return $this->errHandler($e);
        }
    }

    public function errHandler($e) {
        return Response::json(['error' => $e->getMessage()], 400);
    }
}
