<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Boutique;
use App\Order;
use App\Notifications\NotifyForPickup;

class IonicController extends Controller
{

    public function profile($userID)
    {
        $user = User::where('id', $userID)->first();

        return response()->json([
            'user' => $user
        ]);
    }

    public function authenticate($username, $userpassword)
    {
        $credentials = array();
        $credentials['username'] = $username;
        $credentials['password'] = $userpassword;


        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = User::where('username', $username)->first();


            return response ()->json([
                'user' => $user
            ]);

        }else{

            return response ()->json([
                'user' => 'Wrong username/password.'
            ]);
        }
    }

    public function topickup()
    {
    	$dateToday = date('Y-m-d');
    	// dd($dateToday);

    	$page_title = "To Pickup";
    	$boutiques = Boutique::all();
		// $notifications = $user->notifications;
		// $notificationsCount = $user->unreadNotifications->count();

		// $orders = Order::where('status', "For Pickup")->where('deliverySchedule', $dateToday)->get();
		$orders = Order::where('status', "For Pickup")->get();

		foreach($orders as $order){
			$order['customer'] = $order->customer;
			$order['boutique'] = $order->boutique;
			$order['address'] = $order->address;

		}

   		return response ()->json([
			'page_title' => $page_title,
			'orders' => $orders
		]);
    }

    public function todeliver()
    {
        $page_title = "To Deliver";
        // $id = Auth()->user()->id;
        // $user = User::find($id);
        // $boutiques = Boutique::all();
        // $notifications = $user->notifications;
        // $notificationsCount = $user->unreadNotifications->count();

        $orders = Order::where('status', "For Delivery")->get();

		foreach($orders as $order){
			$order['customer'] = $order->customer;
			$order['boutique'] = $order->boutique;
			$order['address'] = $order->address;

		}
   		
   		return response ()->json([
			'page_title' => $page_title,
			'orders' => $orders
		]);
    }

    public function delivered()
    {
        $page_title = "Delivered";

        $orders = Order::where('status', "Delivered")->get();

		foreach($orders as $order){
			$order['customer'] = $order->customer;
			$order['boutique'] = $order->boutique;
			$order['address'] = $order->address;
		}
   		
   		return response ()->json([
			'page_title' => $page_title,
			'orders' => $orders
		]);
    }

    public function completed()
    {
        $page_title = "Completed";
        // $id = Auth()->user()->id;
        // $user = User::find($id);
        // $boutiques = Boutique::all();
        // $notifications = $user->notifications;
        // $notificationsCount = $user->unreadNotifications->count();

        $orders = Order::where('status', "Completed")->get();

		foreach($orders as $order){
			$order['customer'] = $order->customer;
			$order['boutique'] = $order->boutique;
			$order['address'] = $order->address;
		}
   		
   		return response ()->json([
			'page_title' => $page_title,
			'orders' => $orders
		]);
    }

    public function viewOrder($orderID)
    {
    	$page_title = "Order Details";
    	$order = Order::where('id', $orderID)->first();
        // dd($order->customer);
    	$order['customer'] = $order->customer;
		$order['boutique'] = $order->boutique;
        $order['address'] = $order->address;
		$order['boutiqueAddress'] = $order->boutique->address;

	
    	return response ()->json([
			'page_title' => $page_title,
			'order' => $order
		]);
    }

    public function pickupOrder($data)
    {
        // $orderData = array();
        $orderData = explode("_", $data);
        // dd($orderData);
    	$order = Order::where('id', $orderData[0])->first();
    	$order->update([
    		'status' => "For Delivery"
    	]);
        $order['customer'] = $order->customer;
        $order['boutique'] = $order->boutique;
        $order['address'] = $order->address;
        $order['boutiqueAddress'] = $order->boutique->address;

        $customer = User::where('id', $order->customer['id'])->first();
        $customer->notify(new NotifyForPickup($order));

        return response ()->json([
            'order' => $order
        ]);
    }

    public function deliveredOrder($orderID) //wala ni syay view
    {
    	$order = Order::where('id', $orderID)->first();
    	$order->update([
    		'status' => "Delivered"
    	]);
        $order['customer'] = $order->customer;
        $order['boutique'] = $order->boutique;
        $order['address'] = $order->address;
        $order['boutiqueAddress'] = $order->boutique->address;


        return response ()->json([
            'order' => $order
        ]);
    }

    public function countDatas($userID)
    {   
        $user = User::where('id', $userID)->first();
        $forPickup = Order::where('status', "For Pickup")->count();
        $forDelivery = Order::where('status', "For Delivery")->count();
        $notificationsCount = $user->unreadNotifications->count();

        return response ()->json([
            'forPickup' => $forPickup,
            'forDelivery' => $forDelivery,
            'notificationsCount' => $notificationsCount
        ]);
    }

    public function countNotifications($userID)
    {   
        $user = User::where('id', $userID)->first();
        $notificationsCount = $user->unreadNotifications->count();

        return response ()->json([
            'notificationsCount' => $notificationsCount
        ]);
    }

    public function notifications($userID)
    {   
        $user = User::where('id', $userID)->first();
        $notifications = $user->notifications;

        return response ()->json([
            'page_title' => 'Notifications',
            'notifications' => $notifications
        ]);
    }

    public function viewNotification($userID, $notificationID)
    {
        $user = User::where('id', $userID)->first();
        $notifications = $user->notifications;

        foreach($notifications as $notification){
            if($notification->id == $notificationID) {
                $notification->markAsRead();
            }  
        }

        // return viewOrder($notificationID);
        return response()->json([
            'orderID' => $notification['data']['orderID']
        ]);
    }

    public function getqr($data)
    {
        var_dump($data);

    }
}
