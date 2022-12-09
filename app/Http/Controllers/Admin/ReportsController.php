<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Report;

class ReportsController extends Controller
{
    public function __invoke()
    {
        $reports = Report::orderBy('id', 'DESC')->get();

        return view('admin.reports', compact('reports'));
    }
}
