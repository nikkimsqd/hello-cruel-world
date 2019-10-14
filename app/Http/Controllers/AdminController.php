<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Tag;
use App\User;
use App\Order;
use App\Rent;
use App\Category;
use App\Boutique;
use App\Categoryrequest;
use App\Province;
use App\Region;
use App\City;
use App\Barangay;
use App\RefProvince;
use App\RefRegion;
use App\RefCity;
use App\RefBrgy;
use App\Measurement;
use App\Measurementtype;
use App\Categorymeasurement;
use App\Sharepercentage;
use App\Payout;
use App\Event;
use App\Categorytag;
use App\Courier;
use App\Complain;
use App\Email;
use App\Chat;
use App\Refund;
use App\Deliveryfee;
use App\Subcategory;
use App\Notifications\AdminAcceptsCategoryRequest;
use App\Notifications\AdminDeclinesCategoryRequest;
use App\Notifications\RequestPaypalAccount;
use App\Notifications\PayoutReleased;
use App\Notifications\NotifyAdminForPickup;
use App\Notifications\AskCustomerForPayPalEmail;
use App\Notifications\RefundSuccessful;


class AdminController extends Controller
{
	public function __construct()
    {
    	$userRole = "";

	 	$this->middleware('auth');
	 	$this->middleware(function ($request, $next) {
	    	if (Auth::user()->roles == 'customer') {
	    		return redirect('/shop');
	    	} else if (Auth::user()->roles == 'boutique') {
	    		return redirect('/dashboard');
	    	}  else if (Auth::user()->roles == 'courier') {
	    		return redirect('/ionic-topickup');
	    	} 
	 		return $next($request);
   		});
    }

	public function viewNotifications($notificationID)
    {
		$page_title = "Notification";
    	$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$complainsCount = count(Complain::where('status', 'Active')->get());

		foreach($adminNotifications as $notifications) {
			if($notifications->id == $notificationID) { //match notificationID
				$notification = $notifications;

				if($notification['type'] == "App\Notifications\NewCategoryRequest") { //determine by type
					$categoryRequest = Categoryrequest::where('id', $notification->data['categoryRequest'])->first();
					$notif = $categoryRequest;
					$boutique = Boutique::where('id', $notif['boutiqueID'])->first();

					$notification->markAsRead();
					$notificationsCount = $admin->unreadNotifications->count();

					return view('admin/viewNotification', compact('notif', 'boutique', 'adminNotifications', 'notification', 'notificationsCount', 'page_title', 'admin', 'complainsCount'));

				}elseif($notification['type'] == "App\Notifications\NotifyAdminOfComplain"){
					$notification->markAsRead();
					$order = Order::where('id', $notification->data['orderID'])->first();

					return redirect('admin-orders/'.$order['id']);
					
				}elseif($notification['type'] == "App\Notifications\PaypalEmailSubmitted"){
					$notification->markAsRead();

					$refund = Refund::where('id', $notification->data['refundID'])->first();
					$order = Order::where('id', $refund['orderID'])->first();

					return redirect('admin-orders/'.$order['id'].'#complaint');
					
				}

			} else {
				
			}
		} //endforeach

    }

    public function sales()
    {
    	$page_title = "Sales";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$orders = Order::where('status', '=', 'Completed')->get();
		$sp = Sharepercentage::where('id', '1')->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$complainsCount = count(Complain::where('status', 'Active')->get());
		
		return view('admin/sales', compact('admin', 'orders', 'page_title', 'adminNotifications', 'notificationsCount', 'sp', 'complainsCount'));
    }

    public function editPercentage(Request $request)
    {
    	$sp = Sharepercentage::where('id', $request->input('oldPercentage'))->update([
    		'sharePercentage' => $request->input('sharePercentage')
    	]);

    	return redirect('admin-sales');
    }

	public function dashboard()
	{
		$page_title = "Dashboard";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$users = User::all();
		$orders = Order::all();
		$rents = Rent::all();
		$customers = User::where('roles', "customer")->get();
		$boutique = User::where('roles', "boutique")->get();
		$customerCount = $customers->count();
		$boutiqueCount = $boutique->count();
		$orderCount = $orders->count();
		$rentCount = $rents->count();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$complainsCount = count(Complain::where('status', 'Active')->get());


		return view('admin/dashboard', compact('admin', 'users', 'orders', 'rents', 'page_title', 'customerCount', 'boutiqueCount', 'orderCount', 'rentCount', 'adminNotifications', 'notificationsCount', 'complainsCount'));
	}

