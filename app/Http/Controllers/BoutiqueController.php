<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\File;
use App\Category;
use App\User;
use App\Boutique;

class BoutiqueController extends Controller
{

	public function dashboard($userID)
	{
   		$id = Auth()->user()->id;
		// $products = Product::where('userID', $id)->get();
		$user = User::find($userID);
		$boutiques = Boutique::where('userID', $userID)->get();
		// dd($user);

		foreach ($boutiques as $boutique) {
			$boutique;
		}

		return view('boutique/dashboard',compact('user', 'boutique'));
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

	public function categories($userID)
	{
		// $id = Auth()->user()->id;
		// $products = Product::where('userID', $id)->get();
		$user = User::find($userID);
		$boutiques = Boutique::where('userID', $userID)->get();
		// dd($user);

		foreach ($boutiques as $boutique) {
			$boutique;
		}

		$categories = Category::where('boutiqueID', $boutique['id'])->get();

		return view('boutique/categories',compact('user', 'boutique', 'categories'));
	}

	public function addCategories()
	{
    	$id = Auth()->user()->id;
		// $products = Product::where('userID', $id)->get();
		$user = User::find($id);
		$boutiques = Boutique::where('userID', $id)->get();
		// dd($user);

		foreach ($boutiques as $boutique) {
			$boutique;
		}

		return view('boutique/addCategories' ,compact('user', 'boutique'));
	}

	public function saveCategory(Request $request)
	{
    	$id = Auth()->user()->id;

		$category = Category::create([
			'boutiqueID' => $request->input('boutiqueID'),
			'categoryName' => $request->input('categoryName'),
			'gender' => $request->input('gender')
		]);

		return redirect('/categories/'.$id);
	}



}