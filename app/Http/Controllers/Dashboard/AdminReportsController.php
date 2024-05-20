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
            'active' => 'admin-reports'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin-reports.create',[
            'page' => 'Create Report Category',
            'active' => 'admin-reports'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not Used
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        return view('dashboard.admin-reports.edit',[
            'page' => 'Edit Report Category',
            'active' => 'admin-reports'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
