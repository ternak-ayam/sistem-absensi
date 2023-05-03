<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanBarangExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $products = Product::orderby('id', 'DESC')->get();

        return view('admin.pages.barang.laporan.excel', [
            'products' => $products
        ]);
    }
}
