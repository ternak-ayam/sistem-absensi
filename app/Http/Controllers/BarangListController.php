<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductList;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $request->validate([
            'custom_id' => ['required', Rule::unique('product_lists')->whereNull('deleted_at')],
            'name' => ['required']
        ], [
            'custom_id.unique' => 'Kode barang sudah digunakan '
        ]);

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
