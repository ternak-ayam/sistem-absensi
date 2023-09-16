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
        $totalProducts = 0;
        $outProducts = 0;
        $inProducts = 0;
        $employees = 0;

        $products = collect();

        $datesCount = 0;
        $dates = [];
        $productInCount = [];
        $productOutCount = [];

        return view('admin.pages.dashboard.index',
            compact('totalProducts', 'outProducts',
                'inProducts', 'employees', 'products', 'dates',
                'productOutCount', 'productInCount'));
    }
}
