<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Product;
use App\Models\ProductList;
use App\Models\ProductOut;
use App\Models\ProductStock;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = ProductStock::all()->sum('stock');
        
        $outProducts = ProductOut::all()->sum('quantity');
        $inProducts = Product::where('status', Product::APPROVED)->sum('quantity');
        $employees = Admin::where('role', Admin::PEGAWAI)->count();

        $products = Product::where('status', Product::APPROVED)->limit(4)->get();

        $pending = Product::where('status', Product::PENDING)->count();

        $datesCount = 0;
        $dates = [];
        $productInCount = [];
        $productOutCount = [];

        do {
            $date = now()->subDays($datesCount);
            $dates[] = $date->format('F j, Y');

            $productInCount[] = Product::where('status', Product::APPROVED)->whereDate('created_at', $date)->sum('quantity');
            $productOutCount[] = ProductOut::whereDate('created_at', $date)->sum('quantity');

            $datesCount++;
        } while($datesCount < 7);

        return view('admin.pages.dashboard.index',
            compact('totalProducts', 
                'inProducts', 'employees', 'products', 'dates',
                'productOutCount', 'productInCount', 'pending', 'outProducts'));
    }
}
