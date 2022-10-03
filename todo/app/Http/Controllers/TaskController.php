<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::orderBy('created_at','desc')->get();

    }


    public function filter(Request $request) {

        if($request->state != "") {
            $tasks = Task::where('state', $request->state)->get();
        } else {
            $tasks = Task::orderBy('created_at','desc')->get();
        }

        return response()->json([
            'task'=>  $tasks
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Task
     */
    public function store(Request $request)
    {
        $newTask = new Task;
        $newTask->name = $request->item['name'];
        $newTask->save();


        return $newTask;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if($task) {
            $task->state = $request->item['state'] ? true : false;
            $task->name = $request->item["name"];
            $task->save();
            return $task;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if($task) {
            $task->delete();
            return "Item deleted";
        }
    }
}
