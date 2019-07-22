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
use App\Declinedtransaction;
use App\Prodtag;
use App\Order;
use App\Categoryrequest;
use App\Mto;
use App\Measurementtype;
use App\Measurement;
use App\MeasurementRequest;
use App\Categorymeasurement;
use App\Province;
use App\Region;
use App\City;
use App\Barangay;
use App\RefProvince;
use App\RefRegion;
use App\RefCity;
use App\RefBrgy;
use App\Rentableproduct;
use App\Fabric;
use App\Bidding;
use App\Bid;
use App\Notifications\RentRequest;
use App\Notifications\NewCategoryRequest;
use App\Notifications\ContactCustomer;
use App\Notifications\MtoUpdateForCustomer;
use App\Notifications\RentApproved;
use App\Notifications\RentUpdateForCustomer;
use App\Notifications\BoutiqueDeclinesMto;
use App\Notifications\NotifyForAlterations;
use App\Notifications\NewBid;
use App\Notifications\NotifyCourierForPickup;
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;


class BoutiqueController extends Controller
{

	public function reqToActivateAccount()
	{
		$userID = Auth()->user()->id;
	    $user = User::find($userID);
	    $page_title = 'Request to Activate Your Account';
	    $boutique = Boutique::where('userID', $userID)->first();
	    $notifications = $user->notifications;
	    $notificationsCount = $user->unreadNotifications->count();

	    return view('boutique/reqToActivateAccount', compact('userID', 'user', 'page_title', 'biddingsCount', 'boutique', 'notificationsCount', 'notifications'));
	}

	public function reqToVerify(Request $request)
	{
		$boutiqueID = $request->input('boutiqueID');

		$boutique = Boutique::where('id', $boutiqueID)->update([
			'openingHours' => $request->input('openingHours'),
			'closingHours' => $request->input('closingHours'),
			'status' => 'Verified'
		]);

		return redirect('dashboard');
	}

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

