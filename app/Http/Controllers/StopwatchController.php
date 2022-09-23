<?php

namespace App\Http\Controllers;

use App\Models\Stopwatch;
use Illuminate\Http\Request;

class StopwatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $session = Stopwatch::where('task_id', $request->task_id)->count();
        $stopwatch = new Stopwatch();
        $stopwatch->task_id = $request->task_id;
        $stopwatch->session = 1;
        if($session){
            $stopwatch->session = $session + 1;
        }
        $stopwatch->time = $request->time;
        $stopwatch->save();
        return response()->json($stopwatch);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stopwatch  $stopwatch
     * @return \Illuminate\Http\Response
     */
    public function show(Stopwatch $stopwatch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stopwatch  $stopwatch
     * @return \Illuminate\Http\Response
     */
    public function edit(Stopwatch $stopwatch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stopwatch  $stopwatch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stopwatch $stopwatch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stopwatch  $stopwatch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stopwatch $stopwatch)
    {
        //
    }
}
