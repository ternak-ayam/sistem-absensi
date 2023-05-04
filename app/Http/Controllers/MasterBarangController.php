<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MasterBarangController extends Controller
{
    public function index()
    {
        $products = Product::where('code', 'like', '%'.\request()->get('search').'%')->orderby('id', 'DESC')->paginate(10);

        return view('admin.pages.barang.master.index', [
            'products' => $products
        ]);
    }
}
