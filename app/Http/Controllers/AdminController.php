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
		$notifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();

		foreach($notifications as $notification) {
			if($notification->id == $notificationID) {
				$notif = $notification;
				$notification->markAsRead();
			} else {
				
			}
		}
		// dd($notification);

		$boutique = Boutique::where('id', $notif->data['boutiqueID'])->first();

		return view('admin/viewNotification', compact('notifications', 'notification', 'notificationsCount', 'page_title', 'admin', 'boutique'));
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

		$notifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();


		return view('admin/dashboard', compact('admin', 'users', 'orders', 'rents', 'page_title', 'customerCount', 'boutiqueCount', 'orderCount', 'rentCount', 'notifications', 'notificationsCount'));
	}

	public function orders()
	{
		$page_title = "Orders";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$orders = Order::all();

		$notifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();
		
		return view('admin/orders', compact('admin', 'orders', 'page_title', 'notifications', 'notificationsCount'));
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
		$notifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();

		return view('admin/tags', compact('admin', 'tags', 'page_title', 'notifications', 'notificationsCount'));
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
		$notifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();


		$categories = Category::all();
		$womens = Category::where('gender', "Womens")->get();
		$mens = Category::where('gender', "Mens")->get();
			

		return view('admin/categories',compact('admin', 'categories','womens', 'mens', 'page_title', 'notifications', 'notificationsCount'));
	}

	public function saveCategory(Request $request)
	{
    	$id = Auth()->user()->id;

		$category = Category::create([
			'categoryName' => $request->input('categoryName'),
			'gender' => $request->input('gender')
		]);

		return redirect('/admin-categories');
	}

	public function rents()
	{
		$page_title = "Rents";
    	$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$notifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();

		$rents = Rent::all();

		return view('admin/rents', compact('admin', 'rents', 'page_title', 'notifications', 'notificationsCount'));
	}

	public function locations()
	{
		$page_title = "Locations";
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$notifications = $admin->notifications;
		$notificationsCount = $admin->unreadNotifications->count();

		return view('admin/locations', compact('admin', 'page_title', 'notifications', 'notificationsCount'));
	}

}
