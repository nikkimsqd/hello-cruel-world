<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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

		foreach($adminNotifications as $notifications) {
			if($notifications->id == $notificationID) { //match notificationID
				$notification = $notifications;
				if($notification['type'] == "App\Notifications\NewCategoryRequest") { //determine by type
					$categoryRequest = Categoryrequest::where('id', $notification->data['categoryRequest'])->first();
					$notif = $categoryRequest;
					$boutique = Boutique::where('id', $notif['boutiqueID'])->first();

					// $notification->markAsRead();
				}
				// $notification->markAsRead();
			} else {
				
			}
		} //endforeach

		$notificationsCount = $admin->unreadNotifications->count();
		return view('admin/viewNotification', compact('notif', 'boutique', 'adminNotifications', 'notification', 'notificationsCount', 'page_title', 'admin'));
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


		return view('admin/dashboard', compact('admin', 'users', 'orders', 'rents', 'page_title', 'customerCount', 'boutiqueCount', 'orderCount', 'rentCount', 'adminNotifications', 'notificationsCount'));
	}

	public function orders()
	{
		$page_title = "Orders";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$orders = Order::all();

		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		
		return view('admin/orders', compact('admin', 'orders', 'page_title', 'adminNotifications', 'notificationsCount'));
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
		$tags = Tag::all();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();

		return view('admin/tags', compact('admin', 'tags', 'page_title', 'adminNotifications', 'notificationsCount'));
	}

	public function addTag(Request $request)
	{
		$tags = Tag::create([
			'name' => $request->input('tag')
		]);

		return redirect('/admin-tags');
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
			

		return view('admin/categories',compact('admin', 'categories','womens', 'mens', 'page_title', 'adminNotifications', 'notificationsCount'));
	}

	public function saveCategory(Request $request)
	{
    	$id = Auth()->user()->id;

    	dd("dfdfdf");
		$category = Category::create([
			'categoryName' => $request->input('categoryName'),
			'gender' => $request->input('gender')
		]);

		$categoryRequest = $request->input('categoryRequest');
		$notificationID = $request->input('notificationID');
		if($categoryRequest != null) {
			Categoryrequest::where('id', $categoryRequest)->update([
				'status' => "Approved"
			]);

			return redirect('categories-notifications/'.$notificationID);
		}

		return redirect('/admin-categories');
	}

	public function declineCategory($notificationID)
	{
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;

		foreach($adminNotifications as $notifications) {
			if($notifications->id == $notificationID) { //match notificationID
				$notification = $notifications;
				if($notification['type'] == "App\Notifications\NewCategoryRequest") { //determine by type
					$categoryRequest = Categoryrequest::where('id', $notification->data['categoryRequest'])->update([
						'status' => "Declined"
					]);
				}
			} else {
				
			}
		} //endforeach

		return redirect('categories-notifications/'.$notificationID);
	}

	public function rents()
	{
		$page_title = "Rents";
    	$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();

		$rents = Rent::all();

		return view('admin/rents', compact('admin', 'rents', 'page_title', 'adminNotifications', 'notificationsCount'));
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

		return view('admin/locations', compact('admin', 'page_title', 'adminNotifications', 'notificationsCount', 'refregions', 'cities', 'barangays', 'regions', 'provinces'));
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

    public function getBrgy($citymunCode)
    {
        $barangays = Barangay::where('citymunCode', $citymunCode);
        
        $brgys = RefBrgy::where('citymunCode', $citymunCode)->orderBy('brgyDesc', 'ASC')->get();

        return response()->json(['brgys' => $brgys,
    							 'barangays' => $barangays]);
    }

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
        foreach($brgyCodes as $brgyCode){
        	$refBrgy = RefBrgy::where('brgyCode', $brgyCode)->first();
        	$barangay = Barangay::where('brgyCode', $refBrgy['brgyCode'])->first();
        	if($barangay == null){
	        	Barangay::create([
		    		'id' => $refBrgy['id'],
		    		'brgyCode' => $refBrgy['brgyCode'],
		    		'brgyDesc' => $refBrgy['brgyDesc'],
		    		'regCode' => $refBrgy['regCode'],
		    		'provCode' => $refBrgy['provCode'],
		    		'citymunCode' => $refBrgy['citymunCode'],
		    	]);
	        }
        }
    	

    	return redirect('/admin-locations');
    }

    public function measurements()
    {
    	$page_title = "Locations";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$adminNotifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		$categories = Category:: all();
		$measurements = Categorymeasurement::all();
		$categoryArray = [];

		foreach ($measurements as $measurement) {
			$category = $measurement->getCategory['categoryName'];
			$categoryArray[$category][] = $measurement['mName'];
		}

		return view('admin/measurements', compact('admin', 'page_title', 'adminNotifications', 'notificationsCount'	, 'categories', 'categoryArray'));
    }

    public function addMeasurement(Request $request)
    {
    	Categorymeasurement::create([
    		'categoryID' => $request->input('category'),
    		'mName' => $request->input('mName')
    	]);

    	return redirect('admin-measurements');
    }

}
