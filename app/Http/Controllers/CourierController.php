<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Boutique;
use App\Order;
use App\Notifications\NotifyForPickup;

class CourierController extends Controller
{
    public function dashboard()
    {
    	$page_title = "Recent Transactions";
   		$id = Auth()->user()->id;
		$user = User::find($id);
    	$boutiques = Boutique::all();
		$notifications = $user->notifications;
		$notificationsCount = $user->unreadNotifications->count();

		$orders = Order::all();
		

        // $rentArray = $rents->toArray();
        // array_multisort(array_column($rentArray, "created_at"), SORT_DESC, $rentArray);

		return view('ionic/ionic-dashboard', compact('page_title', 'user', 'boutiques', 'notifications', 'notificationsCount', 'orders')); 
    }

    public function topickup()
    {
    	$dateToday = date('Y-m-d');
    	// dd($dateToday);

    	$page_title = "To Pickup";
   		$id = Auth()->user()->id;
		$user = User::find($id);
    	$boutiques = Boutique::all();
		$notifications = $user->notifications;
		$notificationsCount = $user->unreadNotifications->count();

		$orders = Order::where('status', "For Pickup")->where('deliverySchedule', $dateToday)->get();

		return view('ionic/ionic-orders', compact('page_title', 'user', 'boutiques', 'notifications', 'notificationsCount', 'orders')); 
    }

    public function todeliver()
    {
        $page_title = "To Deliver";
        $id = Auth()->user()->id;
        $user = User::find($id);
        $boutiques = Boutique::all();
        $notifications = $user->notifications;
        $notificationsCount = $user->unreadNotifications->count();

        $orders = Order::where('status', "For Delivery")->get();
        // dd($orders);    

        return view('ionic/ionic-orders', compact('page_title', 'user', 'boutiques', 'notifications', 'notificationsCount', 'orders')); 
    }

    public function delivered()
    {
        $page_title = "Delivered";
        $id = Auth()->user()->id;
        $user = User::find($id);
        $boutiques = Boutique::all();
        $notifications = $user->notifications;
        $notificationsCount = $user->unreadNotifications->count();

        $orders = Order::where('status', "Delivered")->get();
        // dd($orders);    

        return view('ionic/ionic-orders', compact('page_title', 'user', 'boutiques', 'notifications', 'notificationsCount', 'orders')); 
    }

    public function completed()
    {
        $page_title = "Completed";
        $id = Auth()->user()->id;
        $user = User::find($id);
        $boutiques = Boutique::all();
        $notifications = $user->notifications;
        $notificationsCount = $user->unreadNotifications->count();

        $orders = Order::where('status', "Completed")->get();
        // dd($orders);    

        return view('ionic/ionic-orders', compact('page_title', 'user', 'boutiques', 'notifications', 'notificationsCount', 'orders')); 
    }



    public function viewOrder($orderID)
    {
    	$page_title = "To Pickup";
   		$id = Auth()->user()->id;
		$user = User::find($id);
    	$boutiques = Boutique::all();
		$notifications = $user->notifications;
		$notificationsCount = $user->unreadNotifications->count();
    	$order = Order::where('id', $orderID)->first();

    	return view('ionic/ionic-viewOrder', compact('page_title', 'user', 'boutiques', 'notifications', 'notificationsCount', 'order'));
    }

    public function pickupOrder($orderID)
    {
    	$order = Order::where('id', $orderID)->first();
    	$order->update([
    		'status' => "For Delivery"
    	]);

        $customer = User::where('id', $order->customer['id'])->first();
        $customer->notify(new NotifyForPickup($order));

    	return redirect('ionic-viewOrder/'.$order['id']);
    }

    public function deliveredOrder($orderID)
    {
    	$order = Order::where('id', $orderID)->first();
    	$order->update([
    		'status' => "Delivered"
    	]);


    	return redirect('ionic-viewOrder/'.$order['id']);
    }

    public function viewNotifications($notificationID)
    {
        $id = Auth()->user()->id;
        $user = User::find($id);
        $boutique = Boutique::where('userID', $id)->first();
        $notifications = $user->notifications;
        $notificationsCount = $user->unreadNotifications->count();

        foreach($notifications as $notification){
            if($notification->id == $notificationID) {

                if($notification->type == 'App\Notifications\NotifyCourierForPickup'){
                    $notification->markAsRead();

                    return redirect('/ionic-viewOrder/'.$notification->data['orderID']);
                    
                }

            }  
        }
    }
}