	public function orders()
	{
		$page_title = "Orders";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$orders = Order::where('status', '!=', 'Completed')->get();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$complainsCount = count(Complain::where('status', 'Active')->get());
		
		return view('admin/ongoing-orders', compact('admin', 'orders', 'page_title', 'adminNotifications', 'notificationsCount', 'complainsCount'));
	}

	public function getOrder($orderID)
	{
		$page_title = "Orders";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$order = Order::where('id', $orderID)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$complainsCount = count(Complain::where('status', 'Active')->get());
		$complaint = Complain::where('orderID', $order['id'])->first();
		$chats = Chat::where('orderID', $orderID)->get();

		// $order->map(function ($order){
		if($order->refund['paypalEmail'] != null) {
			$date = date('Y_mdhis');
			$ordersArray = array();

			$ordersArray['sender_batch_header'] = array(
				'sender_batch_id' => 'Refunds_'.$date,
				'email_subject' => 'You have a refund!',
				'email_message' => 'You have received a refund! Thanks for using our service!'
			);

			$item = array();
			$item['recipient_type'] = 'EMAIL';
			$item['amount']['value'] = $order['total'];
			$item['amount']['currency'] = 'PHP';
			$item['note'] = 'Thanks for your patronage!';
			$item['sender_item_id'] = $order['id'];
			$item['receiver'] = $order->refund['paypalEmail'];

			$ordersArray['items'] = array(
				$item
			);

			$orderJson = json_encode($ordersArray);

			$order['json'] = $orderJson;
			// return $order;

		}else{

			$order['json'] = "null";
			// return $order;
		}
		// });
		// dd($order);
		
		return view('admin/viewOrder', compact('admin', 'order', 'page_title', 'adminNotifications', 'notificationsCount', 'complainsCount', 'complaint', 'chats'));
	}

	public function archives()
	{
		$page_title = "Archives";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$orders = Order::where('status', 'Completed')->get();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$complainsCount = count(Complain::where('status', 'Active')->get());
		
		return view('admin/archives', compact('admin', 'orders', 'page_title', 'adminNotifications', 'notificationsCount', 'complainsCount'));
	}

	public function getArchives($orderID)
	{
		$page_title = "Archives";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$order = Order::where('id', $orderID)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$complainsCount = count(Complain::where('status', 'Active')->get());
		
		return view('admin/viewArchive', compact('admin', 'order', 'page_title', 'adminNotifications', 'notificationsCount', 'complainsCount'));
	}

    public function addBoutique()
    {
        return view('auth/registerseller');
    }
    
    public function tags()
	{
		$page_title = "Tags";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$tags = Tag::all(); //to remove
		$categories = Category::all();
		// $categoryGenders = $categories->groupBy('gender');
		$categoryTags = Categorytag::all();
		$categoryGenders = $categories->groupBy('gender');
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$complainsCount = count(Complain::where('status', 'Active')->get());
		// dd($categoryGenders);


        // foreach($categoryTagGender as $categoryTags){
        //      	// dd($categoryTags);
        //      foreach($categoryTags as $categoryTag){
	       //    foreach($categories as $category){
	       //    	foreach($categoryGenders as $gender => $value){
	       //       // dd($gender);
	       //    	}
	       //      if($category['id'] == $categoryTag['categoryID']){
	       //       // dd($category['categoryName']);
	       //      }else{
	       //      	// dd('u here');
	       //      }
	       //     }
	            
	       //    }
        //      }
        //      	dd($categoryTags);
          
        

		return view('admin/tags', compact('admin', 'tags', 'page_title', 'adminNotifications', 'notificationsCount', 'categories', 'categoryGenders', 'complainsCount', 'categoryTags'));
	}

	public function addTag(Request $request)
	{
		// $tags = Tag::create([
		// 	'name' => $request->input('tag')
		// ]);

		$categoryTag = Categorytag::create([
			'categoryID' => $request->input('category'),
			'tagName' => $request->input('tag')
		]);

		return redirect('/admin-tags');
	}

