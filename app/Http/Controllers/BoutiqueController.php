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
    	$random = rand();

    	foreach($uploads as $upload){
    	 // dd($file);
    	$files = new File();

    		$name = $upload->getClientOriginalName();
	        $destinationPath = public_path('uploads');
	        // $filename = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7).$file->getClientOriginalName();
	        $filename = $destinationPath.'\\'. $name;
	        $upload->move($destinationPath, $filename);

	       	$files->userID = $id;
	       	$files->batchID = $random;
	        $files->filename = "/".$name;
	      	$files->save();
    	}
      }
      // dd($files->filename);

     return view('boutique/addProductDetails', compact('files'));
      // return view('addProductDetails', compact(''));
	}

}
