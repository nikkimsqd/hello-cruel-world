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
use App\DeclinedRent;
use App\Prodtag;
use App\Order;
use App\Notifications\RentRequest;


class BoutiqueController extends Controller
{

	public function viewNotifications($notificationID)
	{
		$page_title = "Notification";
   		$id = Auth()->user()->id;
		$user = User::find($id);
    	$boutique = Boutique::where('userID', $id)->first();
		$notifications = $user->notifications;
		$notificationsCount = $user->unreadNotifications->count();
		// dd($notifications);

		foreach($notifications as $notification) {
			if($notification->id == $notificationID) {
				$notif = $notification;
				$notification->markAsRead();
				// dd($notif);
				// break;
			} else {
				
			}
		}

		$rents = Rent::where('rentID', $notif->data['rentID'])->get();
		foreach ($rents as $rent) {
			$rent;
		}


		return view('boutique/viewNotification', compact('page_title', 'boutique', 'user', 'notifications', 'notificationsCount', 'rent'));
	}

	public function dashboard()
	{
		$page_title = "Dashboard";
   		$id = Auth()->user()->id;
		$user = User::find($id);
    	$boutique = Boutique::where('userID', $id)->first();

		$rents = Rent::where('boutiqueID', $boutique['id'])->get();

		$notifications = $user->notifications;
		$notificationsCount = $user->unreadNotifications->count();

		// foreach($notifications as $notification) {
		// 	foreach ($notification['data'] as $value) {
		// 		dd($notification['data']);
		// 	}
		// }

        $rentArray = $rents->toArray();
        array_multisort(array_column($rentArray, "created_at"), SORT_DESC, $rentArray);

		return view('boutique/dashboard',compact('user', 'boutique', 'rents' ,'customer', 'product', 'requestedDate', 'approvedDate', 'completedDate', 'page_title', 'notifications', 'notificationsCount')); 
	}

    public function showProducts()
	{
		$page_title = "Products";
   		$user = Auth()->user()->id;
		$boutique = Boutique::where('userID', $user)->first();
		$products = Product::where('boutiqueID', $boutique['id'])->get();
		$productCount = Product::where('boutiqueID', $boutique['id'])->get()->count();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();

		return view('boutique/products',compact('products', 'boutique', 'user', 'productCount', 'page_title', 'notifications', 'notificationsCount'));
	}

	public function addProduct()
	{
		$page_title = "Add Product";
		$user = Auth()->user()->id;
		$boutiques = Boutique::where('userID', $user)->get();
		$categories = Category::all();
		$tags = Tag::all();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();

		foreach ($boutiques as $boutique) {
			$boutique;
		}


		return view('boutique/addProducts', compact('categories', 'boutique', 'user', 'tags', 'page_title', 'notifications', 'notificationsCount'));
	}

	public function saveProduct(Request $request)
	{
    	$id = Auth()->user()->id;
		$boutique = Boutique::where('userID', $id)->first();
    	
    	$products = Product::create([
    		'boutiqueID' => $boutique['id'],
    		'productName' => $request->input('productName'),
    		'productDesc' => $request->input('productDesc'),
    		'productPrice' => $request->input('productPrice'),
    		'rentPrice' => $request->input('rentPrice'),
    		'gender' => $request->input('gender'),
    		'category' => $request->input('category'),
    		'productStatus' => "Available",
    		'forRent' => $request->input('forRent'),
    		'forSale' => $request->input('forSale'),
    		'customizable' => $request->input('customizable')
    		]);


    	$tags = $request->input('tags');

        foreach($tags as $tag) {
	    	Prodtag::create([
	    		'tagID' => $tag,
	    		'productID' => $products['productID']
	    	]);
		}

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
		$tags = ProdTag::where('productID', $productID)->get();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();

		foreach ($boutiques as $boutique) {
			$boutique;
		}

		return view('boutique/viewProduct', compact('product', 'category', 'boutique', 'user', 'page_title', 'tags', 'notifications', 
			'notificationsCount'));
	}

	public function editView($productID)
	{
		$page_title = "Edit Product";
		$user = Auth()->user()->id;
		$boutiques = Boutique::where('userID', $user)->get();
		$product = Product::where('productID', $productID)->first();
		$categories = Category::all();
		$tags = Tag::all();
		$prodtags = ProdTag::where('productID', $productID)->get();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();

		foreach ($boutiques as $boutique) {
			$boutique;
		}
		foreach ($categories as $category) {
			$category;
		}

		$mensCategories = Category::where('gender', "Mens")->get();
		$womensCategories = Category::where('gender', "Womens")->get();
		// dd($womensCategories);

		return view('boutique/editView', compact('product', 'categories', 'mensCategories', 'womensCategories', 'boutique', 'user', 'page_title', 'tags', 'prodtags', 'notifications', 'notificationsCount'));
	}