	public function deleteTag($tagID)
	{
		Tag::where('id', $tagID)->delete();

		return redirect('admin-tags');
	}

	public function categories()
	{
		$page_title = "Categories";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$tags = Tag::all();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$categories = Category::all();
		$womens = Category::where('gender', "Womens")->get();
		$mens = Category::where('gender', "Mens")->get();
		$complainsCount = count(Complain::where('status', 'Active')->get());
		

		return view('admin/categories',compact('admin', 'categories','womens', 'mens', 'page_title', 'adminNotifications', 'notificationsCount', 'complainsCount'));
	}

	public function saveCategory(Request $request)
	{
    	$id = Auth()->user()->id;

    	// dd("dfdfdf");
		$category = Category::create([
			'categoryName' => $request->input('categoryName'),
			'gender' => $request->input('gender')
		]);

		//SA CATEGORY REQUEST NI-----------------------------------
		// $categoryRequest = $request->input('categoryRequest');
		// $notificationID = $request->input('notificationID');
		// if($categoryRequest != null) {
		// 	$catReq = Categoryrequest::where('id', $categoryRequest)->first();
		// 	$catReq->update([
		// 		'status' => "Approved"
		// 	]);

		// 	$boutique = User::where('id', $catReq->boutique->owner['id'])->first();
		// 	$boutique->notify(new AdminAcceptsCategoryRequest($catReq));
		// 	// dd($boutique);

		// 	return redirect('categories-notifications/'.$notificationID);
		// }

		return redirect('/admin-categories');
	}

	public function saveSubCategory(Request $request)
	{
    	$id = Auth()->user()->id;

		$subcategory = Subcategory::create([
			'categoryID' => $request->input('category'),
			'subcatName' => ucwords($request->input('subcatName'))
		]);

		return redirect('/admin-categories');
	}

	public function declineCategory(Request $request)
	{
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();

		$catReq = Categoryrequest::where('id', $request->input('catreqID'))->first();
		$catReq->update([
			'status' => 'Declined',
			'reason' => $request->input('reason')
		]);

		$boutique = User::where('id', $catReq->boutique->owner['id'])->first();
		$boutique->notify(new AdminDeclinesCategoryRequest($catReq));

		return redirect('admin-categories');
	}

	public function rents()
	{
		$page_title = "Rents";
    	$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$rents = Rent::all();
		$complainsCount = count(Complain::where('status', 'Active')->get());

		return view('admin/rents', compact('admin', 'rents', 'page_title', 'adminNotifications', 'notificationsCount', 'complainsCount'));
	}

	public function locations()
	{
		$page_title = "Locations";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
        $refregions = RefRegion::all();
        $regions = Region::all();
        $provinces = Province::all();
        $barangays = Barangay::all();
        $cities = City::all();
		$complainsCount = count(Complain::where('status', 'Active')->get());

		return view('admin/locations', compact('admin', 'page_title', 'adminNotifications', 'notificationsCount', 'refregions', 'cities', 'barangays', 'regions', 'provinces', 'complainsCount'));
	}

	public function getProvince($regCode)
    {
        $userid = Auth()->user()->id;
        $provinces = RefProvince::where('regCode', $regCode)->get();

        return response()->json(['provinces' => $provinces]);
    }

	public function getCity($provCode)
    {
        $userid = Auth()->user()->id;
        $cities = RefCity::where('provCode', $provCode)->get();
        
        return response()->json(['cities' => $cities]);
    }

    // public function getBrgy($citymunCode)
    // {
    //     $barangays = Barangay::where('citymunCode', $citymunCode);
        
    //     $brgys = RefBrgy::where('citymunCode', $citymunCode)->orderBy('brgyDesc', 'ASC')->get();

    //     return response()->json(['brgys' => $brgys,
    // 							 'barangays' => $barangays]);
    // }

