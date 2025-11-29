<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Get all products ordered alphabetically
        $products = Product::orderBy('product_name')->get();

        // Return view (owner.product.stock)
        return view('owner.product.stock', compact('products'));
    }

    public function show(Product $product)
    {
        return view('owner.product.show', compact('product'));
    }
}
