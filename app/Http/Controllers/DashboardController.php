<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StrawberryProduct;

class DashboardController extends Controller
{
    public function index()
    {
        // Dashboard user sekarang hanya untuk pengenalan produk dan testimoni
        // Tidak perlu data dari database
        return view('dashboard.index');
    }
}
