<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductList;
use Illuminate\Http\Request;

class BarangListController extends Controller
{
    public function index()
    {
     $products = ProductList::where([['custom_id', 'like', '%'.\request()->get('search').'%']])->orderby('id', 'DESC')->paginate(10);

     return view('admin.pages.barang.list.index', [
         'products' => $products
     ]);
    }

    public function create()
    {
        return view('admin.pages.barang.list.create');
    }

    public function store(Request $request)
    {
        $listProduct = new ProductList();
        $listProduct->fill($request->all());
        $listProduct->saveOrFail();

        return redirect(route('admin.barang.list.index'));
    }

    public function destroy(ProductList $product)
    {
        $product->delete();

        return redirect(route('admin.barang.list.index'));
    }
}
