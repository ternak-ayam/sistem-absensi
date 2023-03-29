<?php

namespace App\Http\Controllers;

use App\Exports\LaporanBarangExport;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReturnBarangController extends Controller
{
    public function index()
    {
        $products = Product::where([['name', 'like', '%'.\request()->get('search').'%'], ['type', Product::RETURN]])->orderby('id', 'DESC')->paginate(10);

        return view('admin.pages.barang.return.index', [
            'products' => $products
        ]);
    }

    public function return(Product $product)
    {
        $product->update([
            'type' => Product::RETURN
        ]);

        return back();
    }
}
