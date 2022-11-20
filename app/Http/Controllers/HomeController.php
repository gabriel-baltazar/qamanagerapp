<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $myTasks = Task::where('responsible_id', Auth::user()->id)->orderBy('status')->get();
        $tasks = Task::where('responsible_id', 0)->orderBy('created_at')->get();
        return view('home',compact('myTasks','tasks'));
    }
}
