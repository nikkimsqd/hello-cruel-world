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
}
