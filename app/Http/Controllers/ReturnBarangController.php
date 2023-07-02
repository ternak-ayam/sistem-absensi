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
        $products = Product::where([['code', 'like', '%'.\request()->get('search').'%'], ['type', Product::RETURN]])->orderby('id', 'DESC')->paginate(10);

        return view('admin.pages.barang.return.index', [
            'products' => $products
        ]);
    }

    public function edit(Product $product)
    {
        return view('admin.pages.barang.return.edit', [
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        if($request->quantity == $product->quantity) {
            $product->update([
                'type' => Product::RETURN,
                'status' => Product::REJECTED
            ]);

            return redirect(route('admin.barang.index'));
        }

        $newProduct = $product->replicate();
        $newProduct->type = Product::RETURN;
        $newProduct->status = Product::REJECTED;
        $newProduct->quantity = $request->quantity;
        $newProduct->save();

        $product->quantity = $product->quantity - $request->quantity;
        $product->save();

        return redirect(route('admin.barang.index'));
    }
}