    public function addLocation(Request $request)
    {
    	$regCode = $request->input('region');
    	$provCode = $request->input('province');
    	$citymunCode = $request->input('city');
    	$brgyCodes = $request->input('barangays');

    	//REGION------------------------------------------------------------------
        $refregion = RefRegion::where('regCode', $regCode)->first();
    	$region = Region::where('regCode', $refregion['regCode'])->first();
        if($region == null){
        	Region::create([
	    		'id' => $refregion['id'],
	    		'psgcCode' => $refregion['psgcCode'],
	    		'regDesc' => $refregion['regDesc'],
	    		'regCode' => $refregion['regCode'],
    		]);
        }

        //PROVINCE------------------------------------------------------------------
        $refprovince = RefProvince::where('provCode', $provCode)->first();
        $province = Province::where('provCode', $refprovince['provCode'])->first();
        if($province == null){
        	Province::create([
	    		'id' => $refprovince['id'],
	    		'psgcCode' => $refprovince['psgcCode'],
	    		'provDesc' => $refprovince['provDesc'],
	    		'regCode' => $refprovince['regCode'],
	    		'provCode' => $refprovince['provCode'],
	    	]);
        }

        //CITY------------------------------------------------------------------
        $refcity = RefCity::where('citymunCode', $citymunCode)->first();
        $city = City::where('citymunCode', $refcity['citymunCode'])->first();
        if($city == null){
        	City::create([
	    		'id' => $refcity['id'],
	    		'psgcCode' => $refcity['psgcCode'],
	    		'citymunDesc' => $refcity['citymunDesc'],
	    		'regDesc' => $refcity['regDesc'],
	    		'provCode' => $refcity['provCode'],
	    		'citymunCode' => $refcity['citymunCode'],
	    	]);
        }

        //BARANGAY
       //  foreach($brgyCodes as $brgyCode){
       //  	$refBrgy = RefBrgy::where('brgyCode', $brgyCode)->first();
       //  	$barangay = Barangay::where('brgyCode', $refBrgy['brgyCode'])->first();
       //  	if($barangay == null){
	      //   	Barangay::create([
		    	// 	'id' => $refBrgy['id'],
		    	// 	'brgyCode' => $refBrgy['brgyCode'],
		    	// 	'brgyDesc' => $refBrgy['brgyDesc'],
		    	// 	'regCode' => $refBrgy['regCode'],
		    	// 	'provCode' => $refBrgy['provCode'],
		    	// 	'citymunCode' => $refBrgy['citymunCode'],
		    	// ]);
	      //   }
       //  }
    	

    	return redirect('/admin-locations');
    }

    public function deleteLocation($cityID)
    {
    	City::where('id', $cityID)->delete();

    	return redirect('admin-locations');
    }

    public function measurements()
    {
    	$page_title = "Measurements";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$categories = Category:: all();
		$measurements = Categorymeasurement::all();
		$categoryArray = [];
		$complainsCount = count(Complain::where('status', 'Active')->get());

		foreach ($measurements as $measurement) {
			$category = $measurement->getCategory['categoryName'];
			$categoryGender = $measurement->getCategory['gender'];
			$categoryArray[$categoryGender][$category][$measurement['id']] = $measurement['mName'];
		}
		foreach($categoryArray as $categoriesName => $cats){
			if($categoriesName == "Womens"){
				foreach($cats as $cat => $measures){
					// foreach($measurements as $measurement){
						// dd($measures);
					// }	
				}
			}
						// dd($categoryArray);
			
		}
		// dd($categoryArray);
		return view('admin/measurements', compact('admin', 'page_title', 'adminNotifications', 'notificationsCount'	, 'categories', 'categoryArray', 'complainsCount'));
    }

    public function addMeasurement(Request $request)
    {
    	Categorymeasurement::create([
    		'categoryID' => $request->input('category'),
    		'mName' => $request->input('mName')
    	]);

    	return redirect('admin-measurements');
    }

    public function addAccount()
    {
		$page_title = "Add Courier Account";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$couriers = Courier::all();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$complainsCount = count(Complain::where('status', 'Active')->get());
		
		return view('admin/addAccount', compact('admin', 'page_title', 'adminNotifications', 'notificationsCount', 'couriers', 'complainsCount'));
    }

    public function saveAccount(Request $request)
    {
    	$user = User::create([
    		'fname' => $request->input('fname'),
    		'lname' => $request->input('lname'),
    		'username' => $request->input('username'),
    		'email' => $request->input('email'),
    		'password' => Hash::make($request->input('password')),
    		'gender' => $request->input('gender'),
    		'roles' => 'courier'
    	]);

    	Courier::create([
    		'userID' => $user['id'],
    		'status' => 'Active'
    	]);

    	return redirect('admin-addAccount');
    }

