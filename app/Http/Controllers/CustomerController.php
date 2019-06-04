<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Cart;
use App\User;
use App\City;
use App\Barangay;
use App\Address;
use App\Boutique;
use App\Rent;
use App\Profiling;
use App\Bidding;
use App\Prodtag;
use App\Tag;
use App\Order;
use App\File;
use App\Mto;
use App\Measurement;
use App\MeasurementRequest;
use App\Categorymeasurement;
use App\Notifications\RentRequest;
use App\Notifications\NewMTO;
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;


class CustomerController extends Controller
{

    public function getNotifications(&$notifications, &$notificationsCount)
    {
        $userID = Auth()->user()->id;
        $user = User::find($userID);
        $notifications = $user->notifications;
        $notificationsCount = $user->unreadNotifications->count();
    }

    public function welcome()
    {
    }

    public function getStarted()
    {
        return view('hinimo/getstarted');
    }

    public function profiling(Request $request)
    {
        $userID = Auth()->user()->id;

        $tops = $request->input('tops');
        $sweaters = $request->input('sweaters');
        $jackets = $request->input('jackets');
        $pants = $request->input('pants');
        $dresses = $request->input('dresses');

        $data = array();

        array_push($data, $tops);
        array_push($data, $sweaters);
        array_push($data, $jackets);
        array_push($data, $pants);
        array_push($data, $dresses);
        // dd($data);

        $data_encoded = json_encode($data);

        
        $profilings = Profiling::create([
            'userID' => $userID,
            'data' => $data_encoded
        ]);

        return redirect('/user-profiling/done');
    }

    public function profilingDone()
    {
        $boutiques = Boutique::all();

        return view('hinimo/profiling-done', compact('boutiques'));
    }


    public function getBoutique($boutiqueID)
    {
        $userID = Auth()->user()->id;
    	$categories = Category::all();
    	$products = Product::where('boutiqueID', $boutiqueID)->where('productStatus', 'Available')->get();
        $productsCount = $products->count();
        $cartCount = Cart::where('userID', $userID)->where('status', "Pending")->count();
        $carts = Cart::where('userID', $userID)->where('status', "Pending")->get();
        $boutiques = Boutique::all();
        $boutique = Boutique::where('id', $boutiqueID)->first();
        $page_title = $boutique['boutiqueName'];
        $notAvailables = Product::where('boutiqueID', $boutiqueID)->where('productStatus', 'Not Available')->get();

        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);

