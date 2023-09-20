<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.pages.dashboard.index', [
            'dates' => [],
            'employees' => 0,
            'activeEmployees' => 0,
            'inactiveEmployees' => 0,
            'totalPresences' => 0,
        ]);
    }
}
