<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\File;
use App\Category;
use App\User;
use App\Boutique;
use App\Rent;
use App\Tag;

class BoutiqueController extends Controller
{

	public function dashboard()
	{
		$page_title = "Dashboard";
   		$id = Auth()->user()->id;
		$user = User::find($id);
    	$boutique = Boutique::where('userID', $id)->first();

    	// foreach ($boutiques as $boutique) {
    	// 	$boutique;
    	// }

		$rents = Rent::where('boutiqueID', $boutique['id'])->get();

		foreach ($rents as $rent) {
			$rent;
		}
		// if($rent['approved_at'] != null) { 
		// 	$approvedDate = $rent['approved_at']->format('M d, Y');
		// 	$completedDate = $rent['completed_at']->format('M d, Y');
		// }else {
		// 	$approvedDate = $rent['approved_at'];
		// 	$completedDate = $rent['completed_at'];
		// }
		// $requestedDate = $rent['created_at']->format('M d, Y');

		// $customer = User::where('id', $rent['customerID'])->first();
		// $product = Product::where('productID', $rent['productID'])->first();

		// dd($rent);
        $rentArray = $rents->toArray();
        array_multisort(array_column($rentArray, "created_at"), SORT_DESC, $rentArray);


		return view('boutique/dashboard',compact('user', 'boutique', 'rents' ,'customer', 'product', 'requestedDate', 'approvedDate', 'completedDate', 'page_title')); 
	}


	// }

    public function showProducts()
	{
		$page_title = "Products";
   		$user = Auth()->user()->id;
		$boutique = Boutique::where('userID', $user)->first();
		$products = Product::where('boutiqueID', $boutique['id'])->get();
		$productCount = Product::where('boutiqueID', $boutique['id'])->get()->count();

		return view('boutique/products',compact('products', 'boutique', 'user', 'productCount', 'page_title'));
	}


	public function addProduct()
	{
		$page_title = "Add Product";
		$user = Auth()->user()->id;
		$boutiques = Boutique::where('userID', $user)->get();
		$categories = Category::all();
		$tags = Tag::all();

		foreach ($boutiques as $boutique) {
			$boutique;
		}


		return view('boutique/addProducts', compact('categories', 'boutique', 'user', 'tags', 'page_title'));
	}


	public function saveProduct(Request $request)
	{
    	$id = Auth()->user()->id;
		$boutique = Boutique::where('userID', $id)->first();
    	
    	$tags = $request->input('tags');
        $data = array();
        array_push($data, $tags);
        $data_encoded = json_encode($data);

    	$products = Product::create([
    		'boutiqueID' => $boutique['id'],
    		'productName' => $request->input('productName'),
    		'productDesc' => $request->input('productDesc'),
    		'productPrice' => $request->input('productPrice'),
    		'gender' => $request->input('gender'),
    		'category' => $request->input('category'),
    		'tags' => $data_encoded,
    		'productStatus' => "Available",
    		'forRent' => $request->input('forRent'),
    		'forSale' => $request->input('forSale'),
    		'customizable' => $request->input('customizable')
    		]);

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
		$page_title = "View Product";
		$user = Auth()->user()->id;
		$boutiques = Boutique::where('userID', $user)->get();

		$product = Product::where('productID', $productID)->first();
		$category = Category::where('id', $product['category'])->first();

		foreach ($boutiques as $boutique) {
			$boutique;
		}
		// dd($product->category);

		return view('boutique/viewProduct', compact('product', 'category', 'boutique', 'user', 'page_title'));
	}

	public function editView($productID)
	{
		$page_title = "Edit Product";
		$user = Auth()->user()->id;
		$boutiques = Boutique::where('userID', $user)->get();
		$product = Product::where('productID', $productID)->first();
		$categories = Category::all();

		foreach ($boutiques as $boutique) {
			$boutique;
		}
		foreach ($categories as $category) {
			$category;
		}

		$mensCategories = Category::where('gender', "Mens")->get();
		$womensCategories = Category::where('gender', "Womens")->get();
		// dd($womensCategories);

		return view('boutique/editView', compact('product', 'categories', 'mensCategories', 'womensCategories', 'boutique', 'user', 'page_title'));

	}

	public function editProduct($productID, Request $request)
	{
		$id = Auth()->user()->id;
		$boutique = Boutique::where('userID', $id)->first();
    	
    	$products = Product::where('productID', $productID)->update([
    		'boutiqueID' => $boutique['id'],
    		'productName' => $request->input('productName'),
    		'productDesc' => $request->input('productDesc'),
    		'productPrice' => $request->input('productPrice'),
    		'gender' => $request->input('gender'),
    		'category' => $request->input('category'),
    		'productStatus' => $request->input('productStatus'),
    		'forRent' => $request->input('forRent'),
    		'forSale' => $request->input('forSale'),
    		'customizable' => $request->input('customizable')
    		]);



    	$uploads = $request->file('file');

    	if($request->hasFile('file')) {
    	foreach($uploads as $upload){
    		$files = new File();
    		$name = $upload->getClientOriginalName();
	        $destinationPath = public_path('uploads');
	        $filename = $destinationPath.'\\'. $name;
	        $upload->move($destinationPath, $filename);

	       	$files->userID = $id;
	       	$files->productID = $products['productID'];
	        $files->filename = "/".$name;
	      	$files->save();
	      	$filename = "/".$name;
    	}
      }

      return redirect('viewproduct/'.$productID);

	}

	public function delete($productID)
	{
		$product = Product::where('productID', $productID)->delete();

		return redirect('/products');
	}

	public function madeToOrders()
	{
    	$page_title = "Made-to-Orders";
   		$id = Auth()->user()->id;
		$boutique = Boutique::where('userID', $id)->first();
		$products = Product::where('boutiqueID', $boutique['id'])->get();
		$productCount = Product::where('boutiqueID', $boutique['id'])->get()->count();


		return view('boutique/madetoorders',compact('products', 'boutique', 'user', 'productCount', 'page_title'));
	}

	public function rents()
	{
    	$page_title = "Rents";
    	$id = Auth()->user()->id;
    	$boutique = Boutique::where('userID', $id)->first();

		$rents = Rent::where('boutiqueID', $boutique['id'])->get();
		foreach ($rents as $rent) {
			$rent;
		}

		return view('boutique/rents', compact( 'rents', 'boutique', 'page_title'));
	}

	public function approveRent(Request $request)
	{
		$rentID = $request->input('rentID');
		$currentDate = date('Y-m-d');

		// dd($rentID);

		$rent = Rent::where('rentID', $rentID)->update([
			'approved_at' => $currentDate,
			'status' => "In-Progress"
		]);

		return redirect('/rents');
	}

	public function declineRent($rentID)
	{
		$rent = Rent::where('rentID', $rentID)->update([
			'status' => "Declined"
		]);

		return redirect('/rents');
	}

	


}