    	return view('hinimo/boutiqueProfile', compact('categories', 'products', 'productsCount', 'carts', 'cartCount', 'userID', 'boutiques', 'boutique', 'notAvailables', 'page_title', 'notifications', 'notificationsCount'));
    }

    public function shop()
    {
        if (Auth::check()) { //check if nay naka login nga user
            if(Auth()->user()->roles == "customer") {
                $page_title = "Shop";
                $userID = Auth()->user()->id;
                $products = Product::where('productStatus', 'Available')->get();
                $productsCount = $products->count();
                $categories = Category::all();
                $cartCount = Cart::where('userID', $userID)->where('status', "Pending")->count();
                $carts = Cart::where('userID', $userID)->where('status', "Pending")->get();
                $boutiques = Boutique::all();
                $notAvailables = Product::where('productStatus', 'Not Available')->get();

                $notifications;
                $notificationsCount;
                $this->getNotifications($notifications, $notificationsCount);
          
                return view('hinimo/shop', compact('products', 'categories', 'carts', 'cartCount', 'userID', 'productsCount', 'boutiques', 'notAvailables', 'page_title', 'notifications', 'notificationsCount'));

            } else if(Auth()->user()->roles == "boutique") {
                return redirect('/dashboard');
            } else if(Auth()->user()->roles == "admin") {
                return redirect('/admin-dashboard');
            }  		
        }else {
            $page_title = "Shop";
            $products = Product::where('productStatus', 'Available')->get();
            $productsCount = $products->count();
            $categories = Category::all();
            $cartCount = Cart::where('userID', "")->where('status', "Pending")->count();
            $carts = Cart::where('userID', "")->where('status', "Pending")->get();
            $boutiques = Boutique::all();
            $notAvailables = Product::where('productStatus', 'Not Available')->get();
            $notificationsCount = null;

            return view('hinimo/shop', compact('products', 'categories', 'carts', 'cartCount', 'userID', 'productsCount', 'boutiques', 'notAvailables', 'page_title', 'notificationsCount'));
        }
    }

    public function productDetails($productID)
    {
        $user = Auth()->user();
        $cartCount = Cart::where('userID', $user['id'])->where('status', "Pending")->count();
        $carts = Cart::where('userID', $user['id'])->where('status', "Pending")->get();
    	$product = Product::where('productID', $productID)->first();
        $addresses = Address::where('userID', $user['id'])->get();
        $boutiques = Boutique::all();
        $page_title = "Shop";
        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);
        
        $totalPrice = $product['rentPrice'] + $product['deliveryFee'];

    	return view('hinimo/single-product-details', compact('product', 'carts', 'cartCount', 'user', 'addresses', 'boutiques', 'totalPrice', 'page_title', 'notifications', 'notificationsCount'));
    }

    public function addtoCart($productID)
    {
   		$userID = Auth()->user()->id;
    	$cart = Cart::create([
    		'productID' => $productID,
    		'userID' => $userID,
    		'status' => "Pending"
    	]);

    	return redirect('/shop');
    }

    public function cart()
    {
        $page_title = "Cart";
   		$userID = Auth()->user()->id;
    	$carts = Cart::where('userID', $userID)->where('status', "Pending")->get();
        $boutiques = Boutique::all();
    	
    	return view('hinimo/cart', compact('carts', 'boutiques', 'page_title'));
    }

    public function removeItem($cartID)
    {
        $item = Cart::where('id', $cartID)->delete();

        return redirect('/cart');
    }

    public function getCart($productID)
    {
    	$product = Product::find($productID);

    	return response()->json(['product' => $product, 
    		'owner' => $product->owner,
    		'category' => $product->getCategory
    		]);
    }

    public function checkout()
    {
        $page_title = "checkout";

    	return view('hinimo/checkout', compact('page_title'));
    }

    public function useraccount()
    {
        $page_title = "My Account";
        $id = Auth()->user()->id;
        $user = User::find($id);
        $categories = Category::all();
        $products = Product::all();
        $cartCount = Cart::where('userID', $id)->where('status',"Pending")->count();
        $carts = Cart::where('userID', $id)->where('status', "Pending")->get();
        $addresses = Address::where('userID', $id)->get();
        $boutiques = Boutique::all();
        $cities = City::where('provCode', '0722')->orderBy('citymunDesc', 'ASC')->get();
        $barangays = Barangay::all();
        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);

        return view('hinimo/useraccount', compact('categories', 'products', 'carts', 'cartCount', 'user', 'cities', 'barangays', 'addresses', 'boutiques', 'page_title', 'notifications', 'notificationsCount'));
    }

    public function getBrgy($citymunCode)
    {
        $brgys = Barangay::where('citymunCode', $citymunCode)->orderBy('brgyDesc', 'ASC')->get();

        return response()->json(['brgys' => $brgys]);
    }

    public function addAddress(Request $request)
    {
        $id = Auth()->user()->id;

        $address = Address::create([
            'userID' => $id, 
            'contactName' => $request->input('contactName'), 
            'phoneNumber' => $request->input('phoneNumber'),
            'city' => $request->input('city'), 
            'barangay' => $request->input('barangay'), 
            'completeAddress' => $request->input('completeAddress'),
            'status' => "Default"
        ]);

        return redirect('/user-account');
    }

    public function setAsDefault($addressID)
    {
        $id = Auth()->user()->id;

        $addresses = Address::where('status', "Default")->update([
            'status' => ""
        ]);

        $address = Address::where('id', $addressID)->update([
            'status' => "Default"
        ]);

        return redirect('/user-account#addresses');
    }

    public function sortBy($condition)
    {
        $userID = Auth()->user()->id;
        $categories = Category::all();
        $cartCount = Cart::where('userID', $userID)->where('status', "Pending")->count();
        $carts = Cart::where('userID', $userID)->where('status', "Pending")->get();
        // dd($carts);

        if ($condition == "newest") {

            $products = Product::all();
            $sorted = sort($products['created_at']);
        }

        return redirect('/shop');
    }

    public function getProducts($condition)
    {
        if ($condition == "newest") {

            $products = Product::all();

            foreach ($products as $product) {
                $product->owner;
                $product->getCategory;
                $product->productFile;
            }

            $productsArray = $products->toArray();

            array_multisort(array_column($productsArray, "created_at"), SORT_DESC, $productsArray);

        }else if($condition == "newest"){

        }

        return response()->json([
            'products' => $productsArray
        ]);
    }

    public function requestToRent(Request $request)
    {
        $id = Auth()->user()->id;
        $user = User::find($id);

        $measurement = $request->input('measurement');
        $mName = json_encode($measurement);

        $rent = Rent::create([
            'boutiqueID' => $request->input('boutiqueID'),
            'customerID' => $id, 
            'status' => "Pending", 
            'productID' => $request->input('productID'), 
            'dateToUse' => $request->input('dateToUse'), 
            'locationToBeUsed' => $request->input('locationToBeUsed'), 
            'addressOfDelivery' => $request->input('addressOfDelivery'),
            'additionalNotes' => $request->input('additionalNotes'),
            'subtotal' => $request->input('subtotal'),
            'deliveryFee' => $request->input('deliveryFee'),
            'total' => $request->input('total'),
            'paymentStatus' => "Not Yet Paid"
        ]);

        $measurement = Measurement::create([
            'userID' => $id,
            'type' => 'rent',
            'typeID' => $rent['rentID'],
            'data' => $mName
        ]);

        Rent::where('rentID', $rent['rentID'])->update([
            'measurementID' => $measurement['id']
        ]);

        $boutique = Boutique::where('id', $rent['boutiqueID'])->first();
        $boutiqueseller = User::find($boutique['userID']);
        
        $boutiqueseller->notify(new RentRequest($rent));

        return redirect('/shop');
    }

    public function receiveRent($rentID)
    {
        $rent = Rent::where('rentID', $rentID)->first();
        $rent->update([
            'status' => "On Rent"
        ]);

        return redirect('/view-rent/'.$rent['rentID']);
    }

    public function showBiddings()
    {
        if (Auth::check()) {
        $userID = Auth()->user()->id;
        }

        $page_title = 'Biddings';
        $products = [];
        $productsCount = Bidding::all()->count();
        $categories = Category::all();
        $cartCount = Cart::where('userID', "")->where('status', "Pending")->count();
        $carts = Cart::where('userID', "")->where('status', "Pending")->get();
        $boutiques = Boutique::all();
        $biddings = Bidding::all();
        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);

        return view('hinimo/bidding', compact('page_title', 'products', 'categories', 'carts', 'cartCount', 'userID', 'productsCount', 'boutiques', 'biddings', 'notificationsCount', 'notifications'));
    }

    public function showStartNewBidding()
    {
        $page_title = "Start a New Bid";
        $userID = Auth()->user()->id;
        $products = [];
        $productsCount = Product::all()->count();
        $categories = Category::all();
        $cartCount = Cart::where('userID', $userID)->where('status', "Pending")->count();
        $carts = Cart::where('userID', $userID)->where('status', "Pending")->get();
        $boutiques = Boutique::all();
        $tags = Tag::all();
        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);

        return view('hinimo/bidding-newBidding', compact('page_title', 'products', 'categories', 'carts', 'cartCount', 'userID', 'productsCount', 'boutiques', 'tags', 'notifications', 'notificationsCount'));
    }

    public function savebidding(Request $request)
    {
        // dd($request->input('productType'));

        $bidding = Bidding::create([
            'productType' => $request->input('productType'),
            'startingprice' => $request->input('startingprice'),
            'notes' => $request->input('notes'),
            'endDate' => $request->input('endDate'),
            'dateOfUse' => $request->input('dateOfUse'),
        ]);

        $tags = $request->input('tags');

        foreach($tags as $tag) {
            Prodtag::create([
                'tagID' => $tag,
                'biddingID' => $bidding['id']
            ]);
        }

        return redirect('/biddings');
    }

    public function notifications()
    {
        $page_title = "Notifications";
        $userID = Auth()->user()->id;
        $categories = Category::all();
        $products = Product::all();
        $cartCount = Cart::where('userID', $userID)->where('status', "Pending")->count();
        $carts = Cart::where('userID', $userID)->where('status', "Pending")->get();
        $boutiques = Boutique::all();

        $user = User::find($userID);
        $notifications = $user->notifications;
        $notificationsCount = $user->unreadNotifications->count();

        return view('hinimo/notifications', compact('categories', 'products', 'carts', 'cartCount', 'userID', 'boutiques', 'page_title', 'notifications', 'notificationsCount'));
    }

    public function viewNotification($notificationID)
    {
        $page_title = "View Notification";
        $userID = Auth()->user()->id;
        $categories = Category::all();
        $products = Product::all();
        $cartCount = Cart::where('userID', $userID)->where('status', "Pending")->count();
        $carts = Cart::where('userID', $userID)->where('status', "Pending")->get();
        $boutiques = Boutique::all();

        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);

        foreach($notifications as $notification) {
            if($notification->id == $notificationID) {

                if($notification->type == 'App\Notifications\RentApproved'){
                    $notif = $notification;
                    $notification->markAsRead();

                    return redirect('/view-rent/'.$notification->data['rentID']);
                    
                }elseif($notification->type == 'App\Notifications\RentUpdateForCustomer'){
                    $notif = $notification;
                    $notification->markAsRead();

                    return redirect('/view-rent/'.$notification->data['rentID'].'#rent-details');

                }elseif($notification->type == 'App\Notifications\MtoUpdateForCustomer'){
                    $notif = $notification;
                    $notification->markAsRead();

                    return redirect('/view-mto/'.$notification->data['mtoID']);
                }
            }
        }
    }

    public function getCategory($genderCategory)
    {
        $categories = Category::where('gender', $genderCategory)->get();

        return response()->json(['categories' => $categories]);
    }

    public function madeToOrder($boutiqueID)
    {
        $boutique = Boutique::where('id', $boutiqueID)->first();
        $page_title = $boutique['boutiqueName'];
        $userID = Auth()->user()->id;
        $categories = Category::all();
        $cartCount = Cart::where('userID', $userID)->where('status', "Pending")->count();
        $carts = Cart::where('userID', $userID)->where('status', "Pending")->get();
        $boutiques = Boutique::all();
        $notAvailables = Product::where('boutiqueID', $boutique['id'])->where('productStatus', 'Not Available')->get();
        $measurements = Categorymeasurement::all();

        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);
        
        return view('hinimo/madetoorder', compact('categories', 'carts', 'cartCount', 'userID', 'boutiques', 'boutique', 'notAvailables', 'page_title', 'notifications', 'notificationsCount', 'categoryArray'));
    }

    public function saveMadeToOrder(Request $request)
    {
        $userID = Auth()->user()->id;
        $boutiqueID = $request->input('boutiqueID');

        $measurement = $request->input('measurement');
        $mCategories = $request->input('mCategory');
        // dd($measurement);

        $mName = json_encode($measurement);
       
        $mto = Mto::create([
            'userID' => $userID,
            'boutiqueID' => $boutiqueID,
            'notes' => $request->input('notes'),
            'dateOfUse' => $request->input('dateOfUse'),
            'height' => $request->input('height'),
            'categoryID' => $request->input('category'),
            'status' => "Pending",
            'paymentStatus' => 'Not Yet Paid'
            ]);

        $measurement = Measurement::create([
            'userID' => $userID,
            'type' => 'mto',
            'typeID' => $mto['id'],
            'data' => $mName
        ]);

        Mto::where('id', $mto['id'])->update([
            'measurementID' => $measurement['id']
        ]);

        $upload = $request->file('file');

        if($request->hasFile('file')) {
            $files = new File();
            $name = $upload->getClientOriginalName();
            $destinationPath = public_path('uploads');
            $filename = $destinationPath.'\\'. $name;
            $upload->move($destinationPath, $filename);

            $files->userID = $userID;
            $files->mtoID = $mto['id'];
            $files->filename = "/".$name;
            $files->save();
            $filename = "/".$name;
        }

        $boutique = Boutique::where('id', $boutiqueID)->first();
        $boutiqueseller = User::find($boutique['userID']);
        $boutiqueseller->notify(new NewMTO($mto));

      return redirect('boutique/'.$boutiqueID);
    }

    public function getMeasurements($categoryID)
    {
        $measurements = Categorymeasurement::where('categoryID', $categoryID)->get();

        return response()->json(['measurements' => $measurements]);
    }

    public function usertransactions()
    {
        $page_title = "Transactions";
        $userID = Auth()->user()->id;
        $user = User::find($userID);
        $cartCount = Cart::where('userID', $userID)->where('status', "Pending")->count();
        $carts = Cart::where('userID', $userID)->where('status', "Pending")->get();
        $boutiques = Boutique::all();
        $notifications = $user->notifications;
        $notificationsCount = $user->unreadNotifications->count();

        $orders = Order::where('userID', $userID)->get();
        $rents = Rent::where('customerID', $userID)->get();
        $mtos = Mto::where('userID', $userID)->get();
        
        $cart = Cart::where('userID', $userID)->get();

        return view('hinimo/transactions', compact('carts', 'cartCount', 'boutiques', 'page_title', 'mtos', 'orders', 'rents', 'notifications', 'notificationsCount'));
    }

    public function viewOrder($orderID)
    {
        $page_title = "Order Details";
        $userID = Auth()->user()->id;
        $user = User::find($userID);
        $cartCount = Cart::where('userID', $userID)->where('status', "Pending")->count();
        $carts = Cart::where('userID', $userID)->where('status', "Pending")->get();
        $boutiques = Boutique::all();
        $notifications = $user->notifications;
        $notificationsCount = $user->unreadNotifications->count();

        $order = Order::find($orderID);
        // dd($order);

        return view('hinimo/viewOrder', compact('carts', 'cartCount', 'boutiques', 'page_title', 'mtos', 'orders', 'rents', 'notifications', 'notificationsCount', 'order'));
    }

    public function viewRent($rentID)
    {
        $page_title = "Rent Details";
        $userID = Auth()->user()->id;
        $user = User::find($userID);
        $cartCount = Cart::where('userID', $userID)->where('status', "Pending")->count();
        $carts = Cart::where('userID', $userID)->where('status', "Pending")->get();
        $boutiques = Boutique::all();
        $notifications = $user->notifications;
        $notificationsCount = $user->unreadNotifications->count();

        $rent = Rent::find($rentID);

        return view('hinimo/viewRent', compact('carts', 'cartCount', 'boutiques', 'page_title', 'mtos', 'orders', 'rents', 'notifications', 'notificationsCount', 'rent'));
    }

    public function viewMto($mtoID)
    {
        $page_title = "MTO Details";
        $userID = Auth()->user()->id;
        $user = User::find($userID);
        $cartCount = Cart::where('userID', $userID)->where('status', "Pending")->count();
        $carts = Cart::where('userID', $userID)->where('status', "Pending")->get();
        $boutiques = Boutique::all();
        $notifications = $user->notifications;
        $notificationsCount = $user->unreadNotifications->count();

        $mto = Mto::find($mtoID);
        $measurement = json_decode($mto->measurement->data);
        // dd($measurement);

        return view('hinimo/viewMto', compact('carts', 'cartCount', 'boutiques', 'page_title', 'mtos', 'orders', 'rents', 'notifications', 'notificationsCount', 'mto'));
    }

    public function paypalpaypalTransactionComplete(Request $request)
    {
        $rent = Rent::where('rentID', $request->rentID)->first();

        // print_r($request->orderID);
        $rent->update([
            'paymentStatus' => 'Paid',
            'paypalOrderID' => $request->orderID
        ]);

        return redirect('/view-rent/'.$rent['rentID']);
    }

    public static function getPaypalOrder($orderId)
    {

        // 3. Call PayPal to get the transaction details
        $client = PayPalClient::client();
        $response = $client->execute(new OrdersGetRequest($orderId));
        /**
         *Enable the following line to print complete response as JSON.
         */
        print json_encode($response->result);
        print "Status Code: {$response->statusCode}\n";
        print "Status: {$response->result->status}\n";
        print "Order ID: {$response->result->id}\n";
        print "Intent: {$response->result->intent}\n";
        print "Links:\n";
        foreach($response->result->links as $link)
        {
          print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
        }
        // 4. Save the transaction in your database. Implement logic to save transaction to your database for future reference.
        print "Gross Amount: {$response->result->purchase_units[0]->amount->currency_code} {$response->result->purchase_units[0]->amount->value}\n";

        // To print the whole response body, uncomment the following line
        print_r(json_encode($response->result, JSON_PRETTY_PRINT));
    }


}
