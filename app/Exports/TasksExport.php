<?php

namespace App\Exports;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class TasksExport implements FromView
{
    use Exportable;

    public function __construct($date_ini, $date_fim, $user)
    {
        $this->date_ini = $date_ini;
        $this->date_fim = $date_fim;
        $this->user = $user;
    }
    public function view(): View
    {
        if($this->user != '0'){
            $tasks = Task::where('tasks.responsible_id', $this->user)
                ->whereBetween('tasks.created_at', [$this->date_ini, $this->date_fim])
                            ->join('users', function($join){
                                $join->on('tasks.responsible_id', '=', 'users.id');   
                            })
                            ->select('tasks.id',
                                    'tasks.title',
                                    'tasks.status',
                                    'tasks.description',
                                    'tasks.created_at',
                                    'tasks.updated_at',
                                    'tasks.closed_at',
                                    'users.name as responsible_name'
                                )
                            ->get();
        }else{
            $tasks = Task::whereBetween('tasks.created_at', [$this->date_ini, $this->date_fim])
            ->join('users', function($join){
                $join->on('tasks.responsible_id', '=', 'users.id');
            })
            ->select(
                    'tasks.id',
                    'tasks.title',
                    'tasks.status',
                    'tasks.description',
                    'tasks.created_at',
                    'tasks.updated_at',
                    'tasks.closed_at',
                    'users.name as responsible_name',
                )->get();                                                   
        }
        return view('pdf.invoice', [
            'tasks' => $tasks
        ]);
    }
}
