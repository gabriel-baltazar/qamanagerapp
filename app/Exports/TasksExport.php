<?php

namespace App\Exports;

use App\Models\Task;
use GuzzleHttp\Psr7\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TasksExport implements FromQuery,WithHeadings
{
    use Exportable;

    public function __construct($date_ini, $date_fim, $user)
    {
        $this->date_ini = $date_ini;
        $this->date_fim = $date_fim;
        $this->user = $user;
    }

    public function headings(): array
    {
        return [
            '#',
            'Título',
            'Descrição',
            'Criado em',
            'Atualizado em',
            'Finalizado em',
            'Responsável'
        ];
    }
    public function query()
    {
        if($this->user == '0'){
            return Task::query()->whereBetween('tasks.created_at', [$this->date_ini, $this->date_fim])
                                ->join('users', function($join){
                                    $join->on('tasks.responsible_id', '=', 'users.id');
                                })
                                ->select('tasks.id',
                                        'tasks.title',
                                        'tasks.description',
                                        'tasks.created_at',
                                        'tasks.updated_at',
                                        'tasks.closed_at',
                                        'users.name as responsible_name'
                                    );
        }
        return Task::query()->where('tasks.user_id', $this->user)
                            ->whereBetween('tasks.created_at', [$this->date_ini, $this->date_fim])
                            ->join('users', function($join){
                                $join->on('tasks.responsible_id', '=', 'users.id');
                            })
                            ->select(
                                    'tasks.id',
                                    'tasks.title',
                                    'tasks.description',
                                    'tasks.created_at',
                                    'tasks.updated_at',
                                    'tasks.closed_at',
                                    'users.name as responsible_name',
                                );
    }
}
