<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class LaporanBarangController extends Controller
{
    public function index()
    {
        $months = [];
        $products = Product::where('name', 'like', '%'.\request()->get('search').'%');

        if(\request()->get('month')) {
            $products->whereMonth('date', \request()->get('month'));
        }

        $month = 1;
        do {
            $months[] = date('F', mktime(0,0,0, $month, 1, date('Y')));
            $month++;
        } while($month <= 12);

        return view('admin.pages.barang.laporan.index', [
            'products' => $products->orderby('id', 'DESC')->paginate(10),
            'months' => $months
        ]);
    }
}
