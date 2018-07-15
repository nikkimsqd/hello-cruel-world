<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\File;

class BoutiqueController extends Controller
{
    public function showProducts()
	{
   		$id = Auth()->user()->id;


		$products = File::where('userID', $id)->get();
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


    $files = $request->file('product');
    if($request->hasFile('product')) {
    	

    	foreach($files as $file){
    	 // dd($file);
    	$product = new Product();

    		$name = $file->getClientOriginalName();
	        $destinationPath = public_path('uploads');
	        // $filename = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7).$file->getClientOriginalName();
	        $filename = $destinationPath.'\\'. $name;
	        $file->move($destinationPath, $filename);

	        $product->productName = "/".$name;
	       	$product->userID = $id;
	      	$product->save();
    	}
      }

     
      return view('addProductDetails', compact(''));
	}

}
