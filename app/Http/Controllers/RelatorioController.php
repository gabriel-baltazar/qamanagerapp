<?php

namespace App\Http\Controllers;

use App\Exports\StopwatchesExport;
use App\Exports\TasksExport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RelatorioController extends Controller
{
    public function export(Request $request) 
    {
        $date_ini = $request->date_ini;
        $date_fim = $request->date_fim;
        $user = $request->user;
        $tipo = $request->tipo;
        if($tipo == 'tarefa'){
            return Excel::download(new TasksExport($date_ini, $date_fim, $user), 'Tarefas.xlsx');
        }elseif($tipo == 'cronometro'){
            return Excel::download(new StopwatchesExport($date_ini, $date_fim, $user), 'Cronometros.xlsx');
        }
    }

    public function relatorio()
    {
        $users = User::all();
        return view('relatorios.index', compact('users'));
    }
}
