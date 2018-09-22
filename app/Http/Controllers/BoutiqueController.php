<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\File;
<<<<<<< HEAD
=======
use App\Category;
use App\User;
>>>>>>> master

class BoutiqueController extends Controller
{
    public function showProducts()
	{
   		$id = Auth()->user()->id;


		$products = File::where('userID', $id)->get();
		// dd($products);

		return view('boutique/products',compact('products'));
	}


	public function addProduct()
	{
		$categories = Category::all();

<<<<<<< HEAD
		// $validated = $request->validate([
		// 'product' => 'required|mimes:jpeg,png,jpg,gif,svg'
		// ]);
=======
		return view('boutique/addProducts', compact('categories'));
	}
>>>>>>> master


<<<<<<< HEAD
    $uploads = $request->file('product');
    if($request->hasFile('product')) {
    	

    	foreach($uploads as $upload){
    	 // dd($upload);
    	$files = new File();

=======
	public function saveProduct(Request $request)
	{
    	$id = Auth()->user()->id;

    	


    	$products = Product::create([
    		'userID' => $id,
    		'productName' => $request->input('productName'),
    		'productDesc' => $request->input('productDesc'),
    		'productPrice' => $request->input('productPrice'),
    		'category' => $request->input('category'),
    		'productStatus' => "Available"
    		]);

    	// dd($products['productID']);



    	$uploads = $request->file('file');

    	if($request->hasFile('file')) {

    	foreach($uploads as $upload){
    	$files = new File();

>>>>>>> master
    		$name = $upload->getClientOriginalName();
	        $destinationPath = public_path('uploads');
	        // $filename = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7).$file->getClientOriginalName();
	        $filename = $destinationPath.'\\'. $name;
	        $upload->move($destinationPath, $filename);

<<<<<<< HEAD
	        $files->filename = "/".$name;
	       	$files->userID = $id;
	       	$files->batchID = rand();
	      	$files->save();
    	}
      }

    // dd($products); 	
    // return view('boutique/addProductDetails', compact('products'));
      return redirect('/addProductDetails', compact('products'));
=======
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

		return view('boutique/viewProduct', compact('product'));
>>>>>>> master
	}

}
