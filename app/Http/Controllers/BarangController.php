<?php

namespace App\Http\Controllers;

use App\Exports\LaporanBarangExport;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function edit(Product $product)
    {
        return view('admin.pages.barang.edit', [
            'product' => $product
        ]);
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->fill($request->all());
        $product->saveOrFail();

        return redirect(route('admin.barang.index'));
    }

    public function update(Request $request, Product $product)
    {
        $product->fill($request->all());
        $product->saveOrFail();

        return redirect(route('admin.barang.index'));
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('admin.barang.index'));
    }

    public function export()
    {
        return Excel::download(new LaporanBarangExport(), now()->format('Y-m-d').'-laporan-barang.xlsx');
    }
}
