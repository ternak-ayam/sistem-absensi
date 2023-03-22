<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $products = Product::where([['name', 'like', '%'.\request()->get('search').'%'], ['type', Product::KELUAR]])->orderby('id', 'DESC')->paginate(10);

        return view('admin.pages.barang.keluar.index', [
            'products' => $products
        ]);
    }
}
