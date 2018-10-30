<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\File;
use App\Category;
use App\User;

class BoutiqueController extends Controller
{

	public function dashboard()
	{
   		$id = Auth()->user()->id;
		// $products = Product::where('userID', $id)->get();
		$user = User::find($id);
		// dd($user);

		return view('boutique/dashboard',compact('user'));
	}

    public function showProducts()
	{
   		$id = Auth()->user()->id;
		$products = Product::where('userID', $id)->get();
		// dd($products);

		return view('boutique/products',compact('products'));
	}


	public function addProduct()
	{
		$categories = Category::all();

		return view('boutique/addProducts', compact('categories'));
	}


	public function saveProduct(Request $request)
	{
    	$id = Auth()->user()->id;
    	
    	$products = Product::create([
    		'userID' => $id,
    		'productName' => $request->input('productName'),
    		'productDesc' => $request->input('productDesc'),
    		'productPrice' => $request->input('productPrice'),
    		'gender' => $request->input('gender'),
    		'category' => $request->input('category'),
    		'productStatus' => "Available",
    		'forRent' => $request->input('forRent'),
    		'forSale' => $request->input('forSale')
    		]);

    	// dd($products);

    	// dd($products['productID']);
    	$uploads = $request->file('file');

    	if($request->hasFile('file')) {
    	foreach($uploads as $upload){
    		$files = new File();
    		$name = $upload->getClientOriginalName();
	        $destinationPath = public_path('uploads');
	        // $filename = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7).$file->getClientOriginalName();
	        $filename = $destinationPath.'\\'. $name;
	        $upload->move($destinationPath, $filename);

	       	$files->userID = $id;
	       	$files->productID = $products['productID'];
	        $files->filename = "/".$name;
	      	$files->save();
	      	$filename = "/".$name;
    	}
      }

    	return redirect('/products');
	}


	public function viewProduct($productID)
	{
		$product = Product::where('productID', $productID)->first();
		$category = Category::where('id', $product['category'])->first();
		// dd($category);

		return view('boutique/viewProduct', compact('product', 'category'));
	}

	public function editView($productID)
	{
		$product = Product::where('productID', $productID)->first();
		$categories = Category::all();
		// dd($category);

		return view('boutique/editView', compact('product', 'categories'));

	}

	public function editProduct($productID)
	{

	}

	public function delete($productID)
	{
		$product = Product::where('productID', $productID)->delete();

		return redirect('/products');
	}

	public function getGender()
	{
		
	}



}