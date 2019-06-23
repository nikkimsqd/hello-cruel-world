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
// use App\MeasurementRequest;
use App\Categorymeasurement;
use App\Cartitem;
use App\Fabric;
use App\Notifications\RentRequest;
use App\Notifications\NewMTO;
use App\Notifications\CustomerAcceptsOffer;
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;


class CustomerController extends Controller
{
    public function shop() //ipa una n para mo check una sa auth
    {
        if (Auth::check()) { //check if nay naka login nga user
            if(Auth()->user()->roles == "customer") {
                $page_title = "Shop";
                $userID = Auth()->user()->id;
                $products = Product::where('productStatus', 'Available')->get();
                $productsCount = $products->count();
                $categories = Category::all();
                $boutiques = Boutique::all();
                $notAvailables = Product::where('productStatus', 'Not Available')->get();
                $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
                if($cart != null){
                    $cartCount = $cart->items->count();
                }else{
                    $cartCount = 0;
                }

                $notifications;
                $notificationsCount;
                $this->getNotifications($notifications, $notificationsCount);

                return view('hinimo/shop', compact('products', 'categories', 'cart', 'cartCount', 'userID', 'productsCount', 'boutiques', 'notAvailables', 'page_title', 'notifications', 'notificationsCount'));

            } else if(Auth()->user()->roles == "boutique") {
                return redirect('/dashboard');
            } else if(Auth()->user()->roles == "admin") {
                return redirect('/admin-dashboard');
            }       
        }else {
            $page_title = "Shop";
            $userID = null;
            $products = Product::where('productStatus', 'Available')->get();
            $productsCount = $products->count();
            $categories = Category::all();
            // $cartCount = Cart::where('userID', "")->where('status', "Pending")->count();
            $cart = null;
            $cartCount = null;
            $boutiques = Boutique::all();
            $notAvailables = Product::where('productStatus', 'Not Available')->get();
            $notificationsCount = null;
                // dd($cart);

            return view('hinimo/shop', compact('products', 'categories', 'cart', 'cartCount', 'userID', 'productsCount', 'boutiques', 'notAvailables', 'page_title', 'notificationsCount'));
        }
    }

    public function getNotifications(&$notifications, &$notificationsCount)
    {
        if (Auth::check()) {
            $userID = Auth()->user()->id;
            $user = User::find($userID);
            $notifications = $user->notifications;
            $notificationsCount = $user->unreadNotifications->count();
        }
    }

    public function welcome()
    {
    }

    public function getStarted()
    {
        $page_title = "profiling";
        return view('hinimo/getstarted', compact('page_title'));
    }

    public function profiling(Request $request)
    {
        $page_title = "profiling";
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
        $boutiques = Boutique::all();
        $boutique = Boutique::where('id', $boutiqueID)->first();
        $page_title = $boutique['boutiqueName'];
        $notAvailables = Product::where('boutiqueID', $boutiqueID)->where('productStatus', 'Not Available')->get();
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);

