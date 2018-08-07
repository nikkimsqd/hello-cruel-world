<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;

class CustomerController extends Controller
{
    public function index()
    {
    	$categories = Category::all();
    	$products = Product::all();

    	return view('hinimo/index', compact('categories', 'products'));
    }

    public function shop()
    {
    	$products = Product::all();
    	$categories = Category::all();
    	// dd($products);

    	return view('hinimo/shop', compact('products', 'categories'));
    }

    public function productDetails($productID)
    {
    	$product = Product::where('productID', $productID)->first();

    	return view('hinimo/single-product-details', compact('product'));
    }
}
