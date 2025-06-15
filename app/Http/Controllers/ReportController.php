<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActivityLogsExport;

class ReportController extends Controller
{
    /**
     * Show daily overview report
     */
    public function dailyOverview()
    {
        $logs = ActivityLog::with(['activity', 'user'])
            ->whereDate('logged_at', now()->toDateString())
            ->get();

        return view('reports.daily', compact('logs'));
    }

    /**
     * Show the date range report form
     */
    public function rangeForm()
    {
        return view('reports.range_form');
    }

    /**
     * Handle the date range form submission and show filtered results
     */
    public function rangeReport(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date'   => 'required|date|after_or_equal:from_date',
        ]);

        $logs = ActivityLog::with(['activity', 'user'])
            ->whereBetween('logged_at', [$request->from_date, $request->to_date])
            ->get();

        return view('reports.range_form', compact('logs'))->withInput();
    }

    /**
     * Export today's activity logs to PDF
     */
    public function exportPdf()
    {
        $logs = ActivityLog::with(['activity', 'user'])
            ->whereDate('logged_at', now()->toDateString())
            ->get();

        $pdf = Pdf::loadView('reports.export_pdf', compact('logs'));
        return $pdf->download('daily_activity_logs.pdf');
    }

    /**
     * Export today's activity logs to Excel
     */
    public function exportExcel()
    {
        return Excel::download(new ActivityLogsExport, 'daily_activity_logs.xlsx');
    }
}
