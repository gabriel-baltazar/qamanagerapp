<?php

namespace App\Http\Controllers;

use App\Exports\StopwatchesExport;
use App\Exports\TasksExport;
use App\Models\Stopwatch;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioController extends Controller
{
    public function export(Request $request)
    {
        $date_ini = $request->date_ini;
        $date_fim = $request->date_fim;
        $user = $request->user_id;
        $tipo = $request->tipo;
        $formato = $request->formato;
        if ($tipo == 'tarefa') {
            $tasks = $this->getTasks($user, $date_ini, $date_fim);
            switch ($formato) {
                case 'excel':
                    return Excel::download(new TasksExport($date_ini, $date_fim, $user), 'Tarefas-' . date('d-m-y') . '.xlsx');
                    break;
                case 'pdf':
                    $pdf = Pdf::loadView('pdf.invoice', compact('tasks'));
                    return $pdf->setPaper('A4', 'landscape')->stream('Tarefas-' . date('d-m-y') . '.pdf');
                    break;
            }
        } elseif ($tipo == 'cronometro') {
            $stopwatches = $this->getStopwatches($date_ini, $date_fim);
            switch ($formato) {
                case 'excel':
                    return Excel::download(new StopwatchesExport($date_ini, $date_fim), 'Cronometros-' . date('d-m-y') . '.xlsx');
                    break;
                case 'pdf':
                    $pdf = Pdf::loadView('pdf.stopwatch', compact('stopwatches'));
                    return $pdf->setPaper('A4', 'landscape')->stream('Cronometros-' . date('d-m-y') . '.pdf');
                    break;
            }
        }
    }

    public function relatorio()
    {
        $users = User::all();
        return view('relatorios.index', compact('users'));
    }
    public function getTasks($user, $date_ini, $date_fim)
    {
        if ($user != '0') {
            $tasks = Task::where('tasks.responsible_id', $user)
                ->whereBetween('tasks.created_at', [$date_ini, $date_fim])
                ->join('users', function ($join) {
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
                    'users.name as responsible_name'
                )
                ->get();
        } else {
            $tasks = Task::whereBetween('tasks.created_at', [$date_ini, $date_fim])
                ->join('users', function ($join) {
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
        return $tasks;
    }

    public function getStopwatches($date_ini, $date_fim)
    {
        $stopwatches = Stopwatch::whereBetween('stopwatches.created_at', [$date_ini, $date_fim])
            ->select(
                'stopwatches.task_id',
                'stopwatches.session',
                'stopwatches.time',
                'stopwatches.created_at'
            )->orderBy('stopwatches.task_id', 'asc')->get();
        return $stopwatches;
    }
}