    public function viewCourier($courierID)
    {
		$page_title = "View Courier Account";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
    	$courier = Courier::where('id', $courierID)->first();
		$complainsCount = count(Complain::where('status', 'Active')->get());

    	return view('admin/viewCourier', compact('admin', 'page_title', 'adminNotifications', 'notificationsCount', 'courier', 'complainsCount'));
    }

    public function deactivateCourier($courierID)
    {
    	Courier::where('id', $courierID)->update([
    		'status' => 'Deactivated'
    	]);

    	return redirect('view-courier/'.$courierID);
    }

    public function activateCourier($courierID)
    {
    	Courier::where('id', $courierID)->update([
    		'status' => 'Active'
    	]);

    	return redirect('view-courier/'.$courierID);
    }

    // public function editPriorityNumber($courierID)
    // {
    // 	$courier = Courier::where('id', $courierID)->update([
    // 		'priorityNumber' => $request->input('priorityNumber')
    // 	]);

    // 	return redirect('view-courier/'.$courierID);
    // }

    public function payouts()
    {
		$page_title = "Payouts";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$orders = Order::where('status', 'Completed')->get();
		$complainsCount = count(Complain::where('status', 'Active')->get());
		// $payouts = Order::where('status', 'Completed')->where('payoutID', '!=', null)->get();
		// dd($orders[0]['payoutID']);



		// dd(date('Y-mdhis'));

		foreach($orders as $order)
		{
			$orders->map(function ($order){
				if($order->boutique['paypalAccountID'] != null) {
					$date = date('Y_mdhis');
					$ordersArray = array();

					$ordersArray['sender_batch_header'] = array(
						'sender_batch_id' => 'Payouts_'.$date,
						'email_subject' => 'You have a payout!',
						'email_message' => 'You have received a payout! Thanks for using our service!'
					);

					$item = array();
					$item['recipient_type'] = 'EMAIL';
					$item['amount']['value'] = $order['boutiqueShare'];
					$item['amount']['currency'] = 'PHP';
					$item['note'] = 'Thanks for your patronage!';
					$item['sender_item_id'] = $order['id'];
					$item['receiver'] = $order->boutique->paypalEmail['paypalEmail'];

					$ordersArray['items'] = array(
						$item
					);

					$orderJson = json_encode($ordersArray);

					$order['json'] = $orderJson;
					return $order;

				}else{

					$order['json'] = "null";
					return $order;
				}
			});
		}

		return view('admin/payouts', compact('page_title', 'admin', 'adminNotifications', 'notificationsCount', 'orders', 'complainsCount'));
    }

    public function savePayout($orderID, $batchID)
    {
    	$order = Order::where('id', $orderID)->first();
    	$payout = Payout::create([
    		'orderID' => $orderID,
    		'batchID' => $batchID,
    		'amount' => $order['boutiqueShare']
    	]);

    	$order->update([
    		'payoutID' => $payout['id']
    	]);

    	$boutique = Boutique::where('id', $order->boutique['id'])->first();

    	$boutiqueSeller = User::where('id', $boutique['userID'])->first();
    	$boutiqueSeller->notify(new PayoutReleased($payout['id']));


    	// dd($payout);
    	return redirect('admin-payouts');

    }

    public function refuseRefund($orderID)
    {
		$order = Order::where('id', $orderID)->first();
    	$complaint = Complain::where('orderID', $orderID)->first();

    	$order->update([
    		'status' => 'Completed'
    	]);

		$complaint->update([
			'status' => 'Closed'
		]);

		return redirect('admin-orders/'.$orderID.'#complaint');
    }

    public function refundCustomer($orderID)
    {
    	$order = Order::where('id', $orderID)->first();
    	$refund = Refund::where('orderID', $orderID)->first();
    	$complaint = Complain::where('orderID', $orderID)->first();

    	$refund->update([
    		'amount' => $order['total']
    	]);

    	$order->update([
    		'status' => 'Completed'
    	]);

    	$complaint->update([
    		'status' => 'Closed'
    	]);

    	$customer = User::where('id', $order['userID'])->first();
    	$customer->notify(new RefundSuccessful($refund));

    	return redirect('admin-orders/'.$orderID);
    }

