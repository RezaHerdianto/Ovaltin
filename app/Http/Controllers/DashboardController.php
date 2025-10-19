<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StrawberryProduct;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = StrawberryProduct::count();
        $totalStock = StrawberryProduct::sum('stock_quantity');
        $lowStockProducts = StrawberryProduct::where('stock_quantity', '<', 10)->count();
        $outOfStockProducts = StrawberryProduct::where('stock_quantity', 0)->count();
        
        $recentProducts = StrawberryProduct::latest()->take(5)->get();
        $topCategories = StrawberryProduct::selectRaw('category, count(*) as count')
            ->groupBy('category')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get();
        
        $qualityDistribution = StrawberryProduct::selectRaw('quality_grade, count(*) as count')
            ->groupBy('quality_grade')
            ->get();

        return view('dashboard.index', compact(
            'totalProducts',
            'totalStock',
            'lowStockProducts',
            'outOfStockProducts',
            'recentProducts',
            'topCategories',
            'qualityDistribution'
        ));
    }
}