	public function editProduct($productID, Request $request)
	{
		$id = Auth()->user()->id;
		$boutique = Boutique::where('userID', $id)->first();

		if($request->input('forRent') == null) {
			$rentPrice = null;
		}else {
			$rentPrice = $request->input('rentPrice');
		}

		if($request->input('forSale') == null) {
			$productPrice = null;
		}else {
			$productPrice = $request->input('productPrice');
		}
    	
    	$products = Product::where('productID', $productID)->update([
    		'boutiqueID' => $boutique['id'],
    		'productName' => $request->input('productName'),
    		'productDesc' => $request->input('productDesc'),
    		'productPrice' => $productPrice,
    		'rentPrice' => $rentPrice,
    		'gender' => $request->input('gender'),
    		'category' => $request->input('category'),
    		'productStatus' => $request->input('productStatus'),
    		'forRent' => $request->input('forRent'),
    		'forSale' => $request->input('forSale'),
    		'customizable' => $request->input('customizable')
    		]);


    	$uploads = $request->file('file');

    	if($request->hasFile('file')) {
    	File::where('productID', $productID)->delete();
    	
    	foreach($uploads as $upload){
    		$files = new File();
    		$name = $upload->getClientOriginalName();
	        $destinationPath = public_path('uploads');
	        $filename = $destinationPath.'\\'. $name;
	        $upload->move($destinationPath, $filename);

	       	$files->userID = $id;
	       	$files->productID = $productID;
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
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();

		return view('boutique/madetoorders',compact('products', 'boutique', 'user', 'productCount', 'page_title', 'notifications', 'notificationsCount'));
	}

	public function rents()
	{
    	$page_title = "Rents";
    	$id = Auth()->user()->id;
    	$boutique = Boutique::where('userID', $id)->first();

    	$rents = Rent::where('boutiqueID', $boutique['id'])->get();
		$pendings = Rent::where('boutiqueID', $boutique['id'])->where('status', 'Pending')->get();
		$inprogress = Rent::where('boutiqueID', $boutique['id'])->where('status', 'In-Progress')->get();
		$histories = Rent::where('boutiqueID', $boutique['id'])->whereIn('status', ['Declined', 'Completed'])->get();
		// dd($pendings);
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();

		return view('boutique/rents', compact( 'pendings', 'inprogress', 'histories', 'boutique', 'page_title', 'rents', 'notifications', 'notificationsCount'));
	}

	public function getRentInfo($rentID)
	{
		$page_title = "Rent Information";
    	$id = Auth()->user()->id;
    	$boutique = Boutique::where('userID', $id)->first();

		$rent = Rent::where('rentID', $rentID)->first();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();
	
		return view('boutique/rentinfo', compact('rent', 'boutique', 'page_title', 'notifications', 'notificationsCount'));
	}

	public function approveRent(Request $request)
	{
		$rentID = $request->input('rentID');
		$currentDate = date('Y-m-d');
		$rent = rent::where('rentID', $rentID)->first();

		$product = Product::where('productID', $rent['productID'])->update([
			'productStatus' => "Not Available"
		]);

		Rent::where('rentID', $rentID)->update([
			'approved_at' => $currentDate,
			'status' => "In-Progress"
		]);

		return redirect('/rents');
	}

	public function updateRentInfo(Request $request)
	{
		$rentID = $request->input('rentID');
	
		Rent::where('rentID', $rentID)->update([
			'dateToBeReturned' => $request->input('dateToBeReturned')
		]);

		return redirect('rents/'.$rentID);
	}

	public function declineRent(Request $request)
	{
		$declinedrent = DeclinedRent::create([
			'rentID' => $request->input('rentID'),
			'reason' => $request->input('reason')
		]);
		// dd($declinedrent);

		Rent::where('rentID', $request->input('rentID'))->update([
			'status' => "Declined"
		]);

		return redirect('/rents');
	}

	public function makeOrderforRent(Request $request)
	{
		$rentID = $request->input('rentID');
		// dd($rentID);
	
		$rent = Rent::where('rentID', $rentID)->first();
		Order::create([
			'subtotal' => $rent['subtotal'],
			'deliveryfee' => $rent['deliveryFee'],
			'total' => $rent['total'],
			'boutiqueID' => $rent['boutiqueID'],
			'deliveryAddress' => $rent->address['completeAddress'],
			'status' => 'For Delivery',
			'rentID' => $rent['rentID']
		]);

		return redirect('rents/'.$rentID);
	}

	public function getwomens()
	{
		$page_title = "Womens";
   		$user = Auth()->user()->id;
		$boutique = Boutique::where('userID', $user)->first();
		$products = Product::where('gender', 'Womens')->get();
		$productCount = Product::where('gender', 'Womens')->get()->count();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();

		return view('boutique/products',compact('products', 'boutique', 'user', 'productCount', 'page_title', 'notifications', 'notificationsCount'));
	}

	public function getmens()
	{
		$page_title = "Mens";
   		$user = Auth()->user()->id;
		$boutique = Boutique::where('userID', $user)->first();
		$products = Product::where('gender', 'Mens')->get();
		$productCount = Product::where('gender', 'Mens')->get()->count();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();

		return view('boutique/products',compact('products', 'boutique', 'user', 'productCount', 'page_title', 'notifications', 'notificationsCount'));
	}

	public function getembellishments()
	{
		$page_title = "Embellishments";
   		$user = Auth()->user()->id;
		$boutique = Boutique::where('userID', $user)->first();
		$products = Product::where('gender', 'Mens')->get();
		$productCount = Product::where('gender', 'Mens')->get()->count();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();

		return view('boutique/products',compact('products', 'boutique', 'user', 'productCount', 'page_title', 'notifications', 'notificationsCount'));
	}

	public function getcustomizables()
	{
		$page_title = "Customizable Items";
   		$user = Auth()->user()->id;
		$boutique = Boutique::where('userID', $user)->first();
		$products = Product::where('customizable', 'Yes')->get();
		$productCount = Product::where('customizable', 'Yes')->get()->count();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();

		return view('boutique/products',compact('products', 'boutique', 'user', 'productCount', 'page_title', 'notifications', 'notificationsCount'));
	}


}