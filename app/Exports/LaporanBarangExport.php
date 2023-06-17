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
        $products = Product::where('code', 'like', '%'.session()->get('search').'%');

        if(session()->get('month')) {
            $products->whereMonth('date', session()->get('month'));
        }

        if($type = session()->get('type')) {
            $products->where('type', $type);
        }

        return view('admin.pages.barang.laporan.excel', [
            'products' => $products->orderby('id', 'DESC')->get()
        ]);
    }
}
