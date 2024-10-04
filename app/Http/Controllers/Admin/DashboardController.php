<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PresenceTypeEnum;
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
        $presences = PegawaiPresence::whereNotNull('scanned_at')->latest()->take(5)->get();

        $datesCount = 0;
        $dates = [];
        $inPresences = [];
        $outPresences = [];

        do {
            $date = now()->subDays($datesCount);
            $dates[] = $date->format('F j, Y');

            $inPresences[] = PegawaiPresence::where('type', PresenceTypeEnum::IN)->whereDate('scanned_at', $date)->count();
            $outPresences[] = PegawaiPresence::where('type', PresenceTypeEnum::OUT)->whereDate('scanned_at', $date)->count();

            $datesCount++;
        } while($datesCount < 7);

        return view('admin.pages.dashboard.index', [
            'dates' => $dates,
            'employees' => $employees,
            'activeEmployees' => $activeEmployees,
            'inactiveEmployees' => $inactiveEmployees,
            'totalPresences' => $totalPresences,
            'presences'     => $presences,
            'inPresences'   => $inPresences,
            'outPresences'  => $outPresences
        ]);
    }
}
