<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $products = Product::where([['name', 'like', '%'.\request()->get('search').'%'], ['type', Product::MASUK]])->orderby('id', 'DESC')->paginate(10);

        return view('admin.pages.barang.masuk.index', [
            'products' => $products
        ]);
    }
}
