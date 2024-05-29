<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.admin-reports.index',[
            'page' => 'Reports',
            'active' => 'admin-reports',
            'categories' => Report::all()
        ]);
    }

    /**
     * Show the form for creating a new report report.
     */
    public function create()
    {
        return view('dashboard.admin-reports.create',[
            'page' => 'Create Report report',
            'active' => 'admin-reports'
        ]);
    }

    /**
     * Store a newly created report report in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'report_name' => 'required|string|max:255',
            'report_description' => 'required|string|max:255',
        ]);

        Report::create([
            'report_name' => $request->report_name,
            'report_description' => $request->report_description,

        ]);

        return redirect()->route('reports.index')->with('success', 'Report created successfully.');
    }

    /**
     * Show the form for editing the specified report report.
     */
    public function edit(Report $report)
    {
        return view('dashboard.admin-reports.edit',[
            'page' => 'Edit Report report',
            'active' => 'admin-reports',
            'report' => $report
        ]);
    }

    /**
     * Update the specified report report in storage.
     */
    public function update(Request $request, Report $report)
    {
        $request->validate([
            'report_name' => 'required|string|max:255',
            'report_description' => 'required|string|max:255',
        ]);

        $report->update([
            'report_name' => $request->report_name,
            'report_description' => $request->report_description,
        ]);

        return redirect()->route('reports.index')->with('success', 'Report updated successfully.');
    }

    /**
     * Remove the specified report report from storage.
     */
    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }
}
