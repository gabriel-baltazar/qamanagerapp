<?php

namespace App\Exports;

use App\Models\Stopwatch;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StopwatchesExport implements FromQuery, WithHeadings
{
    public function __construct($date_ini, $date_fim)
    {
        $this->date_ini = $date_ini;
        $this->date_fim = $date_fim;
    }
    public function headings(): array
    {
        return [
            'Tarefa',
            'Sessão',
            'Tempo',
            'Criado em',
        ];
    }
    public function query()
    {
        return Stopwatch::query()->whereBetween('stopwatches.created_at', [$this->date_ini, $this->date_fim])
            ->select(
                'stopwatches.task_id',
                'stopwatches.session',
                'stopwatches.time',
                'stopwatches.created_at'
            );
    }
}
