<?php

namespace App\Exports;

use App\Models\Stopwatch;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class StopwatchesExport implements FromView
{
    public function __construct($date_ini, $date_fim)
    {
        $this->date_ini = $date_ini;
        $this->date_fim = $date_fim;

    }
    public function view():View
    {
       $Stopwatches = Stopwatch::whereBetween('stopwatches.created_at', [$this->date_ini, $this->date_fim])
            ->select(
                'stopwatches.task_id',
                'stopwatches.session',
                'stopwatches.time',
                'stopwatches.created_at'
            )->orderBy('stopwatches.task_id', 'asc')->get();
        return view('pdf.stopwatch', [
            'stopwatches' => $Stopwatches
        ]);
    }
}
