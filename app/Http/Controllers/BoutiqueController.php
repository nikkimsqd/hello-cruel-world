<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class BoutiqueController extends Controller
{
    public function showProducts()
	{
   		$id = Auth()->user()->id;


		$products = Product::where('userID', $id)->get();
		// dd($products);

		return view('boutique/products',compact('products'));
	}


    public function uploadProduct(Request $request)
	{

		// $validated = $request->validate([
		// 'product' => 'required|mimes:jpeg,png,jpg,gif,svg'
		// ]);
	

    $id = Auth()->user()->id;
    // dd($id);

    $product = new Product();

    $files = $request->file('product');
    if($request->hasFile('product')) {
    	foreach($files as $file){

    		$name = $file->getClientOriginalName();
	        $destinationPath = public_path('uploads');
	        // $filename = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7).$file->getClientOriginalName();
	        $filename = $destinationPath.'\\'. $name;
	        // $imagePath = $destinationPath. "/".  $filename;
	        $file->move($destinationPath, $filename);
	        // dd($file);

	        $product->productName = "/".$name;
	       	$product->userID = $id;
	      	$product->save();

    	// dd($files);

    	}

        // $file = $request->file('product');
        
      }

     


      return back()->with('success', 'Your article has been added successfully. Please wait for the admin to approve.');
	}

}
