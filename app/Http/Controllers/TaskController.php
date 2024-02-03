<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    function index(){
        $tasks = Task::get();
        return view('welcome',['tasks'=>$tasks]);
    }

    // create todo
    function createTodo (Request $request){

        $request->validate([
            'addTodo'=>'required'
        ]);

        Task::create([
            'name'=>$request->addTodo,
            'assigned_id'=>Auth::id()
        ]);
        return back();
    }

    // delete todo
    function deleteTodo ($id){

        $checkTask = Task::whereId($id)->first();
        if (!$checkTask) {
           dd($id);
        }
        $checkTask->delete();

        return back();
    }



}
