<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PegawaiPresence;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $employees = User::count();
        $activeEmployees = User::where('status', true)->count();
        $inactiveEmployees = User::where('status', false)->count();
        $totalPresences = PegawaiPresence::count();

        return view('admin.pages.dashboard.index', [
            'dates' => [],
            'employees' => $employees,
            'activeEmployees' => $activeEmployees,
            'inactiveEmployees' => $inactiveEmployees,
            'totalPresences' => $totalPresences
        ]);
    }
}
