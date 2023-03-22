<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $products = Product::where('name', 'like', '%'.\request()->get('search').'%')->orderby('id', 'DESC')->paginate(10);

        return view('admin.pages.barang.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('admin.pages.barang.create', [
            'code' => rand()
        ]);
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->fill($request->all());
        $product->saveOrFail();

        return redirect(route('admin.barang.index'));
    }
}
