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
        $totalProducts = Product::count();
        $outProducts = Product::where('type', Product::KELUAR)->count();
        $inProducts = Product::where('type', Product::MASUK)->count();
        $employees = Admin::where('role', Admin::PEGAWAI)->count();

        $products = Product::limit(4)->get();

        $datesCount = 0;
        $dates = [];
        $productInCount = [];
        $productOutCount = [];

        do {
            $date = now()->subDays($datesCount);
            $dates[] = $date->format('F j, Y');

            $productInCount[] = Product::where('type', Product::MASUK)->whereDate('created_at', $date)->count();
            $productOutCount[] = Product::where('type', Product::KELUAR)->whereDate('created_at', $date)->count();

            $datesCount++;
        } while($datesCount <= 7);

        return view('admin.pages.dashboard.index',
            compact('totalProducts', 'outProducts',
                'inProducts', 'employees', 'products', 'dates',
                'productOutCount', 'productInCount'));
    }
}
