<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $products = Product::where([['code', 'like', '%'.\request()->get('search').'%'], ['type', Product::KELUAR]])->orderby('id', 'DESC')->paginate(10);

        return view('admin.pages.barang.keluar.index', [
            'products' => $products
        ]);
    }

    public function edit(Product $product)
    {
        return view('admin.pages.barang.keluar.edit', [
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        if($request->quantity == $product->quantity) {
            $product->update([
                'type' => Product::KELUAR
            ]);

            return redirect(route('admin.barang.index'));
        }

        $newProduct = $product->replicate();
        $newProduct->type = Product::KELUAR;
        $newProduct->quantity = $request->quantity;
        $newProduct->save();

        $product->quantity = $product->quantity - $request->quantity;
        $product->save();

        return redirect(route('admin.barang.index'));
    }
}