    public function askPayPalEmail($orderID)
    {
    	$order = Order::where('id', $orderID)->first();

    	$complaint = Complain::where('orderID', $orderID)->update([
    		'status' => 'In-Progress'
    	]);

    	$refund = Refund::create([
    		'orderID' => $orderID
    	]);

    	$customer = User::where('id', $order['userID'])->first();
    	$customer->notify(new AskCustomerForPayPalEmail($refund));

    	return redirect('admin-orders/'.$orderID);
    }

    public function requestPaypalAccount($orderID)
    {
    	$order = Order::where('id', $orderID)->first();
    	$boutique = Boutique::where('id', $order->boutique['id'])->first();

    	$boutiqueSeller = User::where('id', $boutique['userID'])->first();
    	$boutiqueSeller->notify(new RequestPaypalAccount($orderID));

    	return redirect('admin-payouts');
    }

    public function viewPayout($orderID)
    {
		$page_title = "View Payout";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
    	$order = Order::where('id', $orderID)->first();
		$complainsCount = count(Complain::where('status', 'Active')->get());

    	return view('admin/viewPayout', compact('page_title', 'admin', 'adminNotifications', 'notificationsCount', 'order','complainsCount'));
    }

    public function getEvents()
    {
		$page_title = "Events";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		// $tags = Tag::all();
		$tags = Categorytag::all();
		$events = Event::all();
        $eventNames = $events->groupBy('event');
		$complainsCount = count(Complain::where('status', 'Active')->get());
        // dd($eventNames);

    	return view('admin/events', compact('page_title', 'admin', 'adminNotifications', 'notificationsCount', 'tags', 'events', 'eventNames', 'categoryTags', 'complainsCount'));
    }

    public function saveEvent(Request $request)
    {
    	foreach($request->input('tags') as $tag){
	    	$event = Event::create([
	    		'event' => ucfirst($request->input('event')),
	    		'tagID' => $tag
	    	]);
	    }

	    return redirect('admin-events');
    }

    public function viewEvent($eventName)
    {
		$page_title = "Added events with their tags";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
    	$events = Event::where('event', $eventName)->get();
        $eventName = $eventName;
		$complainsCount = count(Complain::where('status', 'Active')->get());

    	return view('admin/viewEvent', compact('page_title', 'admin', 'adminNotifications', 'notificationsCount', 'events', 'eventName', 'complainsCount'));
    }

    public function forpickups()
    {
		$page_title = "For Pickups";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$orders = Order::where('status', 'For Pickup')->get();
		$complainsCount = count(Complain::where('status', 'Active')->get());
		// dd($orders);

    	return view('admin/forpickups', compact('page_title', 'admin', 'adminNotifications', 'notificationsCount', 'orders', 'complainsCount'));
    }

    public function getForpickups($orderID)
    {
    	$page_title = "Select courier to pickup";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$order = Order::where('id', $orderID)->first();
		$complainsCount = count(Complain::where('status', 'Active')->get());
		// dd($order);

    	return view('admin/forpickups', compact('page_title', 'admin', 'adminNotifications', 'notificationsCount', 'order', 'complainsCount'));
    }

    public function complaints()
    {
		$page_title = "Complaints";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();

		$complains = Complain::all();
		$activeComplains = Complain::where('status', 'Active')->get();
		$complainsCount = count($activeComplains);
        
        return view('admin/complaints', compact('page_title', 'admin', 'adminNotifications', 'notificationsCount', 'complainsCount', 'complains'));
    }

    public function viewComplaint($complainID)
    {
		$page_title = "Complaint";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$complain = Complain::where('id', $complainID)->first();
		$complainsCount = count(Complain::where('status', 'Active')->get());

        return view('admin/viewComplaint', compact('page_title', 'admin', 'adminNotifications', 'notificationsCount', 'complainsCount', 'complain'));
    }

    public function compose()
    {
		$page_title = "Mailbox";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$complainsCount = count(Complain::where('status', 'Active')->get());

        return view('admin/mailbox-compose', compact('page_title', 'admin', 'adminNotifications', 'notificationsCount', 'complainsCount', 'complain', 'complains'));
    }

