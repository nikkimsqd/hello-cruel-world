<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Cart;

class CustomerController extends Controller
{
    public function index()
    {
        $userid = Auth()->user()->id;
    	$categories = Category::all();
    	$products = Product::all();
        $cartCount = Cart::where('userID', $userid)->where('status', "Pending")->count();
        $carts = Cart::where('userID', $userid)->where('status', "Pending")->get();

    	return view('hinimo/index', compact('categories', 'products', 'carts', 'cartCount'));
    }

    public function shop()
    {
   		$userid = Auth()->user()->id;
    	$products = Product::all();
    	$categories = Category::all();
    	$cartCount = Cart::where('userID', $userid)->where('status', "Pending")->count();
    	$carts = Cart::where('userID', $userid)->where('status', "Pending")->get();
    	// dd($carts);

    	return view('hinimo/shop', compact('products', 'categories', 'carts', 'cartCount'));
    }

    public function productDetails($productID)
    {
    	$product = Product::where('productID', $productID)->first();

    	return view('hinimo/single-product-details', compact('product'));
    }

    public function addtoCart($productID)
    {
    	// print_r("yey");

   		$userid = Auth()->user()->id;
    	$cart = Cart::create([
    		'productID' => $productID,
    		'userID' => $userid,
    		'status' => "Pending"
    	]);

    	return redirect('/shop');
    }

    public function cart()
    {
   		$userid = Auth()->user()->id;
    	$carts = Cart::where('userID', $userid)->where('status', "Pending")->get();
    	
    	return view('hinimo/cart', compact('carts'));
    }

    public function getCart($productID)
    {
    	$product = Product::find($productID);

    	return response()->json(['product' => $product, 
    		'owner' => $product->owner,
    		'category' => $product->getCategory
    		]);
    }

    public function checkout()
    {
    	return view('hinimo/cart');
    }
}
