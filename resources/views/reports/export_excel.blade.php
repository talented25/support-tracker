<?php

namespace App\Exports;

use App\Models\ActivityLog;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ActivityLogsExport implements FromView
{
    protected $logs;

    public function __construct($logs)
    {
        $this->logs = $logs;
    }

    public function view(): View
    {
        return view('reports.export_excel', [
            'logs' => $this->logs,
        ]);
    }
}
