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
use App\Itemtag;
use App\Order;
use App\Categoryrequest;
use App\Mto;
use App\Measurementtype;
use App\Measurement;
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
use App\Set;
use App\Setitem;
use App\Measurementrequest;
use App\Rtw;
use App\Paypalaccount;
use App\Payout;
use App\Categorytag;
use App\Courier;
use App\Ordercourier;
use App\Alteration;
use App\Complain;
use App\Email; //???????????????? wagtangon ni
use App\Chat;
use App\Dispute;
use App\Subcategory;
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
use App\Notifications\MeasurementRequests;
use App\Notifications\RentDeclined;
use App\Notifications\NotifyAdminForPickup;
use App\Notifications\NotifyCustomerOfChat;
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

		$allOrders = Order::where('boutiqueID', $boutique['id'])->get();
		$complains = array();
		foreach($allOrders as $allOrder){
			$complainsCounts = Complain::where('orderID', $allOrder['id'])->where('status', 'Active')->first();
			if($complainsCounts != null){
				array_push($complains, $complainsCounts);
			}
		}
		$complainsCount = count($complains);

	    return view('boutique/reqToActivateAccount', compact('userID', 'user', 'page_title', 'biddingsCount', 'boutique', 'notificationsCount', 'notifications', 'complainsCount'));
	}

	public function reqToVerify(Request $request)
	{
		$boutiqueID = $request->input('boutiqueID');
		$operatingDays = json_encode($request->input('operatingDays'));
		// dd($request->input('operatingDays'));

		$boutique = Boutique::where('id', $boutiqueID)->update([
			'openingHours' => $request->input('openingHours'),
			'closingHours' => $request->input('closingHours'),
			'operatingDays' => $operatingDays,
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

		$allOrders = Order::where('boutiqueID', $boutique['id'])->get();
		$complains = array();
		foreach($allOrders as $allOrder){
			$complainsCounts = Complain::where('orderID', $allOrder['id'])->where('status', 'Active')->first();
			if($complainsCounts != null){
				array_push($complains, $complainsCounts);
			}
		}
		$complainsCount = count($complains);

		foreach($notifications as $notification) {
			if($notification->id == $notificationID) {

				if($notification->type == 'App\Notifications\RentRequest'){
					$notif = $notification;
					$notification->markAsRead();

					$rent = Rent::where('id', $notif->data['rentID'])->first();

					// return view('boutique/rentNotification', compact('page_title', 'boutique', 'user', 'notifications', 'notificationsCount', 'rent'));
					return redirect('/rents/'.$rent['id']);

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

                    $transactionID = explode("_", $order['transactionID']);
                    $type = $transactionID[0];

                    if($type == 'MTO'){
						$mto = Mto::where('id', $order['transactionID'])->first();
                        return redirect('/made-to-orders/'.$mto['id']);

                    }elseif($type == 'CART'){
                        return redirect('/orders/'.$order['id']);

                    }elseif($type == 'RENT'){
						$rent = Rent::where('rentID', $order['transactionID'])->first();
                        return redirect('/rents/'.$rent['id']);

                    }elseif($type == 'BIDD'){
						$bidding = Bidding::where('id', $order['transactionID'])->first();
                        return redirect('/orders/'.$bidding['id']);
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

					return redirect('/boutique-bidding/'.$bidding['id']);

				}elseif ($notification->type == 'App\Notifications\NewBidding') {
					$notif = $notification;
					$notification->markAsRead();
					$bidding = Bidding::where('id', $notif->data['biddingID'])->first();

					return redirect('/boutique-view-bidding/'.$bidding['id']);

				}elseif ($notification->type == 'App\Notifications\AdminAcceptsCategoryRequest') {
					$notif = $notification;
					$notification->markAsRead();
					$catReq = Categoryrequest::where('id', $notif->data['catReqID'])->first();

					return redirect('/categories');

				}elseif ($notification->type == 'App\Notifications\AdminDeclinesCategoryRequest') {
					$notif = $notification;
					$notification->markAsRead();
					$catReq = Categoryrequest::where('id', $notif->data['catReqID'])->first();

					return redirect('/categories');

				}elseif ($notification->type == 'App\Notifications\PayoutReleased') {
					$notif = $notification;
					$notification->markAsRead();
					$payout = Payout::where('id', $notif->data['payoutID'])->first();

					$data = "Payout has been released. Check it out now.";

					return view('boutique/viewNotification', compact('page_title', 'user', 'boutique', 'notifications', 'notificationsCount', 'data', 'complainsCount'));
					// return redirect('/categories');

				}elseif ($notification->type == 'App\Notifications\RequestPaypalAccount') {
					$notif = $notification;
					$notification->markAsRead();
					$payout = Payout::where('id', $notif->data['orderID'])->first();

					$data = "You are about to receive your payout. Please add your PayPal account to continue.";

					return view('boutique/viewNotification', compact('page_title', 'user', 'boutique', 'notifications', 'notificationsCount', 'data', 'complainsCount'));
					// return redirect('/categories');

				}elseif ($notification->type == 'App\Notifications\NotifyBoutiqueOfChat') {
					$notif = $notification;
					$notification->markAsRead();
					
					$chat = Chat::where('id', $notification->data['chatID'])->first();
                    $order = Order::where('id', $chat['orderID'])->first();


					return redirect('/orders/'.$order['id'].'#chat');
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

		$allOrders = Order::where('boutiqueID', $boutique['id'])->get();
		$complains = array();
		foreach($allOrders as $allOrder){
			$complainsCounts = Complain::where('orderID', $allOrder['id'])->where('status', 'Active')->first();
			if($complainsCounts != null){
				array_push($complains, $complainsCounts);
			}
		}
		$complainsCount = count($complains);

		return view('boutique/viewNotification', compact('page_title', 'user', 'boutique', 'notifications', 'notificationsCount', 'complainsCount'));
	}

	public function dashboard()
	{
		if(Auth()->user()->roles == "boutique") {
			$page_title = "Dashboard";
	   		$id = Auth()->user()->id;
			$user = User::find($id);
	    	$boutique = Boutique::where('userID', $id)->first();

	    	$orders = Order::where('boutiqueID', $boutique['id'])->get();
			// $rents = Rent::where('boutiqueID', $boutique['id'])->get();
			// $mtos = Mto::where('boutiqueID', $boutique['id'])->where('orderID', '!=', null)->get();

			$orderCount = $orders->count();
			$productsCount = Product::where('boutiqueID', $boutique['id'])->count();
			// $allOrders = Order::where('boutiqueID', $boutique['id'])->get();
			$customerCount = Order::where('boutiqueID', $boutique['id'])->count();

			$notifications = $user->notifications;
			$notificationsCount = $user->unreadNotifications->count();
			// dd($rand = substr(md5(microtime()),rand(0,26),5));


	        // $rentArray = $rents->toArray();
	        // array_multisort(array_column($rentArray, "created_at"), SORT_DESC, $rentArray);

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

			$allOrders = Order::where('boutiqueID', $boutique['id'])->get();
			$complains = array();
			foreach($allOrders as $allOrder){
				$complainsCounts = Complain::where('orderID', $allOrder['id'])->where('status', 'Active')->first();
				if($complainsCounts != null){
					array_push($complains, $complainsCounts);
				}
			}
			$complainsCount = count($complains);

			return view('boutique/products', compact('products', 'boutique', 'user', 'productCount', 'page_title', 'notifications', 'notificationsCount', 'complainsCount'));
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
			// $tags = Tag::all();
			$notifications = Auth()->user()->notifications;
			$notificationsCount = Auth()->user()->unreadNotifications->count();
	        $regions = Region::all();
	        $cities = City::all();
            $categories = Category::all();
	        $categoryGenders = $categories->groupBy('gender');

			$allOrders = Order::where('boutiqueID', $boutique['id'])->get();
			$complains = array();
			foreach($allOrders as $allOrder){
				$complainsCounts = Complain::where('orderID', $allOrder['id'])->where('status', 'Active')->first();
				if($complainsCounts != null){
					array_push($complains, $complainsCounts);
				}
			}
			$complainsCount = count($complains);


			return view('boutique/addProducts', compact('categories', 'boutique', 'user', 'tags', 'page_title', 'notifications', 'notificationsCount','regions', 'cities', 'categoryTags', 'complainsCount'));
		}else {
			return redirect('/shop');
		}
	}

	public function getCategoryTags($categoryID)
	{
	        $categoryTags = Categorytag::where('categoryID', $categoryID)->get();
	        // $categoryTagGender = $categoryTags->groupBy('categoryID');

	        return response()->json([
	        	'categoryTags' => $categoryTags
	        ]);
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
		$category = $request->input('category');

		//CREATE ID FOR PRODUCT --------------------------------------------------------
		$product = Product::orderBy('created_at', 'DESC')->first();
		if(empty($product)){
			$productID = 'PROD_001';
		}else{
        	$prodID = explode("_", $product['id']);
        	$idInt = (int) $prodID[1];
        	$idInt++;
        	if($idInt <= 9){
        		$productID = 'PROD_00'.$idInt;
        	}elseif($idInt <= 99){
        		$productID = 'PROD_0'.$idInt;
        	}else{
        		$productID = 'PROD_'.$idInt;
        	}
		}
		//------------------------------------------------------------------------------
	    	
		//TO ADD ITEM ON DATABASE ------------------------------------------------------
    	$product = Product::create([
    		'id' => $productID,
    		'boutiqueID' => $boutique['id'],
    		'productName' => $request->input('productName'),
    		'productDesc' => $request->input('productDesc'),
    		'price' => $request->input('retailPrice'),
    		'category' => $request->input('subcategory'),
    		'productStatus' => "Available",
    		'quantity' => $request->input('quantity')
    		]);
		//------------------------------------------------------------------------------


		//TO ADD RENT DETAILS IF ITEM IS AVAILABLE FOR RENT ----------------------------
    	if($request->input('rentPrice') != null){
	    	$rp = Rentableproduct::create([
	    		'price' => $request->input('rentPrice'),
	    		'cashban' => $request->input('cashban'),
	    		'penaltyAmount' => $request->input('penaltyAmount'),
	    		'limitOfDays' => $request->input('limitOfDays'),
	    		'fine' => $request->input('fine')
	    	]);

	    	$product->update([
	    		'rpID' => $rp['id']
	    	]);
    	}
		//------------------------------------------------------------------------------


		//TO KNOW IF  ITEM IS FOR RTW OR NOT -------------------------------------------
    	if($request->input('itemType') == 'yes'){
			$sizes = $request->input('sizes');
			foreach($sizes as $key => $value){
				if(empty($value)){
					unset($sizes[$key]);
				}
			}
    		$sizesJson = json_encode($sizes);

    		$rtw = Rtw::create([
    			'productID' => $product['id'],
    			'sizes' => $sizesJson
    		]);

    		$product->update([
    			'rtwID' => $rtw['id']
    		]);
    		// dd('u here');

    	}elseif($request->input('itemType') == 'no'){

		// if($request->input("$category") != null){
	    	$measurementNames = $request->input("$category");
			$measurementNamesArray = array();

			foreach($measurementNames as $measurementName => $measurement){
				array_push($measurementNamesArray, $measurementName);
			}

			$mNameJson = json_encode($measurementNamesArray);
	    	
	    	$measurementData = $request->input('measurementData');
	    	$mjson = json_encode($measurementData);
	    // }

    		$product->update([
				'measurementNames' => $mNameJson,
				'measurements' => $mjson
    		]);
    	}
		//------------------------------------------------------------------------------

		// FOR TAGS --------------------------------------------------------------------
		$tags = $request->input('tags');
		$tagjson = json_encode($tags);

		Tag::create([
			'itemID' => $product['id'],
			'tags' => $tagjson
		]);
		//------------------------------------------------------------------------------

		// FOR FILE UPLOAD -------------------------------------------------------------
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
	       	$files->typeID = $product['id'];
	        $files->filepath = "/".$random;
	      	$files->save();
	      	$filename = "/".$random;
    	}
      }
		//------------------------------------------------------------------------------

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
			$tags = Tag::where('itemID', $productID)->first();
			$notifications = Auth()->user()->notifications;
			$notificationsCount = Auth()->user()->unreadNotifications->count();

			foreach ($boutiques as $boutique) {
				$boutique;
			}

			$allOrders = Order::where('boutiqueID', $boutique['id'])->get();
			$complains = array();
			foreach($allOrders as $allOrder){
				$complainsCounts = Complain::where('orderID', $allOrder['id'])->where('status', 'Active')->first();
				if($complainsCounts != null){
					array_push($complains, $complainsCounts);
				}
			}
			$complainsCount = count($complains);
			$tagsArray = json_decode($tags['tags']);
			$rtwSizes = json_decode($product->rtwDetails['sizes']);

			return view('boutique/viewProduct', compact('product', 'category', 'boutique', 'user', 'page_title', 'tagsArray', 'notifications', 
			'notificationsCount', 'complainsCount', 'rtwSizes'));
		}else {
			return redirect('/shop');
		}
	}

	public function editView($productID)
	{
		if(Auth()->user()->roles == "boutique") {
			$page_title = "Edit Product";
			$user = Auth()->user()->id;
			$boutique = Boutique::where('userID', $user)->first();
			$product = Product::where('id', $productID)->first();
			$categories = Category::all();
			$subcategories = Subcategory::all();
			// $tags = Categorytag::where('categoryID', $product->getCategory['id'])->get();
			$itemtags = Itemtag::where('itemID', $productID)->get();
			$notifications = Auth()->user()->notifications;
			$notificationsCount = Auth()->user()->unreadNotifications->count();
	        $regions = Region::all();
	        $cities = City::all();
	        $tags = Tag::where('itemID', $productID)->first();
	        $tags = json_decode($tags['tags']);
	        // dd($tags);


			$allOrders = Order::where('boutiqueID', $boutique['id'])->get();
			$complains = array();
			foreach($allOrders as $allOrder){
				$complainsCounts = Complain::where('orderID', $allOrder['id'])->where('status', 'Active')->first();
				if($complainsCounts != null){
					array_push($complains, $complainsCounts);
				}
			}
			$complainsCount = count($complains);
			$rtwSizes = json_decode($product->rtwDetails['sizes']);

			

			return view('boutique/editView', compact('product', 'categories', 'boutique', 'user', 'page_title', 'tags', 'itemtags', 'notifications', 'notificationsCount', 'regions', 'cities', 'complainsCount', 'rtwSizes', 'subcategories'));
			}else {
			return redirect('/shop');
		}
	}

	public function editProduct($productID, Request $request)
	{
		// dd($request->input());
		$id = Auth()->user()->id;
		$boutique = Boutique::where('userID', $id)->first();
		$product = Product::where('id', $productID)->first();
		$category = $request->input('category');
	
		// dd($category);

		$product->update([
    		'productName' => $request->input('productName'),
    		'productDesc' => $request->input('productDesc'),
    		'category' => $request->input('subcategory'),
    		'productStatus' => $request->input('productStatus'),
			'quantity' => $request->input('quantity')
    		]);

		//TO ADD RENT DETAILS IF ITEM IS AVAILABLE FOR RENT ----------------------------
		if($request->input('forRent') != null){
			$rp = Rentableproduct::where('id', $product['rpID'])->first();

			if($rp != null){
				$rp->update([
		    		'price' => $request->input('rentPrice'),
		    		'depositAmount' => $request->input('depositAmount'),
		    		'penaltyAmount' => $request->input('penaltyAmount'),
		    		'limitOfDays' => $request->input('limitOfDays'),
		    		'fine' => $request->input('fine'),
		    	]);

			}elseif($rp == null){
				$rp = Rentableproduct::create([
		    		'price' => $request->input('rentPrice'),
		    		'depositAmount' => $request->input('depositAmount'),
		    		'penaltyAmount' => $request->input('penaltyAmount'),
		    		'limitOfDays' => $request->input('limitOfDays'),
		    		'fine' => $request->input('fine'),
		    	]);

		    	$product->update([
		    		'rpID' => $rp['id']
		    	]);
			}
		}elseif($request->input('forRent') == null){
			$product->update([
	    		'rpID' => null
	    	]);
		}

		if($request->input('forSale') != null){
			$product->update([
	    		'price' => $request->input('productPrice'),
	    	]);
		}elseif($request->input('forSale') == null){
			$product->update([
	    		'price' => null
	    	]);
		}
		//------------------------------------------------------------------------------

		//TO KNOW IF  ITEM IS FOR RTW OR NOT -------------------------------------------
		if($request->input('itemType') == 'yes'){
			$rtw = Rtw::where('id', $product['rtwID'])->first();

			$sizes = $request->input('sizes');
			foreach($sizes as $key => $value){
				if(empty($value)){
					unset($sizes[$key]);
				}
			}

    		$sizesJson = json_encode($sizes);

			if($rtw != null){
				$rtw->update([
    				'sizes' => $sizesJson
				]);

				$product->update([
					'measurements' => null,
					'measurementNames' => null
				]);
			}else{
	    		$rtw = Rtw::create([
					'productID' => $product['id'],
	    			'sizes' => $sizesJson
	    		]);

				$product->update([
					'rtwID' => $rtw['id'],
					'measurements' => null,
					'measurementNames' => null
				]);
			}

		}elseif($request->input('itemType') == 'no'){

	    	$measurementNames = $request->input("$category");
			$measurementNamesArray = array();

			// dd($category);
			foreach($measurementNames as $measurementName => $measurement){
				array_push($measurementNamesArray, $measurementName);
			}

			$mNameJson = json_encode($measurementNamesArray);
	    	
	    	$measurementData = $request->input('measurementData');
	    	$mjson = json_encode($measurementData);

	    	// if($product['rtwID'] != null)

			$product->update([
				'measurementNames' => $mNameJson,
				'measurements' => $mjson,
				'rtwID' => null
			]);
		}
		//------------------------------------------------------------------------------

	
		// FOR TAGS --------------------------------------------------------------------
		$tags = $request->input('tags');
		$tagjson = json_encode($tags);

		Tag::where('itemID', $productID)->update([
			'tags' => $tagjson
		]);
		//------------------------------------------------------------------------------

		// FOR FILE UPLOAD -------------------------------------------------------------
    	$uploads = $request->file('file');
    	if($request->hasFile('file')) {
    	File::where('typeID', $productID)->delete();
    	
    	foreach($uploads as $upload){
    		$files = new File();
	        $destinationPath = public_path('uploads');
        	$random = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7).$upload->getClientOriginalName();
	        $filename = $destinationPath.'\\'. $random;
	        $upload->move($destinationPath, $filename);

	       	$files->userID = $id;
	       	$files->typeID = $productID;
	        $files->filepath = "/".$random;
	      	$files->save();
	      	$filename = "/".$random;
    	}
      	}
		//------------------------------------------------------------------------------

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

	public function deleteSet($setID)
	{
		$set = Set::where('id', $setID)->first();

		if($set['rpID'] != null){
			$rp = Rentableproduct::where('id', $set['rpID'])->delete();
		}
		
		$set->delete();

		return redirect('/sets');

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

			$allOrders = Order::where('boutiqueID', $boutique['id'])->get();
			$complains = array();
			foreach($allOrders as $allOrder){
				$complainsCounts = Complain::where('orderID', $allOrder['id'])->where('status', 'Active')->first();
				if($complainsCounts != null){
					array_push($complains, $complainsCounts);
				}
			}
			$complainsCount = count($complains);

			return view('boutique/rents', compact( 'pendings', 'inprogress', 'ondeliveries', 'histories', 'boutique', 'page_title', 'rents', 'notifications', 'notificationsCount', 'complainsCount'));
		}else {
			return redirect('/shop');
		}
	}

	public function getRentInfo($rentID)
	{
		if(Auth()->user()->roles == "boutique") {
			$page_title = "Rent Details";
	    	$id = Auth()->user()->id;
	    	$boutique = Boutique::where('userID', $id)->first();
			$rent = Rent::where('id', $rentID)->first();
        	$measurements = json_decode($rent->measurement->data);
			$notifications = Auth()->user()->notifications;
			$notificationsCount = Auth()->user()->unreadNotifications->count();
			$categories = Category::all();
        	$mrequests = Measurementrequest::where('type', 'bidding')->where('typeID', $rentID)->get();

			$allOrders = Order::where('boutiqueID', $boutique['id'])->get();
			$complains = array();
			foreach($allOrders as $allOrder){
				$complainsCounts = Complain::where('orderID', $allOrder['id'])->where('status', 'Active')->first();
				if($complainsCounts != null){
					array_push($complains, $complainsCounts);
				}
			}
			$complainsCount = count($complains);
		
			return view('boutique/rentinfo', compact('rent', 'boutique', 'page_title', 'notifications', 'notificationsCount', 'measurements', 'categories', 'mrequests', 'complainsCount'));
		}else {
			return redirect('/shop');
		}
	}

	public function approveRent($rentID)
	{
		$id = Auth()->user()->id;
    	$boutique = Boutique::where('userID', $id)->first();
		$currentDate = date('Y-m-d');
		$rent = Rent::where('id', $rentID)->first();
		$customer = User::where('id', $rent['customerID'])->first();
		$order = Order::where('transactionID', $rentID)->first();


		$rent->update([
            'orderID' => $order['id'],
			'approved_at' => $currentDate,
			'status' => "Approved"
		]);
    	

    	$customer->notify(new RentApproved($rentID, $boutique['boutiqueName']));

		return redirect('/rents/'.$rent['id']);
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

	public function declineRent(Request $request)
	{
		$rentID = $request->input('rentID');
		$rent = Rent::where('id', $rentID)->first();
		$dt = Declinedtransaction::create([
			'type' => 'rent',
			'typeID' => $rentID,
			'reason' => $request->input('reason')
		]);
		// dd($declinedrent);

		Rent::where('id', $rentID)->update([
			'status' => $dt['id']
		]);


    	$customer = User::where('id', $rent->customer['id'])->first();
        $customer->notify(new RentDeclined($rent));

		return redirect('/rents/'.$rentID);
	}

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

		$allOrders = Order::where('boutiqueID', $boutique['id'])->get();
		$complains = array();
		foreach($allOrders as $allOrder){
			$complainsCounts = Complain::where('orderID', $allOrder['id'])->where('status', 'Active')->first();
			if($complainsCounts != null){
				array_push($complains, $complainsCounts);
			}
		}
		$complainsCount = count($complains);

		return view('boutique/categories', compact('user', 'categories','womens', 'mens', 'page_title', 'boutique', 'notifications', 'notificationsCount', 'complainsCount'));
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

		$allOrders = Order::where('boutiqueID', $boutique['id'])->get();
		$complains = array();
		foreach($allOrders as $allOrder){
			$complainsCounts = Complain::where('orderID', $allOrder['id'])->where('status', 'Active')->first();
			if($complainsCounts != null){
				array_push($complains, $complainsCounts);
			}
		}
		$complainsCount = count($complains);

		// dd($inprogress);

		return view('boutique/madetoorders',compact('boutique', 'page_title', 'notifications', 'notificationsCount', 'mtos', 'complainsCount'));
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
        $wearersCounter = 0;

        if($mto['numOfPerson'] != "equals"){
			$nameOfWearers = json_decode($mto['nameOfWearers']); 
			foreach($nameOfWearers as $nameOfWearer){ 
        		$wearersCounter++;
			}
			// dd($wearersCounter);
		}

		$categories = Category::all();
        $mrequests = Measurementrequest::where('type', 'mto')->where('typeID', $mto)->get();

		$allOrders = Order::where('boutiqueID', $boutique['id'])->get();
		$complains = array();
		foreach($allOrders as $allOrder){
			$complainsCounts = Complain::where('orderID', $allOrder['id'])->where('status', 'Active')->first();
			if($complainsCounts != null){
				array_push($complains, $complainsCounts);
			}
		}
		$complainsCount = count($complains);

        return view('boutique/madetoorderInfo', compact('boutique', 'page_title', 'notifications', 'notificationsCount', 'mto', 'measurements', 'fabs', 'fabrics', 'categories', 'mrequests', 'nameOfWearer', 'complainsCount', 'wearersCounter'));
    }

  //   public function halfapproveMto($mtoID)
  //   {
		// $mto = Mto::where('id', $mtoID)->first();

		// Mto::where('id', $mtoID)->update([
		// 	'status' => 'In-Transaction'
		// ]);

		// $customer = $mto->customer;
  //       $customer->notify(new ContactCustomer($mto['id'], $mto->boutique['boutiqueName']));

		// return redirect('/made-to-orders/'.$mto['id']);    	
  //   }

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

		// $fabSuggestion = $request->input('fabricSuggestion');
        // $fabSuggestion = json_encode($fabricSuggestion);
        // dd($fabSuggestion);

    	Mto::where('id', $mtoID)->update([
    		'price' => $request->input('price'),
    		'fabSuggestion' => $request->input('fabSuggestion')
    	]);

    	$customer = $mto->customer;
        $customer->notify(new MtoUpdateForCustomer($mtoID, $mto->boutique['boutiqueName']));

    	return redirect('/made-to-orders/'.$mtoID);
    }

    // public function acceptMto($mtoID)
    // {
    // 	$mto = Mto::where('id', $mtoID)->first();
    // 	$mto->update([
    // 		'status' => 'In-Progress'
    // 	]);

    // 	return redirect('/made-to-orders/'.$mto['id']);
    // }

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
		$orders = Order::where('boutiqueID', $boutique['id'])->where('transactionID', '!=', null)->get();

		$allOrders = Order::where('boutiqueID', $boutique['id'])->get();
		$complains = array();
		foreach($allOrders as $allOrder){
			$complainsCounts = Complain::where('orderID', $allOrder['id'])->where('status', 'Active')->first();
			if($complainsCounts != null){
				array_push($complains, $complainsCounts);
			}
		}
		$complainsCount = count($complains);

		return view('boutique/orders', compact('page_title', 'boutique', 'notifications', 'notificationsCount', 'orders', 'complainsCount'));
    }

    public function getOrder($orderID)
    {
    	$page_title = "View Order";
   		$id = Auth()->user()->id;
		$boutique = Boutique::where('userID', $id)->first();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();
		$order = Order::where('id', $orderID)->first();

		$complaint = Complain::where('orderID', $order['id'])->first();

		// $allOrders = Order::where('boutiqueID', $boutique['id'])->get();
		// $complains = array();
		// foreach($allOrders as $allOrder){
		// 	$complainsCounts = Complain::where('orderID', $allOrder['id'])->where('status', 'Active')->first();
		// 	if($complainsCounts != null){
		// 		array_push($complains, $complainsCounts);
		// 	}
		// }
		// $complainsCount = count($complains);

		$chats = Chat::where('orderID', $orderID)->get();

		return view('boutique/orderinfo', compact('page_title', 'id', 'boutique', 'notifications', 'notificationsCount', 'order', 'complaint', 'chats'));
    }

    public function forAlterations(Request $request)
    {
        $alterationDateStart = date('Y-m-d',strtotime($request->input('alterationDateStart')));
        $alterationDateEnd = date('Y-m-d',strtotime($request->input('alterationDateEnd')));
    	
    	$order = Order::where('id', $request->input('orderID'))->first();
    	// dd($request->input('alterationSchedule'));

    	$alteration = Alteration::create([
    		'dateStart' => $alterationDateStart,
    		'dateEnd' => $alterationDateEnd,
    		'status' => 'Pending'
    	]);

    	$order->update([
    		'alterationID' => $alteration['id'],
    		'status' => 'For Alterations'
    	]);
    	// dd($alteration);

    	$customer = User::where('id', $order->customer['id'])->first();
    	$customer->notify(new NotifyForAlterations($order));

    	return redirect('orders/'.$order['id']);
    }

    public function updateAlteration($alterationID, $data)
    {
    	$alteration = Alteration::where('id', $alterationID)->first();

    	if($data == 'Yes'){
    		$alteration->update([
	    		'status' => 'used'
	    	]);
    	}else{
    		$alteration->update([
	    		'status' => 'unused'
	    	]);
    	}
    }

    public function submitOrder(Request $request) //for pickup
    {
        $deliverySchedule = date('Y-m-d',strtotime($request->input('deliverySchedule')));
    	$order = Order::where('id', $request->input('orderID'))->first();
    	$couriers = Courier::all();
    	$courierCounter = $couriers->count();

    	$orderCourier = Ordercourier::orderBy('created_at', 'desc')->first(); //expected ang last ang makuha

    	if($orderCourier != null){
			$id = $orderCourier['courierID']; //sud ug variable
    		$courierID = $id + 1; //last then added 1 para ang next

    		if($courierID <= $courierCounter){ //para dili ma lapas ang pag add sa courierID
	    		foreach($couriers as $courier){
	    			if($courier['id'] == $courierID){
	    				if($courier['status'] == 'Active'){
	    					$courierID == $courier['id'];
	    				}else{
	    					if($courierID < $courierCounter){ //para di ma lapas ang id nga kwaon
	    						$courierID += 1;
	    					}else{
	    						$courierID = 1;
	    					}
	    				}
	    			}
	    		}
	    	}else{
				$courierID = 1;
	    	}

    		Ordercourier::create([
    			'courierID' => $courierID
    		]);

    	}else{ //if wala pay data sa Ordercouriers table
    		$courier = Courier::where('id', 1)->first();
    		$courierID = $courier['id'];

    		Ordercourier::create([
    			'courierID' => $courierID
    		]);
    	}


    	$order->update([
    		'status' => 'For Pickup',
    		'deliverySchedule' => $deliverySchedule,
    		'courierID' => $courierID
    	]);

    	$courier = Courier::where('id', $courierID)->first();
    	$courierUser = User::where('id', $courier['userID'])->first();
    	$courierUser->notify(new NotifyCourierForPickup($order));

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

    	$rent = Order::where('paypalOrderID', $orderId)->first();
    	$mto = Order::where('mtoID', '1')->where('paypalOrderID', $orderId)->first();
    	// $order = Order::where('paypalOrderID', $orderId)->first();

    	if($rent != null){
    		$client = PayPalClient::client();
	        $response = $client->execute(new OrdersGetRequest($orderId));
	        $order = $response->result;
	        // dd($order);

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
    	$bidsCount = Bid::where('biddingID', $biddingID)->count();
    	// dd($bid);
        $nameOfWearers = json_decode($bidding['nameOfWearers']); 
        $wearersCounter = 0;
        if($nameOfWearers != null){
	        foreach($nameOfWearers as $nameOfWearer){
	        	$wearersCounter++;
	        }
	    }
        // dd($nameOfWearers);


    	return view('boutique/view-bidding', compact('user', 'page_title', 'products', 'categories', 'cart', 'cartCount', 'userID', 'biddingsCount', 'boutique', 'bidding', 'bid', 'notificationsCount', 'notifications', 'bidsCount', 'wearersCounter'));
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
    		'quotationPrice' => $request->input('quotationPrice'),
    		'fabricName' => $request->input('fabricName')
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
			'quotationPrice' =>$request->input('quotationPrice'),
    		'fabricName' => $request->input('fabricName')
		]);

    	$customer = User::where('id', $bidding->owner['id'])->first();
    	$customer->notify(new NewBid($bidding));

    	return redirect('boutique-view-bidding/'.$biddingID.'#bidSubmitted');
    }

    public function boutiqueBiddings()
    {
    	$userID = Auth()->user()->id;
	    $user = User::find($userID);
	    $page_title = 'Orders from Bidding';
	    $boutique = Boutique::where('userID', $userID)->first();
	    $notifications = $user->notifications;
	    $notificationsCount = $user->unreadNotifications->count();
	    $biddingOrders = Order::where('boutiqueID', $boutique['id'])->where('status', '!=', 'Completed')->get();

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

	    $categories = Category::all();
        $mrequests = Measurementrequest::where('type', 'bidding')->where('typeID', $biddingID)->get();
	    

	    return view('boutique/boutique-biddingInfo', compact('userID', 'user', 'page_title', 'boutique', 'notificationsCount', 'notifications', 'bidding', 'categories', 'mrequests'));
    }

    public function bids()
    {
        $userID = Auth()->user()->id;
		$user = User::find($userID);
        $page_title = 'Bids';
        $biddingsCount = Bidding::all()->count();
    	$boutique = Boutique::where('userID', $userID)->first();
        $bids = Bid::where('boutiqueID', $boutique['id'])->get();
        $notifications = $user->notifications;
		$notificationsCount = $user->unreadNotifications->count();

        return view('boutique/bids', compact('user', 'page_title', 'userID', 'biddingsCount', 'boutique', 'bids', 'notificationsCount', 'notifications'));
    }

    public function requestMeasurement(Request $request)
    {
    	$category = $request->input('category');

    	// foreach($category as $cat){
    	// 	$measurements = $request->input("$cat");
    	// 	$measurementsArray = array();
    	// 	foreach($measurements as $measurementName => $measurement){
    	// 		array_push($measurementsArray, $measurementName);
    	// 	}
    	// 	$mjson = json_encode($measurementsArray);
    	// 	dd($mjson);
    	// }

    	if($request->input('biddingID') != null){
    		$transactionID = $request->input('biddingID');
    		$bidding = Bidding::where('id', $transactionID)->first();
	    	foreach($category as $cat){
		    	$mr = Measurementrequest::create([
		    		'type' => 'bidding',
		    		'typeID' => $transactionID,
		    		'categoryID' => $cat,
		    	]);

		    	$measurements = $request->input("$cat");
	    		$measurementsArray = array();

	    		foreach($measurements as $measurementName => $measurement){
	    			array_push($measurementsArray, $measurementName);
	    		}

	    		$mjson = json_encode($measurementsArray);

	    		$mr->update([
	    			'measurements' => $mjson
	    		]);
	    	}


	    	$transactionType = 'bidding';
	    	$boutique = Boutique::where('id', $bidding->bid->boutiqueID)->first();
	    	$customer = User::where('id', $bidding->owner['id'])->first();
	    	$customer->notify(new MeasurementRequests($transactionID, $boutique, $transactionType));

	    	return redirect('boutique-bidding/'.$transactionID);

    	}elseif($request->input('mtoID') != null){
    		$transactionID = $request->input('mtoID');
    		$mto = Mto::where('id', $transactionID)->first();
    		foreach($category as $cat){
		    	$mr = Measurementrequest::create([
		    		'type' => 'mto',
		    		'typeID' => $transactionID,
		    		'categoryID' => $cat,
		    	]);

		    	$measurements = $request->input("$cat");
	    		$measurementsArray = array();

	    		foreach($measurements as $measurementName => $measurement){
	    			array_push($measurementsArray, $measurementName);
	    		}

	    		$mjson = json_encode($measurementsArray);

	    		$mr->update([
	    			'measurements' => $mjson
	    		]);
	    	}

	    	$transactionType = 'mto';
	    	$boutique = Boutique::where('id', $mto['boutiqueID'])->first();
	    	$customer = User::where('id', $mto->customer['id'])->first();
	    	$customer->notify(new MeasurementRequests($transactionID, $boutique, $transactionType));

	    	return redirect('made-to-orders/'.$transactionID);
    	}

    }

    public function archiveOrders()
    {
    	$page_title = "Archive Orders";
   		$id = Auth()->user()->id;
		$boutique = Boutique::where('userID', $id)->first();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();
		$orders = Order::where('boutiqueID', $boutique['id'])->where('status', 'Completed')->get();

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
	    $biddingOrders = Order::where('boutiqueID', $boutique['id'])->where('status', 'Completed')->get();

	    return view('boutique/archiveboutique-biddings', compact('userID', 'user', 'page_title', 'boutique', 'notificationsCount', 'notifications', 'biddingOrders'));
    }

    public function showSets()
    {
		$page_title = "Sets";
   		$user = Auth()->user()->id;
		$boutique = Boutique::where('userID', $user)->first();
		$sets = Set::where('boutiqueID', $boutique['id'])->get();
		$setCount = $sets->count();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();

		// dd($sets[0]->items[0]->product->productFile);

		return view('boutique/sets', compact('sets', 'boutique', 'user', 'setCount', 'page_title', 'notifications', 'notificationsCount'));
    }

    public function addset()
    {
		$page_title = "Add Set";
		$user = Auth()->user()->id;
		$boutique = Boutique::where('userID', $user)->first();
		$products = Product::where('boutiqueID', $boutique['id'])->where('rtwID', '!=', null)->get();
		$categories = Category::all();
		// $tags = Categorytag::all();
		// dd($categories);
	        // $categoryGenders = $categories->groupBy('gender');

		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();
        $cities = City::all();


		return view('boutique/addSets', compact('categories', 'boutique', 'user', 'tags', 'page_title', 'notifications', 'notificationsCount', 'cities', 'sets', 'products'));
    }

    public function saveset(Request $request)
    {
		//CREATE ID FOR SET --------------------------------------------------------
		$set = Set::orderBy('created_at', 'DESC')->first();
		if(empty($set)){
			$setID = 'SET_001';
		}else{
        	$oldID = explode("_", $set['id']);
        	$idInt = (int) $oldID[1];
        	$idInt++;
        	if($idInt <= 9){
        		$setID = 'SET_00'.$idInt;
        	}elseif($idInt <= 99){
        		$setID = 'SET_0'.$idInt;
        	}else{
        		$setID = 'SET_'.$idInt;
        	}
		}
		//------------------------------------------------------------------------------

    	$id = Auth()->user()->id;
		$boutique = Boutique::where('userID', $id)->first();

		$set = Set::create([
			'id' => $setID,
			'boutiqueID' => $boutique['id'],
			'setName' => $request->input('setName'),		
			'setDesc' => $request->input('setDesc'),		
			'price' => $request->input('retailPrice'),
			'quantity' => $request->input('quantity'),
			'setStatus' => "Available"
		]);

		if($request->input('rentPrice') != null){
			// $locations = json_encode($request->input('locationsAvailable'));
	    	$rp = Rentableproduct::create([
	    		'price' => $request->input('rentPrice'),
	    		'cashban' => $request->input('cashban'),
	    		'penaltyAmount' => $request->input('penaltyAmount'),
	    		'limitOfDays' => $request->input('limitOfDays'),
	    		'fine' => $request->input('fine')
	    		// 'locationsAvailable' => $locations
	    	]);

	    	$set->update([
	    		'rpID' => $rp['id']
	    	]);
    	}


		$products = $request->input('products');
        foreach($products as $product) {
	    	Setitem::create([
	    		'setID' => $set['id'],
	    		'productID' => $product
	    	]);
		}

		// FOR TAGS --------------------------------------------------------------------
		$tags = $request->input('tags');
		$tagjson = json_encode($tags);

		Tag::create([
			'itemID' => $set['id'],
			'tags' => $tagjson
		]);
		//------------------------------------------------------------------------------

		return redirect('/sets');
    }

	public function viewset($setID)
	{
		$page_title = "View Set";
		$user = Auth()->user()->id;
		$boutiques = Boutique::where('userID', $user)->get();
		$notifications = Auth()->user()->notifications;
		$notificationsCount = Auth()->user()->unreadNotifications->count();

		$set = Set::where('id', $setID)->first();
		$tags = Tag::where('itemID', $setID)->first();
		$tagsArray = json_decode($tags['tags']);

		// $product = Product::where('id', $productID)->first();
		// $category = Category::where('id', $product['category'])->first();
		// $tags = Itemtag::where('productID', $productID)->get();


		foreach ($boutiques as $boutique) {
			$boutique;
		}

		return view('boutique/viewSet', compact('boutique', 'user', 'page_title', 'notifications', 
		'notificationsCount', 'set', 'tagsArray'));
	}

	public function editViewSet($setID)
	{
		if(Auth()->user()->roles == "boutique") {
			$page_title = "Edit Set";
			$user = Auth()->user()->id;
			$notifications = Auth()->user()->notifications;
			$notificationsCount = Auth()->user()->unreadNotifications->count();
			$boutique = Boutique::where('userID', $user)->first();

			$set = Set::where('id', $setID)->first();
			$products = Product::where('boutiqueID', $boutique['id'])->where('rtwID', '!=', null)->get(); // option products
			$categories = Category::all();

	        $setItems = array(); //storage of existing items on a set

			$tags = Tag::where('itemID', $setID)->first();
          	$tagsArray = json_decode($tags['tags']);
			foreach($set->items as $item){
	        	array_push($setItems, $item['productID']);
	        }


			return view('boutique/editViewSet', compact('set', 'boutique', 'user', 'page_title', 'tagsArray', 'notifications', 'notificationsCount', 'products', 'setItems'));
		}else {
			return redirect('/shop');
		}
	}

	public function editSet(Request $request)
	{
		$id = Auth()->user()->id;
		$boutique = Boutique::where('userID', $id)->first();
		$setID = $request->input('setID');

		// $itemtags = Itemtag::where('itemID', $setID)->where('itemType', 'set')->get();
		// dd($itemtags);

		$set = Set::where('id', $setID)->first();
		$set->update([
			'boutiqueID' => $boutique['id'],
			'setName' => $request->input('setName'),		
			'setDesc' => $request->input('setDesc'),		
			'price' => $request->input('retailPrice'),
			'quantity' => $request->input('quantity'),
			'setStatus' => "Available"
		]);

		if($request->input('rentPrice') != null){
	    	$rp = Rentableproduct::where('id', $set['rpID'])->first();

	    	if(!empty($rp)){
		    	$rp->update([
		    		'price' => $request->input('rentPrice'),
		    		'cashban' => $request->input('cashban'),
		    		'penaltyAmount' => $request->input('penaltyAmount'),
		    		'limitOfDays' => $request->input('limitOfDays'),
		    		'fine' => $request->input('fine'),
		    	]);
	    	}else{
	    		$rp = Rentableproduct::create([
		    		'price' => $request->input('rentPrice'),
		    		'cashban' => $request->input('cashban'),
		    		'penaltyAmount' => $request->input('penaltyAmount'),
		    		'limitOfDays' => $request->input('limitOfDays'),
		    		'fine' => $request->input('fine'),
	    		]);

		    	$set->update([
		    		'rpID' => $rp['id']
		    	]);
	    	}
    	}

    	$setItems = Setitem::where('setID', $setID)->get();
    	foreach($setItems as $setItem){
    		$setItem->delete(); //delete existing set items
    	}

		$products = $request->input('products'); //add new selected items on set
        foreach($products as $product) {
	    	Setitem::create([
	    		'setID' => $setID,
	    		'productID' => $product
	    	]);
		}

		// FOR TAGS --------------------------------------------------------------------
		$tags = $request->input('tags');
		$tagjson = json_encode($tags);

		Tag::where('itemID', $setID)->update([
			'tags' => $tagjson
		]);
		//------------------------------------------------------------------------------

		return redirect('/viewset/'.$setID);

	}

	public function getProductsforSet($categoryID, $subcategoryID)
	{
		$user = Auth()->user()->id;
		$boutique = Boutique::where('userID', $user)->first();
		// $category = Category::where('id', $categoryID)->first();
		$subcategory = Subcategory::where('id', $subcategoryID)->first();
		$products = Product::where('boutiqueID', $boutique['id'])->where('category', $subcategory['id'])->where('rtwID', '!=', null)->with('productFile')->get();
		$productsArray = array();

        $productURL = array();


		foreach($products as $product){
            $productURL[$product['id']][] = $product->productFile[0]['filepath'];
			array_push($productsArray, $product); //
		}
		// dd($products);

		return response()->json([
			'productsArray' => $productsArray,
			'productURL' => $productURL
		]);
	}

	public function getProductforSet($productID)
	{
        $productURL = array();
		$product = Product::where('id', $productID)->with('productFile')->with('rtwDetails')->first();
        $productURL[$productID][] = $product->productFile[0]['filepath'];
        $rtwSizes = $product->rtwDetails['sizes'];
        $sizes = array();

        	$sizes = json_decode($rtwSizes);
        	// array_push($sizes, 'xs');

        // dd($sizes);
		return response()->json([
			'product' => $product,
			'productURL' => $productURL,
			'rtwSizes' => $rtwSizes,
			'sizes' => $sizes
		]);
	}

	public function boutiqueProfile()
	{
   		$id = Auth()->user()->id;
		$user = User::find($id);
    	$boutique = Boutique::where('userID', $id)->first();
		$page_title = 'Profile';
		$notifications = $user->notifications;
		$notificationsCount = $user->unreadNotifications->count();

		$allOrders = Order::where('boutiqueID', $boutique['id'])->get();
		$complains = array();
		foreach($allOrders as $allOrder){
			$complainsCounts = Complain::where('orderID', $allOrder['id'])->where('status', 'Active')->first();
			if($complainsCounts != null){
				array_push($complains, $complainsCounts);
			}
		}
		$complainsCount = count($complains);

		return view('boutique/boutique-profile', compact('page_title', 'user', 'boutique', 'notifications', 'notificationsCount', 'complainsCount'));
	}

	public function paypalAccount()
	{
   		$id = Auth()->user()->id;
		$user = User::find($id);
    	$boutique = Boutique::where('userID', $id)->first();
		$page_title = 'Profile';
		$notifications = $user->notifications;
		$notificationsCount = $user->unreadNotifications->count();
		$paypalAccount = Paypalaccount::where('id', $boutique['paypalAccountID'])->first();

		$allOrders = Order::where('boutiqueID', $boutique['id'])->get();
		$complains = array();
		foreach($allOrders as $allOrder){
			$complainsCounts = Complain::where('orderID', $allOrder['id'])->where('status', 'Active')->first();
			if($complainsCounts != null){
				array_push($complains, $complainsCounts);
			}
		}
		$complainsCount = count($complains);

		return view('boutique/paypal-account', compact('page_title', 'user', 'boutique', 'notifications', 'notificationsCount', 'paypalAccount', 'complainsCount'));

	}

	public function updatePaypalAccount(Request $request)
	{
		$boutiqueID = $request->input('boutiqueID');
		$boutique = Boutique::where('id', $boutiqueID)->first();

		$paypalAccount = Paypalaccount::where('id', $boutique['paypalEmail'])->update([
			'paypalEmail' => $request->input('paypalEmail')
		]);
		dd($paypalAccount);

		$boutique = Boutique::where('id', $boutiqueID)->update([
			'paypalAccountID' => $paypalAccount['id']
		]);
	}

	public function addPaypalAccount(Request $request)
	{
		$boutiqueID = $request->input('boutiqueID');
		$boutique = Boutique::where('id', $boutiqueID)->first();

		$paypalAccount = Paypalaccount::create([
			'boutiqueID' => $boutiqueID,
			'paypalEmail' => $request->input('paypalEmail')
		]);

		$boutique->update([
			'paypalAccountID' => $paypalAccount['id']
		]);

		return redirect('/paypal-account');
	}

  //   public function complaints()
  //   {
		// $page_title = "Complaints";
  //  		$user = Auth()->user()->id;
		// $boutique = Boutique::where('userID', $user)->first();
		// $notifications = Auth()->user()->notifications;
		// $notificationsCount = Auth()->user()->unreadNotifications->count();

		// $allOrders = Order::where('boutiqueID', $boutique['id'])->get();
		// $complains = array();
		// foreach($allOrders as $allOrder){
		// 	$complainsCounts = Complain::where('orderID', $allOrder['id'])->where('status', 'Active')->first();
		// 	if($complainsCounts != null){
		// 		array_push($complains, $complainsCounts);
		// 	}
		// }
		// $complainsCount = count($complains);
		// // dd($complains);
        
  //       return view('boutique/complaints', compact('page_title', 'user', 'boutique', 'notifications', 'notificationsCount', 'complainsCount', 'complains'));
  //   }

  //   public function viewComplaint($complainID)
  //   {
		// $page_title = "Complaint";
  //  		$user = Auth()->user()->id;
		// $boutique = Boutique::where('userID', $user)->first();
		// $notifications = Auth()->user()->notifications;
		// $notificationsCount = Auth()->user()->unreadNotifications->count();
		// $complain = Complain::where('id', $complainID)->first();
        
		// $allOrders = Order::where('boutiqueID', $boutique['id'])->get();
		// $complains = array();
		// foreach($allOrders as $allOrder){
		// 	$complainsCounts = Complain::where('orderID', $allOrder['id'])->where('status', 'Active')->first();
		// 	if($complainsCounts != null){
		// 		array_push($complains, $complainsCounts);
		// 	}
		// }
		// $complainsCount = count($complains);

  //       return view('boutique/viewComplaint', compact('page_title', 'user', 'boutique', 'notifications', 'notificationsCount', 'complainsCount', 'complain', 'complains'));
  //   }

  //   public function mailbox()
  //   {
		// $page_title = "Mailbox";
  //  		$user = Auth()->user()->id;
		// $boutique = Boutique::where('userID', $user)->first();
		// $notifications = Auth()->user()->notifications;
		// $notificationsCount = Auth()->user()->unreadNotifications->count();
		// $emails = Email::where('recipientID', $user)->where('location', 'inbox')->get();
		// $inboxCount = count(Email::where('recipientID', $user)->where('location', 'inbox')->where('status', 'unread')->get());
		// $datetime = date('Y-m-d H:i:s');
		// // dd($datetime);

  //       return view('boutique/mailbox-inbox', compact('page_title', 'user', 'boutique', 'notifications', 'notificationsCount', 'emails', 'inboxCount', 'datetime'));
  //   }

  //   public function readmail($emailID)
  //   {
		// $page_title = "Mailbox";
  //  		$user = Auth()->user()->id;
		// $boutique = Boutique::where('userID', $user)->first();
		// $notifications = Auth()->user()->notifications;
		// $notificationsCount = Auth()->user()->unreadNotifications->count();
		// $inboxCount = count(Email::where('recipientID', $user)->where('location', 'inbox')->where('status', 'unread')->get());
		// $datetime = date('Y-m-d H:i:s');
  //   	$email = Email::where('id', $emailID)->first();


  //       return view('boutique/mailbox-readmail', compact('page_title', 'user', 'boutique', 'notifications', 'notificationsCount', 'email', 'inboxCount', 'datetime'));
  //   }

    public function bSendChat(Request $request)
    {
   		$id = Auth()->user()->id;
   		$orderID = $request->input('orderID');
        $order = Order::where('id', $orderID)->first();
        // dd($order->customer['id']);
    	$chat = Chat::create([
    		'orderID' => $orderID,
    		'receiverID' => $order->customer['id'],
    		'senderID' => $id,
    		'senderType' => 'boutique',
    		'message' => $request->input('message'),
    		'status' => 'unread'
    	]);

    	$customer = User::where('id', $order['userID'])->first();
    	$customer->notify(new NotifyCustomerOfChat($chat));

    	return redirect('orders/'.$orderID.'#chat');
    }

    public function chatwAdmin()
    {
   		$id = Auth()->user()->id;
		$user = User::find($id);
		$page_title = 'Chat';
		$notifications = $user->notifications;
		$notificationsCount = $user->unreadNotifications->count();
		$boutiques = Boutique::all();
    	$boutique = Boutique::where('userID', $id)->first();
   		$boutiqueUserID = $boutique->owner['id'];

   		$admin = User::where('roles', 'admin')->first();
   		$convoID = "$admin->id"."$boutiqueUserID";
   		$chats = Chat::where('convoID', $convoID)->get();

   		// dd($convoID);

    	return view('boutique/chatwAdmin', compact('id', 'boutique', 'page_title', 'notifications', 'notificationsCount', 'chats', 'boutiques'));
    }

    public function chatAdmin(Request $request)
    {
   		$id = Auth()->user()->id;
   		$boutique = Boutique::where('userID', $id)->first();
   		$boutiqueUserID = $boutique->owner['id'];
   		$admin = User::where('roles', 'admin')->first();
   		$convoID = "$admin->id"."$boutiqueUserID";

    	$chat = Chat::create([
    		'receiverID' => $admin['id'],
    		'senderID' => $id,
    		'senderType' => 'boutique',
    		'message' => $request->input('message'),
			'convoID' => $convoID,
    		'status' => 'unread'
    	]);

    	return redirect('chat-w-admin');
    }

    public function fileforDispute(Request $request)
    {
   		$id = Auth()->user()->id;
   		$boutique = Boutique::where('userID', $id)->first();
   		$orderID = $request->input('orderID');


   		$dispute = Dispute::create([
   			'orderID' => $orderID,
   			'boutiqueID' => $boutique['id'],
   			'dispute' => $request->input('dispute')
   		]);

   		return redirect('orders/'.$orderID);
    }

    public function getSubcategory($categoryID)
    {
    	$subcategories = Subcategory::where('categoryID', $categoryID)->get();

    	return response()->json([
    		'subcategories' => $subcategories
    	]);
    }


}