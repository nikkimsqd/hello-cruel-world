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

    $uploads = $request->file('product');
    if($request->hasFile('product')) {
    	

    	foreach($uploads as $upload){
    	 // dd($upload);
    	$files = new File();

    		$name = $upload->getClientOriginalName();
	        $destinationPath = public_path('uploads');
	        // $filename = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7).$file->getClientOriginalName();
	        $filename = $destinationPath.'\\'. $name;
	        $upload->move($destinationPath, $filename);

	        $files->filename = "/".$name;
	       	$files->userID = $id;
	       	$files->batchID = rand();
	      	$files->save();
    	}
      }

    // dd($products); 	
    // return view('boutique/addProductDetails', compact('products'));
      return redirect('/addProductDetails', compact('products'));
	}

}