				if($notification->type == 'App\Notifications\RentRequest'){
					$notif = $notification;
					$notification->markAsRead();

					$rent = Rent::where('rentID', $notif->data['rentID'])->first();

					// return view('boutique/rentNotification', compact('page_title', 'boutique', 'user', 'notifications', 'notificationsCount', 'rent'));
					return redirect('/rents/'.$rent['rentID']);

				}elseif ($notification->type == 'App\Notifications\NewMTO') {
					$notif = $notification;
					$notification->markAsRead();
					$mto = Mto::where('id', $notif->data['mtoID'])->first();

					// return view('boutique/mtoNotification', compact('page_title', 'boutique', 'user', 'notifications', 'notificationsCount', 'mto'));
					return redirect('/made-to-orders/'.$mto['id']);

				}elseif ($notification->type == 'App\Notifications\CustomerAcceptsOffer') {
					$notif = $notification;
					$notification->markAsRead();
					$mto = Mto::where('id', $notif->data['mtoID'])->first();

					// return view('boutique/mtoNotification', compact('page_title', 'boutique', 'user', 'notifications', 'notificationsCount', 'mto'));
					return redirect('/made-to-orders/'.$mto['id']);

				}elseif ($notification->type == 'App\Notifications\CustomerPaysOrder') {
					$notif = $notification;
					$notification->markAsRead();

					$order = Order::where('id', $notif->data['orderID'])->first();

					if($order['cartID'] != null){

						return redirect('/orders/'.$order['id']);

					}elseif($order['rentID'] != null){

						$rent = Rent::where('rentID', $order['rentID'])->first();
						return redirect('/rents/'.$rent['rentID']);

					}elseif($order['mtoID'] != null){

						$mto = Mto::where('id', $order['mtoID'])->first();
						return redirect('/made-to-orders/'.$mto['id']);

					}elseif($order['biddingID'] != null) {

						$bidding = Bidding::where('id', $order['biddingID'])->first();
						return redirect('orders/'.$bidding->order['id']);

					}
					$mto = Mto::where('id', $notif->data['orderID'])->first();

					return redirect('/made-to-orders/'.$mto['id']);

				}elseif ($notification->type == 'App\Notifications\NewOrder') {
					$notif = $notification;
					$notification->markAsRead();
					$order = Order::where('id', $notif->data['orderID'])->first();

					// return view('boutique/mtoNotification', compact('page_title', 'boutique', 'user', 'notifications', 'notificationsCount', 'mto'));
					return redirect('/orders/'.$order['id']);

				}elseif ($notification->type == 'App\Notifications\CustomerAcceptsBid') {
					$notif = $notification;
					$notification->markAsRead();
					$bidding = Bidding::where('id', $notif->data['biddingID'])->first();

					// return view('boutique/mtoNotification', compact('page_title', 'boutique', 'user', 'notifications', 'notificationsCount', 'mto'));
					return redirect('/boutique-bidding/'.$bidding['id']);

				}elseif ($notification->type == 'App\Notifications\NewBidding') {
					$notif = $notification;
					$notification->markAsRead();
					$bidding = Bidding::where('id', $notif->data['biddingID'])->first();

					// return view('boutique/mtoNotification', compact('page_title', 'boutique', 'user', 'notifications', 'notificationsCount', 'mto'));
					return redirect('/boutique-view-bidding/'.$bidding['id']);

				}
			}
		}

		
	}

	public function getnotifications()
	{
		$page_title = "Notification";
   		$id = Auth()->user()->id;
		$user = User::find($id);
    	$boutique = Boutique::where('userID', $id)->first();
		$notifications = $user->notifications;
		$notificationsCount = $user->unreadNotifications->count();
	}

	public function dashboard()
	{
		if(Auth()->user()->roles == "boutique") {
			$page_title = "Dashboard";
	   		$id = Auth()->user()->id;
			$user = User::find($id);
	    	$boutique = Boutique::where('userID', $id)->first();

	    	$orders = Order::where('boutiqueID', $boutique['id'])->where('cartID', '!=', null)->get();
			$rents = Rent::where('boutiqueID', $boutique['id'])->get();
			$mtos = Mto::where('boutiqueID', $boutique['id'])->where('orderID', '!=', null)->get();

			$orderCount = $orders->count();
			$productsCount = Product::where('boutiqueID', $boutique['id'])->count();
			$allOrders = Order::where('boutiqueID', $boutique['id'])->get();
			$customerCount = Order::where('boutiqueID', $boutique['id'])->count();

			$notifications = $user->notifications;
			$notificationsCount = $user->unreadNotifications->count();
			// dd($rand = substr(md5(microtime()),rand(0,26),5));

	        $rentArray = $rents->toArray();
	        array_multisort(array_column($rentArray, "created_at"), SORT_DESC, $rentArray);

			return view('boutique/dashboard',compact('user', 'boutique', 'rents' ,'customer', 'page_title', 'notifications', 'notificationsCount', 'orders', 'mtos', 'orderCount', 'productsCount', 'customerCount')); 
		}else {
			return redirect('/shop');
		}
	}

    public function showProducts()
	{
		if(Auth()->user()->roles == "boutique") {
			$page_title = "Products";
	   		$user = Auth()->user()->id;
			$boutique = Boutique::where('userID', $user)->first();
			$products = Product::where('boutiqueID', $boutique['id'])->get();
			$productCount = Product::where('boutiqueID', $boutique['id'])->get()->count();
			$notifications = Auth()->user()->notifications;
			$notificationsCount = Auth()->user()->unreadNotifications->count();

			return view('boutique/products', compact('products', 'boutique', 'user', 'productCount', 'page_title', 'notifications', 'notificationsCount'));
		}else {
			return redirect('/shop');
		}
	}

	public function addProduct()
	{
		if(Auth()->user()->roles == "boutique") {
			$page_title = "Add Product";
			$user = Auth()->user()->id;
			$boutique = Boutique::where('userID', $user)->first();
			$categories = Category::all();
			$tags = Tag::all();
			$notifications = Auth()->user()->notifications;
			$notificationsCount = Auth()->user()->unreadNotifications->count();
	        $regions = Region::all();
	        $cities = City::all();

			// foreach ($boutiques as $boutique) {
			// 	$boutique;
			// }


			return view('boutique/addProducts', compact('categories', 'boutique', 'user', 'tags', 'page_title', 'notifications', 'notificationsCount','regions', 'cities'));
		}else {
			return redirect('/shop');
		}
	}

	public function getProvince($regCode)
    {
        $userid = Auth()->user()->id;
        $provinces = Province::where('regCode', $regCode)->get();

        return response()->json(['provinces' => $provinces]);
    }

	public function getCity($provCode)
    {
        $userid = Auth()->user()->id;
        $cities = City::where('provCode', $provCode)->orderBy('citymunDesc', 'ASC')->get();
        
        return response()->json(['cities' => $cities]);
    }

    // public function getBrgy($citymunCode)
    // {
    //     $barangays = Barangay::where('citymunCode', $citymunCode)->orderBy('brgyDesc', 'ASC')->get();
        
    //     // $brgys = Brgy::where('citymunCode', $citymunCode)->orderBy('brgyDesc', 'ASC')->get();

    //     return response()->json(['brgys' => $barangays]);
    // }

	public function saveProduct(Request $request)
	{
    	$id = Auth()->user()->id;
		$boutique = Boutique::where('userID', $id)->first();
    	
    	$product = Product::create([
    		'boutiqueID' => $boutique['id'],
    		'productName' => $request->input('productName'),
    		'productDesc' => $request->input('productDesc'),
    		'price' => $request->input('retailPrice'),
    		'category' => $request->input('category'),
    		'productStatus' => "Available"
    		]);


    	if($request->input('rentPrice') != null){
			$locations = json_encode($request->input('locationsAvailable'));
	    	$rp = Rentableproduct::create([
	    		'price' => $request->input('rentPrice'),
	    		'depositAmount' => $request->input('depositAmount'),
	    		'penaltyAmount' => $request->input('penaltyAmount'),
	    		'limitOfDays' => $request->input('limitOfDays'),
	    		'fine' => $request->input('fine'),
	    		'locationsAvailable' => $locations
	    	]);

	    	$product->update([
	    		'rpID' => $rp['id']
	    	]);
    	}

  //   	$tags = $request->input('tags');
  //       foreach($tags as $tag) {
	 //    	Prodtag::create([
	 //    		'tagID' => $tag,
	 //    		'productID' => $product['id']
	 //    	]);
		// }


		$randomKey = str_random(10);
		// dd($randomKey);

    	$uploads = $request->file('file');
    	if($request->hasFile('file')) {
    	foreach($uploads as $upload){
    		$files = new File();
    		// $name = $upload->getClientOriginalName();
	        $destinationPath = public_path('uploads');
	        $random = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7).$upload->getClientOriginalName();
	        $filename = $destinationPath.'\\'. $random;
	        $upload->move($destinationPath, $filename);

	       	$files->userID = $id;
	       	$files->productID = $product['id'];
	        $files->filename = "/".$random;
	      	$files->save();
	      	$filename = "/".$random;
    	}
      }

     //  if($request->hasFile('file')) {
    	// foreach($uploads as $upload){
    	// 	$files = new File();
    	// 	$name = $upload->getClientOriginalName();
	    //     $destinationPath = public_path('uploads');
	    //     // $filename = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7).$file->getClientOriginalName();
	    //     $filename = $destinationPath.'\\'. $name;
	    //     $upload->move($destinationPath, $filename);

	    //    	$files->userID = $id;
	    //    	$files->productID = $product['id'];
	    //     $files->filename = "/".$name;
	    //   	$files->save();
	    //   	$filename = "/".$name;
    	// }
     //  }

    	return redirect('/products');
	}

	public function viewProduct($productID)
	{
		if(Auth()->user()->roles == "boutique") {
			$page_title = "View Product";
			$user = Auth()->user()->id;
			$boutiques = Boutique::where('userID', $user)->get();
			$product = Product::where('id', $productID)->first();
			$category = Category::where('id', $product['category'])->first();
			$tags = ProdTag::where('productID', $productID)->get();
			$notifications = Auth()->user()->notifications;
			$notificationsCount = Auth()->user()->unreadNotifications->count();

			foreach ($boutiques as $boutique) {
				$boutique;
			}

			return view('boutique/viewProduct', compact('product', 'category', 'boutique', 'user', 'page_title', 'tags', 'notifications', 
			'notificationsCount'));
		}else {
			return redirect('/shop');
		}
	}

	public function editView($productID)
	{
		if(Auth()->user()->roles == "boutique") {
			$page_title = "Edit Product";
			$user = Auth()->user()->id;
			$boutiques = Boutique::where('userID', $user)->get();
			$product = Product::where('id', $productID)->first();
			$categories = Category::all();
			$tags = Tag::all();
			$prodtags = ProdTag::where('productID', $productID)->get();
			$notifications = Auth()->user()->notifications;
			$notificationsCount = Auth()->user()->unreadNotifications->count();
	        $regions = Region::all();
	        $cities = City::all();

			foreach ($boutiques as $boutique) {
				$boutique;
			}
			foreach ($categories as $category) {
				$category;
			}

			// dd($prodtags);

			return view('boutique/editView', compact('product', 'categories', 'boutique', 'user', 'page_title', 'tags', 'prodtags', 'notifications', 'notificationsCount', 'regions', 'cities'));
			}else {
			return redirect('/shop');
		}
	}

	public function editProduct($productID, Request $request)
	{
		$id = Auth()->user()->id;
		$boutique = Boutique::where('userID', $id)->first();
		$product = Product::where('id', $productID)->first();

		$product->update([
    		'boutiqueID' => $boutique['id'],
    		'productName' => $request->input('productName'),
    		'productDesc' => $request->input('productDesc'),
    		'category' => $request->input('category'),
    		'productStatus' => $request->input('productStatus')
    		]);

		if($request->input('forRent') != null) {
			$rp = Rentableproduct::where('id', $product['rpID'])->first();

			if($rp != null){
			$locations = json_encode($request->input('locationsAvailable'));
				$rp->update([
		    		'price' => $request->input('rentPrice'),
		    		'depositAmount' => $request->input('depositAmount'),
		    		'penaltyAmount' => $request->input('penaltyAmount'),
		    		'limitOfDays' => $request->input('limitOfDays'),
		    		'fine' => $request->input('fine'),
		    		'locationsAvailable' => $locations
		    	]);

			}elseif($rp == null){
			$locations = json_encode($request->input('locationsAvailable'));
				$rp = Rentableproduct::create([
		    		'price' => $request->input('rentPrice'),
		    		'depositAmount' => $request->input('depositAmount'),
		    		'penaltyAmount' => $request->input('penaltyAmount'),
		    		'limitOfDays' => $request->input('limitOfDays'),
		    		'fine' => $request->input('fine'),
		    		'locationsAvailable' => $locations
		    	]);

		    	$product->update([
		    		'rpID' => $rp['id']
		    	]);
			}
		}else {
			$product->update([
	    		'rpID' => null
	    	]);
		}

		if($request->input('forSale') != null) {

			$product->update([
	    		'price' => $request->input('productPrice')
	    	]);

		}else {
			$product->update([
	    		'price' => null
	    	]);
		}

  //   	Prodtag::where('productID', $product['id'])->delete();
  //   	$tags = $request->input('tags');
  //       foreach($tags as $tag) {
	 //    	Prodtag::create([
	 //    		'tagID' => $tag,
	 //    		'productID' => $product['id']
	 //    	]);
		// }

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
		$product = Product::where('id', $productID)->first();

		if($product['rpID'] != null){
			$rp = Rentableproduct::where('id', $product['rpID'])->delete();
		}
		
		$product->delete();

		return redirect('/products');

	}

	public function rents()
	{
		if(Auth()->user()->roles == "boutique") {
	    	$page_title = "Rents";
	    	$id = Auth()->user()->id;
	    	$boutique = Boutique::where('userID', $id)->first();

	    	$rents = Rent::where('boutiqueID', $boutique['id'])->get();
			$pendings = Rent::where('boutiqueID', $boutique['id'])->where('status', 'Pending')->get();
			$inprogress = Rent::where('boutiqueID', $boutique['id'])->where('status', 'In-Progress')->get();
			$ondeliveries = Rent::where('boutiqueID', $boutique['id'])->where('status', 'On Delivery')->get();
			$histories = Rent::where('boutiqueID', $boutique['id'])->whereIn('status', ['Declined', 'Completed'])->get();
			// dd($pendings);
			$notifications = Auth()->user()->notifications;
			$notificationsCount = Auth()->user()->unreadNotifications->count();

			return view('boutique/rents', compact( 'pendings', 'inprogress', 'ondeliveries', 'histories', 'boutique', 'page_title', 'rents', 'notifications', 'notificationsCount'));
		}else {
			return redirect('/shop');
		}
	}

	public function getRentInfo($rentID)
	{
		if(Auth()->user()->roles == "boutique") {
			$page_title = "Rent Information";
	    	$id = Auth()->user()->id;
	    	$boutique = Boutique::where('userID', $id)->first();

			$rent = Rent::where('rentID', $rentID)->first();
        	$measurements = json_decode($rent->measurement->data);

			$notifications = Auth()->user()->notifications;
			$notificationsCount = Auth()->user()->unreadNotifications->count();
		
			return view('boutique/rentinfo', compact('rent', 'boutique', 'page_title', 'notifications', 'notificationsCount', 'measurements'));
		}else {
			return redirect('/shop');
		}
	}

	public function approveRent(Request $request)
	{
		$id = Auth()->user()->id;
    	$boutique = Boutique::where('userID', $id)->first();
		$currentDate = date('Y-m-d');
		$rentID = $request->input('rentID');
		$customerID = $request->input('customerID');
		$customer = User::where('id', $customerID)->first();
		$rent = rent::where('rentID', $rentID)->first();

		$product = Product::where('id', $rent['productID'])->update([
			'productStatus' => "Not Available"
		]);

		Rent::where('rentID', $rentID)->update([
			'approved_at' => $currentDate,
			'status' => "In-Progress"
		]);
    	

    	$customer->notify(new RentApproved($rentID, $boutique['boutiqueName']));

		return redirect('/rents/'.$rent['rentID']);
	}

	// public function updateRentInfo(Request $request)
	// {
	// 	$id = Auth()->user()->id;
 //    	$boutique = Boutique::where('userID', $id)->first();
	// 	$customerID = $request->input('customerID');
	// 	$customer = User::where('id', $customerID)->first();
	// 	$rentID = $request->input('rentID');
	// 	$rent = Rent::where('rentID', $rentID)->first();
	// 	$newTotal = $rent['total'] + $request->input('amountDeposit');
	
	// 	// dd($request->input('amountPenalty'));

	// 	$rent->update([
	// 		'dateToBeReturned' => $request->input('dateToBeReturned'),
	// 		'amountDeposit' => $request->input('amountDeposit'),
	// 		'amountPenalty' => $request->input('amountPenalty'),
	// 		'total' => $newTotal
	// 	]);
		
 //    	$customer->notify(new RentUpdateForCustomer($rentID, $boutique['boutiqueName']));

	// 	return redirect('rents/'.$rentID);
	// }

	// public function declineRent(Request $request)
	// {
	// 	$declinedrent = DeclinedRent::create([
	// 		'rentID' => $request->input('rentID'),
	// 		'reason' => $request->input('reason')
	// 	]);
	// 	// dd($declinedrent);

	// 	Rent::where('rentID', $request->input('rentID'))->update([
	// 		'status' => "Declined"
	// 	]);

	// 	return redirect('/rents');
	// }

	// public function makeOrderforRent(Request $request)
	// {
	// 	$rentID = $request->input('rentID');
	
	// 	$rent = Rent::where('rentID', $rentID)->first();
	// 	$order = Order::create([
	// 		'subtotal' => $rent['subtotal'],
	// 		'deliveryfee' => $rent['deliveryFee'],
	// 		'total' => $rent['total'],
	// 		'boutiqueID' => $rent['boutiqueID'],
	// 		'deliveryAddress' => $rent->address['id'],
	// 		'status' => 'For Pickup',
	// 		'rentID' => $rent['rentID'],
	// 		'userID' => $rent['customerID'],
	// 		'paymentStatus' => $rent['paymentStatus']
	// 	]);
	// 	// dd($order['id']);

	// 	$rent->update([
	// 		'orderID' => $order['id'],
	// 		'status' => 'For Pickup'
	// 		]);

	// 	return redirect('rents/'.$rentID);
	// }

	public function rentReturned($rentID)
	{
		$currentDate = date('Y-m-d');
		$rent = Rent::where('rentID', $rentID)->first();
        $rent->update([
        	'completed_at' => $currentDate,
            'status' => "Completed"
        ]);

        $order = Order::where('rentID', $rentID)->update([
        	'status' => "Completed"
        ]);

        Product::where('id', $rent['productID'])->update([
        	'productStatus' => "Available"
        ]);


        return redirect('/orders/'.$rent['orderID']);
	}

	public function getwomens()
	{
		if(Auth()->user()->roles == "boutique") {
			$page_title = "Womens";
	   		$user = Auth()->user()->id;
			$boutique = Boutique::where('userID', $user)->first();
			// $products = Product::where('gender', 'Womens')->get();
			$products = Product::all();
			// $productCount = Product::where('gender', 'Womens')->get()->count();
			$notifications = Auth()->user()->notifications;
			$notificationsCount = Auth()->user()->unreadNotifications->count();

			foreach($products as $product){
				dd($products->getCategory);
			}

			return view('boutique/products',compact('products', 'boutique', 'user', 'productCount', 'page_title', 'notifications', 'notificationsCount'));
		}else {
			return redirect('/shop');
		}
	}

	public function getmens()
	{
		if(Auth()->user()->roles == "boutique") {
			$page_title = "Mens";
	   		$user = Auth()->user()->id;
			$boutique = Boutique::where('userID', $user)->first();
			$products = Product::where('gender', 'Mens')->get();
			$productCount = Product::where('gender', 'Mens')->get()->count();
			$notifications = Auth()->user()->notifications;
			$notificationsCount = Auth()->user()->unreadNotifications->count();

			return view('boutique/products',compact('products', 'boutique', 'user', 'productCount', 'page_title', 'notifications', 'notificationsCount'));
		}else {
			return redirect('/shop');
		}
	}

	public function getembellishments()
	{
		if(Auth()->user()->roles == "boutique") {
			$page_title = "Embellishments";
	   		$user = Auth()->user()->id;
			$boutique = Boutique::where('userID', $user)->first();
			$products = Product::where('gender', 'Mens')->get();
			$productCount = Product::where('gender', 'Mens')->get()->count();
			$notifications = Auth()->user()->notifications;
			$notificationsCount = Auth()->user()->unreadNotifications->count();

			return view('boutique/products',compact('products', 'boutique', 'user', 'productCount', 'page_title', 'notifications', 'notificationsCount'));
		}else {
			return redirect('/shop');
		}
	}

	public function getcustomizables()
	{
		if(Auth()->user()->roles == "boutique") {
			$page_title = "Customizable Items";
	   		$user = Auth()->user()->id;
			$boutique = Boutique::where('userID', $user)->first();
			$products = Product::where('customizable', 'Yes')->get();
			$productCount = Product::where('customizable', 'Yes')->get()->count();
			$notifications = Auth()->user()->notifications;
			$notificationsCount = Auth()->user()->unreadNotifications->count();

			return view('boutique/products',compact('products', 'boutique', 'user', 'productCount', 'page_title', 'notifications', 'notificationsCount'));
		}else {
			return redirect('/shop');
		}
	}

	public function categories()
	{
		$page_title = "Categories";
		$user = Auth()->user()->id;
		$boutique = Boutique::where('userID', $user)->first();
		$categories = Category::all();
		$womens = Category::where('gender', "Womens")->get();
		$mens = Category::where('gender', "Mens")->get();

		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();

		return view('boutique/categories', compact('user', 'categories','womens', 'mens', 'page_title', 'boutique', 'notifications', 'notificationsCount'));
	}

	public function requestCategory(Request $request)
	{
		$user = Auth()->user()->id;
		$boutique = Boutique::where('userID', $user)->first();

		$categoryRequest = Categoryrequest::create([
			'boutiqueID' => $boutique['id'],
			'categoryName' => $request->input('categoryName'),
			'gender' => $request->input('gender'),
			'status' => "Pending"
		]);

		$admin = User::where('roles', 'admin')->first();
        $admin->notify(new NewCategoryRequest($categoryRequest['id']));

        return redirect('/categories');
	}

	public function tags()
	{

	}

	public function madeToOrders()
	{
    	$page_title = "Made-to-Orders";
   		$id = Auth()->user()->id;
		$boutique = Boutique::where('userID', $id)->first();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();
		$mtos = Mto::where('boutiqueID', $boutique['id'])->where('status', 'Active')->get();


		// $pendings = Mto::where('boutiqueID', $boutique['id'])->where('status', "Pending")->get();
		// $intransactions = Mto::where('boutiqueID', $boutique['id'])->where('status', "In-Transaction")->get();
		// $inprogress = Mto::where('boutiqueID', $boutique['id'])->where('status', "In-Progress")->get();

		// dd($inprogress);

		return view('boutique/madetoorders',compact('boutique', 'page_title', 'notifications', 'notificationsCount', 'mtos'));
	}

    public function getMadeToOrder($mtoID)
    {
    	$page_title = "View Made-to-Order";
        $id = Auth()->user()->id;
		$boutique = Boutique::where('userID', $id)->first();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();
		$mto = Mto::where('id', $mtoID)->first();
		$fabrics = Fabric::where('boutiqueID', $boutique['id'])->get();
        $fabs = $fabrics->groupBy('name');

		// $measurementNames = Categorymeasurement::where('categoryID', $mto['categoryID'])->get();
		$measurements = Measurement::where('typeID', $mto['id'])->first();


        return view('boutique/madetoorderInfo', compact('boutique', 'page_title', 'notifications', 'notificationsCount', 'mto', 'measurements', 'fabs', 'fabrics'));
    }

    public function halfapproveMto($mtoID)
    {
		$mto = Mto::where('id', $mtoID)->first();

		Mto::where('id', $mtoID)->update([
			'status' => 'In-Transaction'
		]);

		$customer = $mto->customer;
        $customer->notify(new ContactCustomer($mto['id'], $mto->boutique['boutiqueName']));

		return redirect('/made-to-orders/'.$mto['id']);    	
    }

    public function addPrice(Request $request)
    {
    	$mtoID = $request->input('mtoID');
		$mto = Mto::where('id', $mtoID)->first();
    	$customer = $mto->customer;
	
    	Mto::where('id', $mtoID)->update([
    		'price' => $request->input('price')
    	]);

        $customer->notify(new MtoUpdateForCustomer($mtoID, $mto->boutique['boutiqueName']));

    	return redirect('/made-to-orders/'.$mtoID);
    }

    public function recommendFabric(Request $request)
    {
    	$mtoID = $request->input('mtoID');
		$mto = Mto::where('id', $mtoID)->first();

		$fabricSuggestion = $request->input('fabricSuggestion');
        $fabSuggestion = json_encode($fabricSuggestion);
        // dd($fabSuggestion);

    	Mto::where('id', $mtoID)->update([
    		'fabricSuggestion' => $fabSuggestion
    	]);

    	$customer = $mto->customer;
        $customer->notify(new MtoUpdateForCustomer($mtoID, $mto->boutique['boutiqueName']));

    	return redirect('/made-to-orders/'.$mtoID);
    }

    public function acceptMto($mtoID)
    {
    	$mto = Mto::where('id', $mtoID)->first();
    	$mto->update([
    		'status' => 'In-Progress'
    	]);

    	return redirect('/made-to-orders/'.$mto['id']);
    }

    public function declineMto(Request $request)
    {
    	$mtoID = $request->input('mtoID');
    	$mto = Mto::where('id', $mtoID)->first();

    	$dt = Declinedtransaction::create([
    		'type' => 'mto',
    		'typeID' => $mtoID,
    		'reason' => $request->input('reason')
    	]);

    	Mto::where('id', $mtoID)->update([
    		'status' => $dt['id']
    	]);

    	$customer = User::where('id', $mto->customer['id'])->first();
        $customer->notify(new BoutiqueDeclinesMto($mto));

    	return redirect('/made-to-orders/'.$mtoID);
    }

    public function submitMTO($mtoID)
    {
    	$mto = Mto::where('id', $mtoID)->first();
    	$mto->update([
    		'status' => 'For Pickup'
    	]);

    	$order = Order::create([
    		'userID' => $mto['userID'],
    		'subtotal' => $mto['subtotal'],
    		'deliveryfee' => $mto['deliveryFee'],
    		'total' => $mto['total'],
    		'boutiqueID' => $mto['boutiqueID'],
    		'deliveryAddress' => $mto['deliveryAddress'],
    		'status' => $mto['status'],
    		'paymentStatus' => $mto['paymentStatus'],
    		'mtoID' => $mto['id']
    	]);

    	$mto->update([
    		'orderID' => $order['id']
    	]);

    	return redirect('made-to-orders/'.$mtoID);
    }

    public function getOrders()
    {
    	$page_title = "Orders";
   		$id = Auth()->user()->id;
		$boutique = Boutique::where('userID', $id)->first();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();
		$orders = Order::where('boutiqueID', $boutique['id'])->where('cartID', '!=', null)->get();

		return view('boutique/orders', compact('page_title', 'boutique', 'notifications', 'notificationsCount', 'orders'));
    }

    public function getOrder($orderID)
    {
    	$page_title = "View Order";
   		$id = Auth()->user()->id;
		$boutique = Boutique::where('userID', $id)->first();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();
		$order = Order::where('id', $orderID)->first();

		return view('boutique/orderinfo', compact('page_title', 'boutique', 'notifications', 'notificationsCount', 'order'));
    }

    public function forAlterations(Request $request)
    {
        $alterationDateStart = date('Y-m-d',strtotime($request->input('alterationDateStart')));
        $alterationDateEnd = date('Y-m-d',strtotime($request->input('alterationDateEnd')));
    	
    	$order = Order::where('id', $request->input('orderID'))->first();
    	// dd($request->input('alterationSchedule'));

    	$order->update([
    		'status' => 'For Alterations',
    		'alterationDateStart' => $alterationDateStart,
    		'alterationDateEnd' => $alterationDateEnd
    	]);

    	$customer = User::where('id', $order->customer['id'])->first();
    	$customer->notify(new NotifyForAlterations($order));

    	return redirect('orders/'.$order['id']);
    }

    public function submitOrder(Request $request)
    {
        $deliverySchedule = date('Y-m-d',strtotime($request->input('deliverySchedule')));
    	$order = Order::where('id', $request->input('orderID'))->first();

    	$order->update([
    		'status' => 'For Pickup',
    		'deliverySchedule' => $deliverySchedule
    	]);

    	$courier = User::where('roles', 'courier')->first();
    	$courier->notify(new NotifyCourierForPickup($order));

    	return redirect('/orders/'.$order['id']);
    }

  //   public function requestCustomer(Request $request)
  //   {
  //   	$id = Auth()->user()->id;
		// $boutique = Boutique::where('userID', $id)->first();
  //   	$customer = User::where('id', $request->input('customerID'))->first();

  //   	$mtoID = $request->input('mtoID');
  //   	$measurement = $request->input('measurements');
  //       $data = json_encode($measurement);

  //   	$measurementrequest = Measurementrequest::create([
  //   		'mtoID' => $mtoID,
  //   		'mtID' => $data
  //   	]);
        
  //       $customer->notify(new MeasurementRequests($measurementrequest['id'], $boutique['boutiqueName']));

  //   	return redirect('/made-to-orders/'.$mtoID);
  //   }

    public static function getPaypalOrder($orderId)
    {
    	$page_title = "Paypal Order";
   		$id = Auth()->user()->id;
		$user = User::find($id);
    	$boutique = Boutique::where('userID', $id)->first();
		$notifications = $user->notifications;
		$notificationsCount = $user->unreadNotifications->count();

    	$rent = Rent::where('paypalOrderID', $orderId)->first();
    	$mto = Mto::where('paypalOrderID', $orderId)->first();
    	// $order = Order::where('paypalOrderID', $orderId)->first();

    	if($rent != null){
    		$client = PayPalClient::client();
	        $response = $client->execute(new OrdersGetRequest($orderId));
	        $order = $response->result;

        	return view('boutique/paypalOrderDetails', compact('user', 'boutique', 'page_title', 'notifications', 'notificationsCount', 'rent', 'mto', 'order'));

    	}elseif($mto != null){
    		$client = PayPalClient::client();
	        $response = $client->execute(new OrdersGetRequest($orderId));
	        $order = $response->result;
        	
        	return view('boutique/paypalOrderDetails', compact('user', 'boutique', 'page_title', 'notifications', 'notificationsCount', 'rent', 'mto', 'order'));
    	}
    }

    public function fabrics()
    {
    	$page_title = "Fabrics";
   		$id = Auth()->user()->id;
		$user = User::find($id);
    	$boutique = Boutique::where('userID', $id)->first();
		$notifications = $user->notifications;
		$notificationsCount = $user->unreadNotifications->count();
		$fabrics = Fabric::where('boutiqueID', $boutique['id'])->get();

    	return view('boutique/fabrics', compact('user', 'boutique', 'page_title', 'notifications', 'notificationsCount', 'fabrics'));
    }

    public function addFabric(Request $request)
    {
   		$id = Auth()->user()->id;
    	$boutique = Boutique::where('userID', $id)->first();

    	$name = ucfirst($request->input('fabricName'));
    	$color = ucfirst($request->input('fabricColor'));
    	// $nameQueries = Fabric::where('name', $name)->get();
    	// $colorQuery = Fabric::where('color', $color)->first();

	    	// dd($colorQuery);
	    // if(empty($nameQuery) && !empty($colorQuery)){
	    // 	dd($nameQuery);
	    // }
	    // elseif($nameQuery != null && $colorQuery != null){
	    // 	dd($colorQuery);
	    // }else{
	    // 	dd("oops");
	    // }

	    // if($nameQuery['id'] != $colorQuery['id']){
	    	Fabric::create([
	    		'boutiqueID' => $boutique['id'],
	    		'name' => $name,
	    		'color' => $color
	    	]);
	    // }

    	// if($nameQuery == null && $colorQuery == null){
	    // 	Fabric::create([
	    // 		'boutiqueID' => $boutique['id'],
	    // 		'name' => $name,
	    // 		'color' => $color
	    // 	]);
	    // }elseif($nameQuery != null && $colorQuery == null){
	    // 	Fabric::create([
	    // 		'boutiqueID' => $boutique['id'],
	    // 		'name' => $name,
	    // 		'color' => $color
	    // 	]);
	    // }

    	return redirect('/fabrics');
    }

    public function deleteFabric($fabricID)
    {
    	Fabric::where('id', $fabricID)->delete($fabricID);

    	return redirect('fabrics');
    }

    public function biddings()
    {
        $userID = Auth()->user()->id;
		$user = User::find($userID);
        $page_title = 'Biddings';
        $biddingsCount = Bidding::all()->count();
    	$boutique = Boutique::where('userID', $userID)->first();
        $biddings = Bidding::where('status', 'Open')->get();
        $notifications = $user->notifications;
		$notificationsCount = $user->unreadNotifications->count();

        return view('boutique/view-biddings', compact('user', 'page_title', 'userID', 'biddingsCount', 'boutique', 'biddings', 'notificationsCount', 'notifications'));
    }

    public function viewBidding($biddingID)
    {
    	$userID = Auth()->user()->id;
		$user = User::find($userID);
        $page_title = 'Biddings';
        $products = [];
        $biddingsCount = Bidding::all()->count();
    	$boutique = Boutique::where('userID', $userID)->first();
        $notifications = $user->notifications;
		$notificationsCount = $user->unreadNotifications->count();
    	$bidding = Bidding::where('id', $biddingID)->first();
    	$bid = Bid::where('biddingID', $biddingID)->where('boutiqueID', $boutique['id'])->first();
    	// dd($bid);

    	return view('boutique/viewBidding', compact('user', 'page_title', 'products', 'categories', 'cart', 'cartCount', 'userID', 'biddingsCount', 'boutique', 'bidding', 'bid', 'notificationsCount', 'notifications'));
    }

    public function submitBid(Request $request)
    {

    	$biddingID = $request->input('biddingID');
 		$userID = Auth()->user()->id;
		$user = User::find($userID);
    	$boutique = Boutique::where('userID', $userID)->first();
    	$bidding = Bidding::where('id', $biddingID)->first();
    	// $bid = Bid::where('boutiqueID', $boutique['id'])->where('biddingID', $bidding['id'])->first();

    	$bid = Bid::create([
    		'biddingID' => $biddingID,
    		'boutiqueID' => $boutique['id'],
    		'bidAmount' => $request->input('bidAmount'),
    		'plans' => $request->input('plans')
    	]);

    	$customer = User::where('id', $bidding->owner['id'])->first();
    	$customer->notify(new NewBid($bidding));

    	return redirect('boutique-view-bidding/'.$biddingID.'#bidSubmitted'); //for modal unta pero di sya mo work huhu
    }

    public function updateBid(Request $request)
    {

    	$biddingID = $request->input('biddingID');
 		$userID = Auth()->user()->id;
		$user = User::find($userID);
    	$boutique = Boutique::where('userID', $userID)->first();
    	$bidding = Bidding::where('id', $biddingID)->first();
    	$bid = Bid::where('boutiqueID', $boutique['id'])->where('biddingID', $bidding['id'])->first();
    	// dd($bid);

		$bid->update([
			'bidAmount' =>$request->input('bidAmount'),
    		'plans' => $request->input('plans')
		]);

    	$customer = User::where('id', $bidding->owner['id'])->first();
    	$customer->notify(new NewBid($bidding));

    	return redirect('boutique-bidding/'.$biddingID.'#bidSubmitted');
    }

    public function boutiqueBiddings()
    {
    	$userID = Auth()->user()->id;
	    $user = User::find($userID);
	    $page_title = 'Orders from Bidding';
	    $boutique = Boutique::where('userID', $userID)->first();
	    $notifications = $user->notifications;
	    $notificationsCount = $user->unreadNotifications->count();
	    $biddingOrders = Order::where('biddingID', '!=', null)->where('boutiqueID', $boutique['id'])->get();

	    return view('boutique/boutique-biddings', compact('userID', 'user', 'page_title', 'boutique', 'notificationsCount', 'notifications', 'biddingOrders'));
    }

    public function viewBoutiqueBidding($biddingID)
    {
    	$userID = Auth()->user()->id;
	    $user = User::find($userID);
	    $page_title = 'Orders from Bidding';
	    $boutique = Boutique::where('userID', $userID)->first();
	    $notifications = $user->notifications;
	    $notificationsCount = $user->unreadNotifications->count();
	    $bidding = Bidding::where('id', $biddingID)->first();

	    return view('boutique/boutique-biddingInfo', compact('userID', 'user', 'page_title', 'boutique', 'notificationsCount', 'notifications', 'bidding'));
    }

    public function archiveOrders()
    {
    	$page_title = "Archive Orders";
   		$id = Auth()->user()->id;
		$boutique = Boutique::where('userID', $id)->first();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();
		$orders = Order::where('boutiqueID', $boutique['id'])->where('cartID', '!=', null)->where('status', 'Completed')->get();

		return view('boutique/archiveorders', compact('page_title', 'boutique', 'notifications', 'notificationsCount', 'orders'));
    }

    public function archiveRents()
    {
    	$page_title = "Archive Rents";
    	$id = Auth()->user()->id;
    	$boutique = Boutique::where('userID', $id)->first();

    	$rents = Rent::where('boutiqueID', $boutique['id'])->get();
		$pendings = Rent::where('boutiqueID', $boutique['id'])->where('status', 'Pending')->get();
		$inprogress = Rent::where('boutiqueID', $boutique['id'])->where('status', 'In-Progress')->get();
		$ondeliveries = Rent::where('boutiqueID', $boutique['id'])->where('status', 'On Delivery')->get();
		$histories = Rent::where('boutiqueID', $boutique['id'])->whereIn('status', ['Declined', 'Completed'])->get();
		// dd($pendings);
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();

		return view('boutique/archiverents', compact( 'pendings', 'inprogress', 'ondeliveries', 'histories', 'boutique', 'page_title', 'rents', 'notifications', 'notificationsCount'));
    }

    public function archiveMtos()
    {
    	$page_title = "Archive Made-to-Orders";
   		$id = Auth()->user()->id;
		$boutique = Boutique::where('userID', $id)->first();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();
		$mtos = Mto::where('boutiqueID', $boutique['id'])->get();
		

		return view('boutique/archivemtos',compact('boutique', 'page_title', 'notifications', 'notificationsCount', 'mtos'));
    }

    public function archiveBiddings()
    {
    	$userID = Auth()->user()->id;
	    $user = User::find($userID);
	    $page_title = 'Archive Orders from Bidding';
	    $boutique = Boutique::where('userID', $userID)->first();
	    $notifications = $user->notifications;
	    $notificationsCount = $user->unreadNotifications->count();
	    $biddingOrders = Order::where('biddingID', '!=', null)->where('boutiqueID', $boutique['id'])->where('status', 'Completed')->get();

	    return view('boutique/archiveboutique-biddings', compact('userID', 'user', 'page_title', 'boutique', 'notificationsCount', 'notifications', 'biddingOrders'));
    }


}