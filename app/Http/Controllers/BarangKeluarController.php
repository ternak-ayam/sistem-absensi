<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        return view('admin.pages.barang.keluar.index');
    }

    public function create()
    {
        return view('admin.pages.barang.keluar.create');
    }
}
