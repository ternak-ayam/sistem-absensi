<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanBarangController extends Controller
{
    public function index()
    {
        return view('admin.pages.barang.laporan.index');
    }
}
