<?php

namespace App\Http\Controllers;

use App\Models\Stopwatch;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('task_index'), 403);

        $tasks = Task::paginate(5);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        abort_if(Gate::denies('task_create'), 403);
        $users = User::all();
        return view('tasks.create',compact('users'));
    }

    public function store(Request $request)
    {
        $task = $request->all();
        $task['user_id'] = Auth::user()->id;
        Task::create($task);

        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        abort_if(Gate::denies('task_show'), 403);

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        abort_if(Gate::denies('task_edit'), 403);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->all());

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        abort_if(Gate::denies('task_destroy'), 403);

        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function getTask($idTask)
    {
        abort_if(Gate::denies('task_get'), 403);
        $task = Task::findOrFail($idTask);
        $task->responsible_id = Auth::user()->id;
        $task->save();
        return redirect()->route('home');
    }

    public function myTask(Task $task)
    {
        abort_if(Gate::denies('task_do'), 403);

        $stopwatches = Stopwatch::where('task_id', $task->id)->get();

        return view('tasks.myTask', compact('task', 'stopwatches'));
    }
    
    public function finishTask(Request $request)
    {
        abort_if(Gate::denies('task_finish'), 403);
        $task = Task::findOrFail($request->id);
        if($request->acao == 'Finalizar'){
            $task->status = 2;
        }else{
            $task->status = 1;
        }
        $task->closed_at = now();
        $task->save();
        return redirect()->route('home');
    }
}
