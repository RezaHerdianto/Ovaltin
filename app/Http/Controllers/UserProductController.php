<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StrawberryProduct;

class UserProductController extends Controller
{
    /**
     * Display a listing of products for users
     */
    public function index()
    {
        $products = StrawberryProduct::orderBy('created_at', 'desc')->paginate(12);
        return view('user.products.index', compact('products'));
    }

    /**
     * Display the specified product for users
     */
    public function show(StrawberryProduct $product)
    {
        // Get related products (same category, excluding current product)
        $relatedProducts = StrawberryProduct::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('user.products.show', compact('product', 'relatedProducts'));
    }
}