    public function getComplaint($complainID)
    {
    	$complaint = Complain::where('id', $complainID)->with('order')->first();
    	$boutique = Boutique::where('id', $complaint->order['boutiqueID'])->with('owner')->first();

    	return response()->json([
    		'complaint' => $complaint,
    		'boutique' => $boutique
    	]);
    }

    public function sendCompose(request $request)
    {
		$id = Auth()->user()->id;
		// dd($request->input('recipient'));

    	$email = Email::create([
    		'senderID' => $id,
    		'recipientID'=> $request->input('recipientID'),
    		'subject' => $request->input('subject'),
    		'message' => $request->input('message'),
    		'location' => 'inbox',
    		'status' => 'unread'
    	]);

        // $uploads = $request->file('file');
        // if($request->hasFile('file')) {
        //     foreach($uploads as $upload){
        //         $files = new File();
        //         // $name = $upload->getClientOriginalName();
        //         $destinationPath = public_path('uploads');
        //         $random = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7).$upload->getClientOriginalName();
        //         $filename = $destinationPath.'\\'. $random;
        //         $upload->move($destinationPath, $filename);

        //         $files->userID = $user['id'];
        //         $files->complainID = $complain['id'];
        //         $files->filename = "/".$random;
        //         $files->save();
        //         $filename = "/".$random;
        //     }
        // }

        // return redirect('viewComplaint/'.)
    }

    public function chatswBoutique()
    {
		$page_title = 'Chat';
   		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$complainsCount = count(Complain::where('status', 'Active')->get());
		$boutiques = Boutique::all();


   		// dd($unreadCount);

    	return view('admin/chatswBoutique', compact('id', 'admin', 'page_title', 'adminNotifications', 'notificationsCount', 'complainsCount', 'boutiques'));
    }

    public function chatwBoutique($boutiqueID)
    {
		$page_title = 'Chat';
   		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$complainsCount = count(Complain::where('status', 'Active')->get());
		$boutiques = Boutique::all();

		$selectedBoutique = Boutique::where('id', $boutiqueID)->first();
   		$boutiqueUserID = $selectedBoutique->owner['id'];
   		$convoID = "$id"."$boutiqueUserID";
   		$chats = Chat::where('convoID', $convoID)->get();
   		$unread = Chat::where('convoID', $convoID)->where('status', 'unread')->get();
   		$unreadCount = $unread->count();

   		// dd($unreadCount);

    	return view('admin/chatwBoutique', compact('id', 'admin', 'page_title', 'adminNotifications', 'notificationsCount', 'chats', 'complainsCount', 'selectedBoutique', 'boutiques', 'unreadCount'));
    }

    public function chatBoutique(Request $request)
    {
   		$id = Auth()->user()->id;
   		$boutiqueID = $request->input('boutiqueID');
   		$boutique = Boutique::where('id', $boutiqueID)->first();
   		$boutiqueUserID = $boutique->owner['id'];
   		$convoID = "$id"."$boutiqueUserID";

		$chat = Chat::create([
			'receiverID' => $boutiqueUserID,
			'senderID' => $id,
			'senderType' => 'admin',
			'message' => $request->input('message'),
			'convoID' => $convoID,
			'status' => 'unread'
		]);

	    return redirect('chat-w-boutique/'.$boutiqueID);	
    }

    public function deliveryfee()
    {
		$page_title = "Delivery Fee";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$complainsCount = count(Complain::where('status', 'Active')->get());

		$deliveryfee = Deliveryfee::where('id', '1')->first();
		// dd($deliveryfees);


    	return view('admin/deliveryfee', compact('page_title', 'id', 'admin', 'adminNotifications', 'notificationsCount', 'complainsCount', 'deliveryfee'));
    }

    public function savedeliveryfee(Request $request)
    {
    	// dd($request->input('baseFee'));

    	$deliveryfee = Deliveryfee::create([
    		'baseFee' => $request->input('baseFee'),
    		'additionalFee' => $request->input('additionalFee')
    	]);

    	return redirect('admin-deliveryfee');
    }

    public function updatedeliveryfee(Request $request)
    {
    	Deliveryfee::where('id', '1')->update([
    		'baseFee' => $request->input('baseFee'),
    		'additionalFee' => $request->input('additionalFee')
    	]);
    	
    	return redirect('admin-deliveryfee');
    }
}