    	return view('hinimo/boutiqueProfile', compact('categories', 'products', 'productsCount', 'cart', 'cartCount', 'userID', 'boutiques', 'boutique', 'notAvailables', 'page_title', 'notifications', 'notificationsCount'));
    }

    public function productDetails($productID)
    {
        $user = Auth()->user();
    	$product = Product::where('id', $productID)->first();
        $addresses = Address::where('userID', $user['id'])->get();
        $boutiques = Boutique::all();
        $page_title = "Shop";
        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);
        $cart = Cart::where('userID', $user['id'])->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        $barangays = Barangay::all();

        // dd($product->rentDetails->locations);
        
        $totalPrice = $product['rentPrice'] + $product['deliveryFee'];

    	return view('hinimo/single-product-details', compact('product', 'cart', 'cartCount', 'user', 'addresses', 'boutiques', 'totalPrice', 'page_title', 'notifications', 'notificationsCount', 'barangays'));
    }

    public function addtoCart($productID)
    {
   		$userID = Auth()->user()->id;
        $cart = Cart::where('userID', $userID)->orderBy('created_at', 'DESC')->first();

        if($cart == null){
            $cart = Cart::create([
                'userID' => $userID,
                'status' => "Active"
            ]);

        }else{
            if($cart['status'] == "Inactive"){
                $cart = Cart::create([
                    'userID' => $userID,
                    'status' => "Active"
                ]);
            }
            
        }

        Cartitem::create([
            'cartID' => $cart['id'],
            'productID' => $productID
        ]);
    	

    	return redirect('/shop');
    }

    public function cart()
    {
        $page_title = "Cart";
   		$userID = Auth()->user()->id;
        $boutiques = Boutique::all();
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }
    	
    	return view('hinimo/cart', compact('cart', 'boutiques', 'page_title'));
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

    public function placeOrder(Request $request)
    {
        $order = Order::create([
            'userID' => $request->input('userID'),
            'cartID' => $request->input('cartID'),
            'subtotal' => $request->input('subtotal'),
            'deliveryfee' => $request->input('deliveryfee'),
            'total' => $request->input('total'),
            'boutiqueID' => $request->input('boutiqueID'),
            'deliveryAddress' => $request->input('deliveryAddress'),
            'status' => 'In-Progress',
            'paymentStatus' => 'Not Yet Paid'
        ]);

        $cart = Cart::where('id', $order['cartID'])->first();
        $cart->update([
            'status' => 'Inactive'
        ]);
        foreach($cart->items as $item){
            Product::where('id', $item->product['id'])->update([
                'productStatus' => "Not Available"
            ]);
        }

        

        //add churva for add address here

        return redirect('/view-order/'.$order['id']);
    }

    public function checkout()
    {
        $page_title = "Checkout";
        $userID = Auth()->user()->id;
        $user = User::find($userID);
        $boutiques = Boutique::all();
        $notAvailables = Product::where('productStatus', 'Not Available')->get();
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);

    	return view('hinimo/checkout', compact('page_title', 'cart', 'cartCount', 'user', 'boutiques', 'notifications', 'notificationsCount'));
    }

    public function useraccount()
    {
        $page_title = "My Account";
        $id = Auth()->user()->id;
        $user = User::find($id);
        $categories = Category::all();
        $products = Product::all();
        $addresses = Address::where('userID', $id)->get();
        $boutiques = Boutique::all();
        $cities = City::where('provCode', '0722')->orderBy('citymunDesc', 'ASC')->get();
        $barangays = Barangay::all();
        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);
        $cart = Cart::where('userID', $id)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }


        return view('hinimo/useraccount', compact('categories', 'products', 'cart', 'cartCount', 'user', 'cities', 'barangays', 'addresses', 'boutiques', 'page_title', 'notifications', 'notificationsCount'));
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
        // $userID = Auth()->user()->id;
        // $categories = Category::all();
        // $cartCount = Cart::where('userID', $userID)->where('status', "Pending")->count();
        // $carts = Cart::where('userID', $userID)->where('status', "Pending")->get();
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

        $dateuse = $request->input('dateToUse');
        $toadd = $request->input('limitOfDays');
        $dateToBeReturned = date('Y-m-d', strtotime($dateuse.'+'.$toadd.' days'));

        $rent = Rent::create([
            'boutiqueID' => $request->input('boutiqueID'),
            'customerID' => $id, 
            'status' => "In-Progress", 
            'productID' => $request->input('productID'), 
            'dateToUse' => $request->input('dateToUse'), 
            'dateToBeReturned' => $dateToBeReturned, 
            'additionalNotes' => $request->input('additionalNotes')
        ]);

        $measurement = Measurement::create([
            'userID' => $id,
            'type' => 'rent',
            'typeID' => $rent['rentID'],
            'data' => $mName
        ]);

        $order = Order::create([
            'userID' => $id,
            'rentID' => $rent['rentID'],
            'boutiqueID' => $request->input('boutiqueID'),
            'subtotal' => $request->input('subtotal'),
            'deliveryfee' => $request->input('deliveryfee'),
            'total' => $request->input('total'),
            'deliveryAddress' => $request->input('addressOfDelivery'),
            'status' => "In-Progress",
            'paymentStatus' => "Not Yet Paid"
        ]);

        $rent->update([
            'orderID' => $order['id'],
            'measurementID' => $measurement['id']
        ]);

        Product::where('id', $rent['productID'])->update([
            'productStatus' => "Not Available"
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
        $order = Order::where('rentID', $rentID)->update([
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
        $boutiques = Boutique::all();
        $biddings = Bidding::all();
        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        return view('hinimo/bidding', compact('page_title', 'products', 'categories', 'cart', 'cartCount', 'userID', 'productsCount', 'boutiques', 'biddings', 'notificationsCount', 'notifications'));
    }

    public function showStartNewBidding()
    {
        $page_title = "Start a New Bid";
        $userID = Auth()->user()->id;
        $products = [];
        $productsCount = Product::all()->count();
        $categories = Category::all();
        $boutiques = Boutique::all();
        $tags = Tag::all();
        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        return view('hinimo/bidding-newBidding', compact('page_title', 'products', 'categories', 'cart', 'cartCount', 'userID', 'productsCount', 'boutiques', 'tags', 'notifications', 'notificationsCount'));
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
        $boutiques = Boutique::all();
        $user = User::find($userID);
        $notifications = $user->notifications;
        $notificationsCount = $user->unreadNotifications->count();
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        return view('hinimo/notifications', compact('categories', 'products', 'cart', 'cartCount', 'userID', 'boutiques', 'page_title', 'notifications', 'notificationsCount'));
    }

    public function viewNotification($notificationID)
    {
        $page_title = "View Notification";
        $userID = Auth()->user()->id;
        $boutiques = Boutique::all();
        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);
        // $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        // if($cart != null){
        //     $cartCount = $cart->items->count();
        // }else{
        //     $cartCount = 0;
        // }

        foreach($notifications as $notification) {
            if($notification->id == $notificationID) {

                if($notification->type == 'App\Notifications\RentApproved'){
                    $notification->markAsRead();

                    return redirect('/view-rent/'.$notification->data['rentID']);
                    
                }elseif($notification->type == 'App\Notifications\RentUpdateForCustomer'){
                    $notification->markAsRead();

                    return redirect('/view-rent/'.$notification->data['rentID'].'#rent-details');

                }elseif($notification->type == 'App\Notifications\MtoUpdateForCustomer'){
                    $notification->markAsRead();

                    return redirect('/view-mto/'.$notification->data['mtoID'].'#mto-details');

                }elseif($notification->type == 'App\Notifications\ContactCustomer'){
                    // $notif = $notification;
                    $notification->markAsRead();

                    return redirect('/view-mto/'.$notification->data['mtoID'].'#mto-details');
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
        $boutiques = Boutique::all();
        $notAvailables = Product::where('boutiqueID', $boutique['id'])->where('productStatus', 'Not Available')->get();
        $measurements = Categorymeasurement::all();
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }
        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);

        $fabrics = Fabric::where('boutiqueID', $boutiqueID)->get();
        $fabs = $fabrics->groupBy('name');
        // dd($fabs);
        
        return view('hinimo/madetoorder', compact('categories', 'cart', 'cartCount', 'userID', 'boutiques', 'boutique', 'notAvailables', 'page_title', 'notifications', 'notificationsCount', 'categoryArray', 'fabrics', 'fabs'));
    }

    public function getFabricColor($type)
    {
        $colors = Fabric::where('name', $type)->get();

        return response()->json(['colors' => $colors]);
    }

    public function saveMadeToOrder(Request $request)
    {
        $userID = Auth()->user()->id;
        $boutiqueID = $request->input('boutiqueID');
        $measurement = $request->input('measurement');
        $mCategories = $request->input('mCategory');
        $fabricChoice = $request->input('fabricChoice');

        $fabChoice = json_encode($fabricChoice);
        $mName = json_encode($measurement);
       
        // dd($request->input('fabric'));
        // if($fabChoice == null){
        // dd("sud");
        // }else{
        //     dd($fabricChoice);
        // }

        $mto = Mto::create([
            'userID' => $userID,
            'boutiqueID' => $boutiqueID,
            'dateOfUse' => $request->input('dateOfUse'),
            'notes' => $request->input('notes'),
            'height' => $request->input('height'),
            'categoryID' => $request->input('category'),
            'fabricChoice' => $fabChoice,
            'price' => $request->input('price'),
            'orderID' => $request->input('orderID'),
            'status' => "Active"
            ]);

        if($request->input('fabric') == "suggest"){
            $mto->update([
                'suggestFabric' => "true"
            ]);

        }elseif($request->input('fabric') == "choose"){
            $mto->update([
                'fabricID' => $request->input('fabricID')
            ]);
        }

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
            // $name = $upload->getClientOriginalName();
            $destinationPath = public_path('uploads');
            $name = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7).$upload->getClientOriginalName();
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
        $boutiques = Boutique::all();
        $notifications = $user->notifications;
        $notificationsCount = $user->unreadNotifications->count();
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        $orders = Order::where('userID', $userID)->get();
        $rents = Rent::where('customerID', $userID)->get();
        $mtos = Mto::where('userID', $userID)->where('status', 'Active')->get();
        // dd($orders);

        $transactions = array();
        array_push($transactions, $orders);
        array_push($transactions, $rents);
        array_push($transactions, $mtos);
        // dd($transactions);

        // $productsArray = $products->toArray();
        // array_multisort(array_column($transactions, "created_at"), SORT_DESC, $transactions);

        return view('hinimo/transactions', compact('cart', 'cartCount', 'boutiques', 'page_title', 'mtos', 'orders', 'rents', 'notifications', 'notificationsCount'));
    }

    public function viewOrder($orderID)
    {
        $page_title = "Order Details";
        $userID = Auth()->user()->id;
        $user = User::find($userID);
        $boutiques = Boutique::all();
        $notifications = $user->notifications;
        $notificationsCount = $user->unreadNotifications->count();
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        $order = Order::find($orderID);

        return view('hinimo/viewOrder', compact('cart', 'cartCount', 'boutiques', 'page_title', 'mtos', 'orders', 'rents', 'notifications', 'notificationsCount', 'order'));
    }

    public function viewRent($rentID)
    {
        $page_title = "Rent Details";
        $userID = Auth()->user()->id;
        $user = User::find($userID);
        $boutiques = Boutique::all();
        $notifications = $user->notifications;
        $notificationsCount = $user->unreadNotifications->count();
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        $rent = Rent::find($rentID);

        return view('hinimo/viewRent', compact('cart', 'cartCount', 'boutiques', 'page_title', 'mtos', 'orders', 'rents', 'notifications', 'notificationsCount', 'rent'));
    }

    public function viewMto($mtoID)
    {
        $page_title = "MTO Details";
        $userID = Auth()->user()->id;
        $user = User::find($userID);
        $boutiques = Boutique::all();
        $notifications = $user->notifications;
        $notificationsCount = $user->unreadNotifications->count();
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        $mto = Mto::find($mtoID);
        $measurement = json_decode($mto->measurement->data);
        $fabrics = Fabric::where('boutiqueID', $mto->boutique['id'])->get();
        // dd($fabrics);

        return view('hinimo/viewMto', compact('cart', 'cartCount', 'boutiques', 'page_title', 'mtos', 'orders', 'rents', 'notifications', 'notificationsCount', 'mto', 'fabrics'));
    }

    public function inputAddress($mtoID, $type)
    {
        $page_title = "Submit Address";
        $userID = Auth()->user()->id;
        $user = User::find($userID);
        $boutiques = Boutique::all();
        $notifications = $user->notifications;
        $notificationsCount = $user->unreadNotifications->count();
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        $mto = Mto::find($mtoID);  
        $measurements = json_decode($mto->measurement->data);
        $fabricChoice = json_decode($mto['fabricChoice']);
        $fabricSuggestion = json_decode($mto['fabricSuggestion']);

        if($type == "acceptFPrice"){
            $mtoPrice = $mto['price'];

        }elseif($type == "acceptFCPrice"){ //fabricChoice
            $mtoPrice = $mto['price'];

        }elseif($type == "acceptSFPrice"){ //suggestFabric
            $mtoPrice = $fabricSuggestion->price;

        }elseif($type == "acceptFSPrice"){ //fabricSuggestion
            $mtoPrice = $fabricSuggestion->price;

        }
        
        return view('hinimo/inputAddress', compact('cart', 'cartCount', 'boutiques', 'page_title', 'mtos', 'orders', 'rents', 'notifications', 'notificationsCount', 'mto', 'mtoPrice'));

    }

    public function makeOrderforMTO(Request $request)
    {
        $userID = Auth()->user()->id;
        $mtoID = $request->input('mtoID');
        $mto = Mto::find($mtoID);

        $order = Order::create([
            'userID' => $userID,
            'mtoID' => $mtoID,
            'boutiqueID' => $mto->boutique['id'],
            'subtotal' => $request->input('subtotal'),
            'deliveryfee' => $request->input('deliveryfee'),
            'total' => $request->input('total'),
            'deliveryAddress' => $request->input('deliveryAddress'),
            'status' => "In-Progress",
            'paymentStatus' => "Not Yet Paid"           
        ]);

        $mto->update([
            'orderID' => $order['id']
        ]);

        $boutique = Boutique::where('id', $mto->boutique['id'])->first();
        $boutiqueseller = User::where('id', $mto->boutique->owner['id'])->first();
        $boutiqueseller->notify(new CustomerAcceptsOffer($mto));

        return redirect('/view-mto/'.$mtoID);
    }

    public function cancelMto($mtoID)
    {
        $mto = Mto::where('id', $mtoID)->first();
        // $mto->update([
        //     'status' => "Cancelled"
        // ]);

        //send notif to boutiquedat u cencelledt
        // $boutique = Boutique::where('id', $mto->boutique['id'])->first();
        $boutiqueseller = User::where('id', $mto->boutique->owner['id'])->first();
        dd($boutiqueseller);
        $boutiqueseller->notify(new CustomerAcceptsOffer($mto));

        return redirect('/user-transactions');
    }

    public function receiveOrder($orderID)
    {
        $order = Order::find($orderID);
        $order->update([
            'status' => 'Completed'
        ]);
        // dd($order);
        
        //add notification to boutique
        //informing that completed na nag transaction 
        //nya dapat diri sad nga part makuha na ni boutique iyang bayad

        if($order['cartID'] != null){
            return redirect('/view-order/'.$order['id']);
        }
        elseif($order['rentID'] != null){
            return redirect('/view-rent/'.$order->rent['rentID']);
        }
        elseif($order['mtoID'] != null){
            return redirect('/view-mto/'.$order->mto['id']);
        }
        
    }

    // public function submitAddress(Request $request)
    // {
    //     if($request->input('mtoID') != null){
    //         $mto = Mto::where('id', $request->input('mtoID'))->first();
    //         $mto->update([
    //             'subtotal' => $mto['finalPrice'],
    //             'deliveryFee' => 50, //dummy pa ni
    //             'total' => $mto['finalPrice'] + 50,
    //             'deliveryAddress' => $request->input('address')
    //         ]);

    //         return redirect('/view-mto/'.$mto['id']);
    //     }

    // }

    public function paypalpaypalTransactionComplete(Request $request)
    {
        // print_r($request->mtoOrderID);

        if($request->rentID != null){
            $rent = Rent::where('rentID', $request->rentID)->first();
            $order = Order::where('id', $request->rentOrderID)->update([
                'paymentStatus' => 'Paid',
                'paypalOrderID' => $request->paypalOrderID
            ]);

            return redirect('/view-rent/'.$rent['rentID']);

        }elseif($request->mtoOrderID != null){
            $order = Order::where('id', $request->mtoOrderID)->update([
                'paymentStatus' => 'Paid',
                'paypalOrderID' => $request->paypalOrderID
            ]);
            $mto = Mto::where('id', $request->mtoID)->first();

            return redirect('/view-mto/'.$mto['id']);

        }elseif($request->orderTransactionID != null){
            $order = Order::where('id', $request->orderTransactionID)->first();
            $order->update([
                'paymentStatus' => 'Paid',
                'paypalOrderID' => $request->paypalOrderID
            ]);
        }
        
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

    public function mixnmatch($boutiqueID)
    {
        $userID = Auth()->user()->id;
        $categories = Category::all();
        $products = Product::all();
        $boutiques = Boutique::all();
        $boutique = Boutique::where('id', $boutiqueID)->first();
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }
        $page_title = "Mix & Match by ".$boutique['boutiqueName'];

        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);
        // dd($products);
        return view('hinimo/mixnmatch', compact('page_title', 'userID', 'categories', 'products', 'cart', 'cartCount', 'boutiques', 'notifications', 'notificationsCount'));
    }

    public function getMProduct($productID)
    {
        $product = Product::where('id', $productID)->first();

        return response()->json(['product' => $product,
                                'files' => $product->productFile
                                    ]);
    }

    public function submitMixnmatch(Request $request)
    {
        $top = $request->input('top');
        $bottom = $request->input('bottom');

        
    }


}
