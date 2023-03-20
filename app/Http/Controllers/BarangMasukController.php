<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        return view('admin.pages.barang.masuk.index');
    }

    public function create()
    {
        return view('admin.pages.barang.masuk.create');
    }
}
