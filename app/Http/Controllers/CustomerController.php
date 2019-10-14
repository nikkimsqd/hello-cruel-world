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
use App\Bid;
use App\Itemtag;
use App\Tag;
use App\Order;
use App\File;
use App\Mto;
use App\Measurement;
use App\Categorymeasurement;
use App\Cartitem;
use App\Fabric;
use App\Sharepercentage;
use App\Gallery;
use App\Set;
use App\Measurementrequest;
use App\Payment;
use App\Favorite;
use App\Event;
use App\Categorytag;
use App\Complain;
use App\Chat;
use App\Refund;
use App\Rtw;
use App\Deliveryfee;
use App\View;
use App\Notifications\RentRequest;
use App\Notifications\NewMTO;
use App\Notifications\CustomerAcceptsOffer;
use App\Notifications\CustomerCancelMto;
use App\Notifications\CustomerAcceptsBid;
use App\Notifications\NewOrder;
use App\Notifications\CustomerPaysOrder;
use App\Notifications\NewBidding;
use App\Notifications\CustomerDoesntAcceptOffer;
use App\Notifications\NotifyOfComplain;
use App\Notifications\NotifyAdminOfComplain;
use App\Notifications\NotifyBoutiqueOfChat;
use App\Notifications\PaypalEmailSubmitted;
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;


class CustomerController extends Controller
{

    public function shop(Request $request) //ipa una n para mo check una sa auth
    {
        if (Auth::check()) { //check if nay naka login nga user
            if(Auth()->user()->roles == "customer") {
                $activeLink = "womens";
                $page_title = "Shop";
                $userID = Auth()->user()->id;
                $categories = Category::all();
                $boutiques = Boutique::all();
                $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
                if($cart != null){ $cartCount = $cart->items->count(); }
                else{ $cartCount = 0; }
                $notifications;
                $notificationsCount;
                $this->getNotifications($notifications, $notificationsCount);

                $allProducts = array();
                $products = Product::where('productStatus', 'Available')->with('productFile')->with('inFavorites')->with('owner')->with('rentDetails')->get();
                $sets = Set::where('setStatus', 'Available')->with('owner')->with('rentDetails')->get();

                // dD($products);

                if(!empty($request->input('category'))){
                    foreach($products as $key => $product){
                        if($product->getSubCategory->getCategory['id'] != $request->input('category')){
                            $products->forget($key);
                        }
                    }
                }

                if(!empty($request->input('category'))){
                    foreach($sets as $key => $set){
                        $variable = 0;
                        foreach($set->items as $item){
                            if($item->product->getSubCategory->getCategory['id'] == $request->input('category')){
                                $variable += 1;
                            }
                        }
                        if($variable == 0){
                            $sets->forget($key);
                        }
                    }
                }

                // dd($sets);

                $subCategories = array();
                $profiling = Profiling::where('userID', $userID)->first();
                $profilingDatas = json_decode($profiling['data']);
                foreach($profilingDatas as $profilingData){
                    foreach($profilingData as $subcategory){
                        array_push($subCategories, $subcategory);
                    }
                }

                foreach($products as $product){
                    $points = 0;

                    if(in_array($product['category'], $subCategories)){
                        $points += 2;
                    }

                    $views = View::where('userID', $userID)->where('itemID', $product['id'])->first();
                    if(!empty($views)){
                        $viewPoints = $views['count'] * 1;
                        $points += $viewPoints;
                    }

                    $favorites = Favorite::where('userID', $userID)->get();
                    $favoriteCounter= 0;
                    foreach($favorites as $favorite){
                        $itemID = explode("_", $favorite['itemID']);
                        $itemType = $itemID[0];

                        if($itemType == "PROD"){
                            $prod = Product::where('id', $favorite['itemID'])->first();

                            if($product['category'] == $prod['category']){
                                $favoriteCounter +=1;
                            }
                        }else{
                            $setset = Set::where('id', $favorite['itemID'])->first();
                            foreach($setset->items as $item){
                                $setprod = $product::where('id', $item->product['id'])->first();

                                if($setprod['category'] == $product['category']){
                                    $favoriteCounter += 1;
                                }
                            }
                        }
                    }

                    // $lastOrders = ;
                    //loop orders
                    //loop product
                    //

                    $points += $favoriteCounter * 2.5;

                    $product['points'] = $points;
                }

                $products = $products->sortBy(function($product){
                    return -$product->points;
                });


                foreach($sets as $set){
                    $points = 0;

                    foreach($set->items as $item){
                        $setprod = Product::where('id', $item->product['id'])->with('productFile')->first();
                        $item['productFile'] = $item->product->productFile;

                        //BASE SA PROFILING
                        if(in_array($item->product['category'], $subCategories)){
                            $points += 2;
                        }

                        //BASE SA VIEWS
                        $views = View::where('itemID', $item->product['id'])->where('userID', $userID)->first();
                        if(!empty($views)){
                            $viewPoints = $views['count'] * 1;
                            $points += $viewPoints;
                        }

                        //BASE SA FAVORITES
                        $favorites = Favorite::where('userID', $userID)->get();
                        $favoriteCounter = 0;
                        foreach($favorites as $favorite){
                            $itemID = explode("_", $favorite['itemID']);
                            $itemType = $itemID[0];

                            if($itemType == "PROD"){
                                $prod = Product::where('id', $favorite['itemID'])->first();

                                if($product['category'] == $prod['category']){
                                    $favoriteCounter +=1;
                                }
                            }else{
                                $setset = Set::where('id', $favorite['itemID'])->first();
                                foreach($set->items as $item){
                                    $setprod = Product::where('id', $item->product['id'])->first();

                                    if($setprod['category'] == $product['category']){
                                        $favoriteCounter += 1;
                                    }
                                }
                            }
                        }
                        $points += $favoriteCounter * 2.5;

                    }
                    $set['in_favorites'] = $favorites;
                    $set['points'] = $points;
                }

                // $sets = Set::where('setStatus', 'Available')->with('inFavorites')->with('owner')->with('rentDetails')->get();
                $sets = $sets->sortBy(function($set){
                    return -$set->points;
                });

                $allProducts = array_merge($products->toArray(), $sets->toArray());
                $pPoints = array_column($allProducts, 'points');
                array_multisort($pPoints, SORT_DESC, $allProducts);

                $productsCount = count($allProducts);

                //PAGINATION
                $currentPage = $request->page;
                $pageItems = 12;
                if(empty($currentPage)){
                    $currentPage = 1;
                }

                $offset = ($currentPage * $pageItems) - $pageItems;
                $itemsForCurrentPage = array_slice($allProducts, $offset, $pageItems);

                $paginator = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, $productsCount, $pageItems, $currentPage);
                $paginator->withPath('shop');

                // dd($paginator);


                return view('hinimo/shop', compact('products', 'categories', 'cart', 'cartCount', 'userID', 'productsCount', 'boutiques', 'page_title', 'notifications', 'notificationsCount', 'paginator', 'activeLink'));
                

            } else if(Auth()->user()->roles == "boutique") {
                return redirect('/dashboard');
            } else if(Auth()->user()->roles == "admin") {
                return redirect('/admin-dashboard');
            } else if(Auth()->user()->roles == "courier") {
                return redirect('/ionic-dashboard');
            }        
        }else {
            $activeLink = "womens";
            $page_title = "Shop";
            $userID = null;
            $products = Product::where('productStatus', 'Available')->with('productFile')->with('inFavorites')->with('owner')->with('rentDetails')->get();
            $productsCount = $products->count();
            $categories = Category::all();
            // $cartCount = Cart::where('userID', "")->where('status', "Pending")->count();
            $cart = null;
            $cartCount = null;
            $boutiques = Boutique::all();
            $notAvailables = Product::where('productStatus', 'Not Available')->get();
            $notificationsCount = null;
            $sets = Set::where('setStatus', 'Available')->with('owner')->with('rentDetails')->get();
            $allProducts = array();

            foreach($products as $product){ array_push($allProducts, $product); }
            foreach($sets as $set){ array_push($allProducts, $set); }

            shuffle($allProducts);
            //PAGINATION
            $currentPage = $request->page;
            $pageItems = 12;
            if(empty($currentPage)){
                $currentPage = 1;
            }

            $offset = ($currentPage * $pageItems) - $pageItems;
            $itemsForCurrentPage = array_slice($allProducts, $offset, $pageItems);

            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, $productsCount, $pageItems, $currentPage);
            $paginator->withPath('shop');

            dd($paginator);

            return view('hinimo/shop', compact('products', 'categories', 'cart', 'cartCount', 'userID', 'productsCount', 'boutiques', 'notAvailables', 'page_title', 'notificationsCount', 'sets', 'paginator', 'activeLink'));
        }
    }

    public function shopViaGender(Request $request, $gender)
    {
        if (Auth::check()) { //check if nay naka login nga user
            $userID = Auth()->user()->id;
            $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
            if($cart != null){
                $cartCount = $cart->items->count();
            }else{
                $cartCount = 0;
            }
            $notifications;
            $notificationsCount;
            $this->getNotifications($notifications, $notificationsCount);

        }else{
            $userID = null;
            $cart = null;
            $cartCount = null;
            $notificationsCount = null;
            $notifications = null;

        }
        $activeLink = "$gender";
        $page_title = "$gender";
        $categories = Category::all();
        $boutiques = Boutique::all();

        $filteredCategories = Category::where('gender', $gender)->get();
        $prods = Product::where('productStatus', 'Available')->get();
        $sets = Set::where('setStatus', 'Available')->get();
        $products = array();

        foreach($filteredCategories as $category){
            foreach($prods as $prod){
                if($prod->getSubCategory->getCategory['id'] == $category['id']){
                    array_push($products, $prod);
                }
            }
            foreach($sets as $set){
                foreach($set->items as $item){
                    if($item->product->getSubCategory->getCategory['id'] == $category['id']){
                        if(!in_array($set, $products)){
                            array_push($products, $set);
                        }
                    }
                }
            }
        }

            //PAGINATION
            $currentPage = $request->page;
            $pageItems = 12;
            if(empty($currentPage)){
                $currentPage = 1;
            }
        // dd($products);

        $productsCount = count($products);

        //PAGINATION
        $currentPage = $request->page;
        $pageItems = 12;
        if(empty($currentPage)){
            $currentPage = 1;
        }

        $offset = ($currentPage * $pageItems) - $pageItems;
        $itemsForCurrentPage = array_slice($products, $offset, $pageItems);

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, $productsCount, $pageItems, $currentPage);
        $paginator->withPath($gender);


        return view('hinimo/shop', compact('products', 'categories', 'cart', 'cartCount', 'userID', 'productsCount', 'boutiques', 'page_title', 'notifications', 'notificationsCount', 'paginator', 'activeLink'));
    }

    public function shopViaCategory(Request $request, $gender, $category)
    {
        if (Auth::check()) { //check if nay naka login nga user
            $userID = Auth()->user()->id;
            $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
            if($cart != null){
                $cartCount = $cart->items->count();
            }else{
                $cartCount = 0;
            }
            $notifications;
            $notificationsCount;
            $this->getNotifications($notifications, $notificationsCount);

        }else{
            $userID = null;
            $cart = null;
            $cartCount = null;
            $notificationsCount = null;
            $notifications = null;

        }
        $activeLink = "$gender";
        $page_title = ucfirst($gender)." - $category";
        $categories = Category::all();
        $boutiques = Boutique::all();

        $filteredCategories = Category::where('gender', $gender)->where('categoryName', $category)->get();
        $prods = Product::where('productStatus', 'Available')->get();
        $sets = Set::where('setStatus', 'Available')->get();
        $products = array();

        // dd($categories);

        foreach($filteredCategories as $category){
            foreach($prods as $prod){
                if($prod->getSubCategory->getCategory['id'] == $category['id']){
                    array_push($products, $prod);
                }
            }
            foreach($sets as $set){
                foreach($set->items as $item){
                    if($item->product->getSubCategory->getCategory['id'] == $category['id']){
                        if(!in_array($set, $products)){
                            array_push($products, $set);
                        }
                    }
                }
            }
        }
        $productsCount = count($products);

        //PAGINATION
        $currentPage = $request->page;
        $pageItems = 12;
        if(empty($currentPage)){
            $currentPage = 1;
        }

        $offset = ($currentPage * $pageItems) - $pageItems;
        $itemsForCurrentPage = array_slice($products, $offset, $pageItems);

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, $productsCount, $pageItems, $currentPage);
        $paginator->withPath($gender);


        return view('hinimo/shop', compact('products', 'categories', 'cart', 'cartCount', 'userID', 'productsCount', 'boutiques', 'page_title', 'notifications', 'notificationsCount', 'paginator', 'activeLink'));
    }

    public function collection_paginate($items, $per_page)
    {
        $page   = Request::get('page', 1);
        $offset = ($page * $per_page) - $per_page;

        return new Illuminate\Pagination\LengthAwarePaginator(
            $items->forPage($page, $per_page)->values(),
            $items->count(),
            $per_page,
            Illuminate\Pagination\Paginator::resolveCurrentPage(),
            ['path' => Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );
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
        $page_title = "Hinimo";
        $userID = Auth()->user()->id;
        $user = User::where('id', $userID)->first();
        if($user['gender'] == "Female"){
            $categories = Category::where('gender', 'Womens')->get();
        }else{
            $categories = Category::where('gender', 'Mens')->get();
        }


        return view('hinimo/getstarted', compact('page_title', 'categories'));
    }

    public function profiling(Request $request)
    {
        $page_title = "profiling";
        $userID = Auth()->user()->id;
        $categories = Category::all();
        $data = json_encode($request->input('subcategory'));

        // dd($data);
        $profilings = Profiling::create([
            'userID' => $userID,
            'data' => $data
        ]);

        return redirect('/user-profiling/done');
    }

    public function profilingDone()
    {
        $boutiques = Boutique::all();

        return view('hinimo/profiling-done', compact('boutiques'));
    }

    public function viewBoutique($boutiqueID)
    {
        // if (Auth::check()) {
        // $userID = Auth()->user()->id;
        // }

        if(Auth()->user()->roles == "customer") {
        $activeLink = "womens";
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

    	return view('hinimo/boutiqueProfile', compact('categories', 'products', 'productsCount', 'cart', 'cartCount', 'userID', 'boutiques', 'boutique', 'notAvailables', 'page_title', 'notifications', 'notificationsCount', 'activeLink'));

        }else if(Auth()->user()->roles == "boutique") {
            return redirect('/dashboard');
        } else if(Auth()->user()->roles == "admin") {
            return redirect('/admin-dashboard');
        } 
    }

    public function productDetails($productID)
    {
        $user = Auth()->user();

        if(!empty($user)){
            $id = Auth()->user()->id;

            $views = View::where('userID', $id)->where('itemID', $productID)->first();
            if(empty($views)){
                $views = View::create([
                    'userID' => $id,
                    'itemID' => $productID,
                    'count' => 1
                ]);
            }else{
                $views->update([
                    'count' => $views['count'] + 1
                ]);
            }
        }

    	$product = Product::where('id', $productID)->first();
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

        $cities = City::all();
        $sp = Sharepercentage::where('id', '1')->first();
        $percentage = $sp['sharePercentage'] / 100;
        // dd(count($product->productFile));
        
        // $totalPrice = $product['rentPrice'] + $product['deliveryFee'];

    	return view('hinimo/single-product-details', compact('product', 'cart', 'cartCount', 'user', 'boutiques', 'page_title', 'notifications', 'notificationsCount', 'cities', 'percentage'));
    }

    public function addtoCart($productID)
    {
        //CREATE ID FOR PRODUCT --------------------------------------------------------
        $cart = Cart::orderBy('created_at', 'DESC')->first();
        if(empty($cart)){
            $cartID = 'CART_001';
        }else{
            $oldID = explode("_", $cart['id']);
            $idInt = (int) $oldID[1];
            $idInt++;
            if($idInt <= 9){
                $cartID = 'CART_00'.$idInt;
            }elseif($idInt <= 99){
                $cartID = 'CART_0'.$idInt;
            }else{
                $cartID = 'CART_'.$idInt;
            }
        }
        // dd($cartID);
        //------------------------------------------------------------------------------

   		$userID = Auth()->user()->id;
        $cart = Cart::where('userID', $userID)->orderBy('created_at', 'DESC')->first();

        if($cart == null){
            $cart = Cart::create([
                'id' => $cartID,
                'userID' => $userID,
                'status' => "Active"
            ]);

        }else{
            if($cart['status'] == "Inactive"){
                $cart = Cart::create([
                    'id' => $cartID,
                    'userID' => $userID,
                    'status' => "Active"
                ]);
            }
        }

        // dd("asjaksakjs");
        // exit();

        Cartitem::create([
            'cartID' => $cart['id'],
            'productID' => $productID
        ]);
    	

    	return redirect('/shop');
    }

    public function addSettoCart($productID, Request $request)
    {
        $userID = Auth()->user()->id;
        $cart = Cart::where('userID', $userID)->orderBy('created_at', 'DESC')->first();

        $sizes = $request->input('sizes');
        $sizesArray = [];

        foreach($sizes as $size){
            $data = explode('-', $size);
            $prodId = $data[0];
            $size = $data[1];

            $sizesArray[$prodId] = $size;
        }

        $sizeJson = json_encode($sizesArray);


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
            'setID' => $productID,
            'sizes' => $sizeJson
        ]);
        

        return response()->json([]);
    }

    public function removeItem($cartID)
    {
        $item = Cartitem::where('id', $cartID)->delete();

        return response()->json(['item' => $item]);
    }

    public function getCart($productID)
    {
    	$product = Product::find($productID);

        print_r($product);
        exit();

    	return response()->json(['product' => $product, 
    		'owner' => $product->owner,
    		'category' => $product->getCategory
    		]);
    }

    public function placeOrder(Request $request)
    {
        $userID = Auth()->user()->id;
        $deliveryAddress = $request->input('deliveryAddress');
        $addressID = $request->input('selectAddress');

        if($deliveryAddress != null && $addressID == "addAddress"){
            $address = Address::create([
                'userID' => $userID, 
                'contactName' => $request->input('fullname'), 
                'phoneNumber' => $request->input('phoneNumber'),
                'completeAddress' => $request->input('deliveryAddress'),
                'lat' => $request->input('lat'), 
                'lng' => $request->input('lng'), 
                'status' => "Not Default"
            ]);
            $addressID = $address['id'];
        }elseif($deliveryAddress != null && $addressID != "addAddress"){

        }

        $boutiqueCount = $request->input('boutiqueCount');
        for ($i=1; $i <= $boutiqueCount; $i++) { 

            //CREATE ID FOR ORDER --------------------------------------------------------
            $order = Order::orderBy('created_at', 'DESC')->first();
            if(empty($order)){
                $orderID = 'ORDER_001';
            }else{
                $oldID = explode("_", $order['id']);
                $idInt = (int) $oldID[1];
                $idInt++;
                if($idInt <= 9){
                    $orderID = 'ORDER_00'.$idInt;
                }elseif($idInt <= 99){
                    $orderID = 'ORDER_0'.$idInt;
                }else{
                    $orderID = 'ORDER_'.$idInt;
                }
            }
            //------------------------------------------------------------------------------

            $orders = $request->input("order$i");
            $order = Order::create([
                'id' => $orderID,
                'userID' => $request->input('userID'),
                'transactionID' => $request->input('cartID'),
                'subtotal' => $orders['subtotal'],
                'deliveryfee' => $orders['deliveryfee'],
                'total' => $orders['total'],
                'boutiqueID' => $orders['boutiqueID'],
                'boutiqueShare' => $orders['boutiqueShare'],
                'adminShare' => $orders['adminShare'],
                'status' => 'Pending',
                'paymentStatus' => 'Not Yet Paid',
                'addressID' => $addressID
            ]);

            $cart = Cart::where('id', $request->input('cartID'))->first();
            $cartitems = Cartitem::where('cartID', $cart['id'])->get();
            $cart = Cart::where('id', $order['transactionID'])->first();
            $cart->update([
                'status' => 'Inactive'
            ]);

            foreach($cart->items as $item){ //update items quantity
                if($item->product != null){
                    $product = Product::where('id', $item->product['id'])->first();
                    $productQuantity = $product['quantity'] - 1;
                    $product->update([
                        'quantity' => $productQuantity
                    ]);

                    if($product['quantity'] == 0){
                        $product->update([
                            'productStatus' => "Not Available"
                        ]);
                    }   
                }else{
                    $set = Set::where('id', $item->set['id'])->first();
                    $setQuantity = $set['quantity'] - 1;

                    foreach($cartitems as $cartitem){
                        $sizes = json_decode($cartitem['sizes'], true);
                    }
                    foreach($set->items as $item){
                        $item->product->rtwDetails;
                        $product = Product::where('id', $item->product['id'])->first();
                        $productID = $product['id'];
                        $rtwDetails = Rtw::where('productID', $product['id'])->first();
                        $rtwDetails->update([
                            $sizes[$productID] => $rtwDetails[$sizes[$productID]] -1
                        ]);
                    }

                    $set->update([
                        'quantity' => $setQuantity
                    ]);

                    if($set['quantity'] == 0){
                        $set->update([
                            'setStatus' => "Not Available"
                        ]);
                    }
                }
            }
            

            $boutique = Boutique::where('id', $orders['boutiqueID'])->first();
            $boutiqueseller = User::find($boutique['userID']);
            $boutiqueseller->notify(new NewOrder($order));
        }

        return redirect('/view-order/'.$order['id']);
    }

    public function checkout()
    {
        $page_title = "Checkout";
        $userID = Auth()->user()->id;
        $user = User::find($userID);
        $boutiques = Boutique::all();
        // $notAvailables = Product::where('productStatus', 'Not Available')->get();
        $addresses = Address::where('userID', $userID)->get();
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        $deliveryfee = Deliveryfee::where('id', '1')->first();
        $baseFee = $deliveryfee['baseFee'];
        $additionalFee = $deliveryfee['additionalFee'];

        $sp = Sharepercentage::where('id', '1')->first();
        $percentage = $sp['sharePercentage'] / 100;
        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);

        // $checker = 

        $prodArrayCount = [];
        $setArrayCount = [];

        foreach($cart->items as $item){
            $productID = null;
            $setID = null;

            if (!empty($item['productID'])) {
                $productID = $item['productID'];

                if (array_key_exists($productID, $prodArrayCount)) {
                    $prodArrayCount[$productID] += 1;
                } else {
                    $prodArrayCount[$productID] = 1;
                }
            }

            if (!empty($item['setID'])) {
                $setID = $item['setID'];

                if (array_key_exists($setID, $setArrayCount)) {
                    $setArrayCount[$setID] += 1;
                } else {
                    $setArrayCount[$setID] = 1;
                }
            }

        }
        // dd($item->product);

        $messages = array();
        foreach ($setArrayCount as $setID => $count) {
            $set = Set::where('id', $setID)->first();
            if($set['quantity'] < $count){
                array_push($messages, 'You have exceeded in selecting the item: '.ucwords($set['setName']).'. Theres only '.$set['quantity'].' piece/s left in store!');
            }
        }

        foreach($prodArrayCount as $productID => $count){
            $product = Product::where('id', $productID)->first();
            if($product['quantity'] < $count){
                array_push($messages, 'You have exceeded in selecting the item '.$product['productName'].'. Theres only '.$product['quantity'].' piece/s left in store!');
            }
        }
        // dd($message);


    	return view('hinimo/checkout', compact('page_title', 'cart', 'cartCount', 'user', 'boutiques', 'notifications', 'notificationsCount', 'percentage', 'addresses', 'messages', 'baseFee', 'additionalFee'));
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
        // $cities = City::where('provCode', '0722')->orderBy('citymunDesc', 'ASC')->get();
        // $barangays = Barangay::all();
        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);
        $cart = Cart::where('userID', $id)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }


        return view('hinimo/useraccount', compact('categories', 'products', 'cart', 'cartCount', 'user', 'addresses', 'boutiques', 'page_title', 'notifications', 'notificationsCount'));
    }

    public function getBrgy($citymunCode)
    {
        $brgys = Barangay::where('citymunCode', $citymunCode)->orderBy('brgyDesc', 'ASC')->get();

        return response()->json(['brgys' => $brgys]);
    }

    public function addAddress(Request $request)
    {
        $id = Auth()->user()->id;

        $addresses = Address::where('userID', $id)->get();

        if(count($addresses) > 0) {
            $address = Address::create([
                'userID' => $id, 
                'contactName' => $request->input('contactName'), 
                'phoneNumber' => $request->input('phoneNumber'),
                'completeAddress' => $request->input('completeAddress'),
                'lat' => $request->input('lat'), 
                'lng' => $request->input('lng'), 
                'status' => "Not Default"
            ]);

        }else{
            $address = Address::create([
                'userID' => $id, 
                'contactName' => $request->input('contactName'), 
                'phoneNumber' => $request->input('phoneNumber'),
                'completeAddress' => $request->input('completeAddress'),
                'lat' => $request->input('lat'), 
                'lng' => $request->input('lng'), 
                'status' => "Default"
            ]);
        }

        

        return redirect('/user-account');
    }

    public function setAsDefault($addressID)
    {
        $userID = Auth()->user()->id;

        $addresses = Address::where('userID', $userID)->where('status', "Default")->update([
            'status' => "Not Default"
        ]);

        $address = Address::where('id', $addressID)->update([
            'status' => "Default"
        ]);

        return redirect('/user-account#addresses');
    }

    public function deleteAddress($addressID)
    {
        $userID = Auth()->user()->id;

        $address = Address::where('id', $addressID)->delete();

        return redirect('user-account');
    }

    public function editAddress($addressID)
    {
        $userID = Auth()->user()->id;

        $address = Address::where('id', $addressID)->update([
            'contactName' => $request->input('contactName'),
            'phoneNumber' => $request->input('phoneNumber'),
            'completeAddress' => $request->input('completeAddress'),
            'lat' => $request->input('lat'), 
            'lng' => $request->input('lng'),  
        ]);

        return redirect('user-account');
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

    public function submitRequestToRent($productID)
    {
        $user = Auth()->user();
        $userID = Auth()->user()->id;
        $product = Product::where('id', $productID)->first();
        $addresses = Address::where('userID', $user['id'])->get();
        $boutiques = Boutique::all();
        $page_title = "Request to Rent";
        $addresses = Address::where('userID', $userID)->get();
        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);
        $cart = Cart::where('userID', $user['id'])->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        $cities = City::all();
        $sp = Sharepercentage::where('id', '1')->first();
        $percentage = $sp['sharePercentage'] / 100;



        $daysBefore = 2;    //time allowance
        $daysAfter = 2;     //time allowance
        $datesArray = array();      //para makuha ang mga dates nga dili pwede ang item
        $rentSchedules = Rent::where('productID', $productID)->get();


        foreach($rentSchedules as $rentSchedule){
            array_push($datesArray, $rentSchedule['dateToUse']);    //get dates of use of items

            $dateNew = $rentSchedule['dateToUse'];
            for ($i=0; $i < $daysBefore; $i++) { 
                $addDaysBefore = date('Y-m-d', strtotime($dateNew.'- 1 days'));
                $dateNew = $addDaysBefore;
                array_push($datesArray, $addDaysBefore);
            }

            $dateNew = $rentSchedule['dateToUse'];
            for ($i=0; $i < $daysBefore; $i++) { 
                $addDaysBefore = date('Y-m-d', strtotime($dateNew.'+ 1 days'));
                $dateNew = $addDaysBefore;
                array_push($datesArray, $addDaysBefore);
            }
        }

        // dd($product->getSubCategory->getCategory);
        
        // $totalPrice = $product['rentPrice'] + $product['deliveryFee'];

        return view('hinimo/requestToRent', compact('product', 'cart', 'cartCount', 'user', 'addresses', 'boutiques', 'page_title', 'notifications', 'notificationsCount', 'cities', 'percentage', 'addresses', 'datesArray'));
    }

    // public function getRentDates($productID)
    // {

    //     return response()->json(['datesArray' => $datesArray]);

    // }

    public function requestToRent(Request $request)
    {
        $id = Auth()->user()->id;
        $user = User::find($id);

        $measurement = $request->input('measurement');
        $mName = json_encode($measurement);

        $dateuse = date('Y-m-d',strtotime($request->input('dateToUse')));
        $toadd = $request->input('limitOfDays');
        $dateToBeReturned = date('Y-m-d', strtotime($dateuse.'+'.$toadd.' days'));

        $deliveryAddress = $request->input('deliveryAddress');
        $addressID = $request->input('selectAddress');

        if($deliveryAddress != null && $addressID == "addAddress"){
            $address = Address::create([
                'userID' => $id, 
                'contactName' => $request->input('billingName'), 
                'phoneNumber' => $request->input('phoneNumber'),
                'completeAddress' => $request->input('deliveryAddress'),
                'lat' => $request->input('lat'), 
                'lng' => $request->input('lng'), 
                'status' => "Not Default"
            ]);
            $addressID = $address['id'];
        }elseif($deliveryAddress != null && $addressID != "addAddress"){
            //leave empty lang para mo exit na sa condition
        }

        //CREATE ID FOR RENT --------------------------------------------------------
        $rent = Rent::orderBy('created_at', 'DESC')->first();
        if(empty($rent)){
            $rentID = 'RENT_001';
        }else{
            $oldID = explode("_", $rent['id']);
            $idInt = (int) $oldID[1];
            $idInt++;
            if($idInt <= 9){
                $rentID = 'RENT_00'.$idInt;
            }elseif($idInt <= 99){
                $rentID = 'RENT_0'.$idInt;
            }else{
                $rentID = 'RENT_'.$idInt;
            }
        }
        // dd($rentID);
        //------------------------------------------------------------------------------

        $rent = Rent::create([
            'id' => $rentID,
            'boutiqueID' => $request->input('boutiqueID'),
            'customerID' => $id, 
            'status' => "Pending", 
            'itemID' => $request->input('productID'), 
            'dateToUse' => $dateuse, 
            'dateToBeReturned' => $dateToBeReturned, 
            'notes' => $request->input('additionalNotes'),
            'addressID' => $addressID
        ]);

        $measurement = Measurement::create([
            'userID' => $id,
            'type' => 'rent',
            'typeID' => $rent['id'],
            'data' => $mName
        ]);

        //CREATE ID FOR ORDER --------------------------------------------------------
        $order = Order::orderBy('created_at', 'DESC')->first();
        if(empty($order)){
            $orderID = 'ORDER_001';
        }else{
            $oldID = explode("_", $order['id']);
            $idInt = (int) $oldID[1];
            $idInt++;
            if($idInt <= 9){
                $orderID = 'ORDER_00'.$idInt;
            }elseif($idInt <= 99){
                $orderID = 'ORDER_0'.$idInt;
            }else{
                $orderID = 'ORDER_'.$idInt;
            }
        }
        //------------------------------------------------------------------------------
        $order = Order::create([
            'id' => $orderID,
            'userID' => $id,
            'rentID' => $rent['id'],
            'boutiqueID' => $request->input('boutiqueID'),
            'subtotal' => $request->input('subtotal'),
            'deliveryfee' => $request->input('deliveryfee'),
            'total' => $request->input('total'),
            'deliveryAddress' => $addressID,
            'status' => "Pending",
            'paymentStatus' => "Not Yet Paid",
            'billingName' => $request->input('billingName'), 
            'phoneNumber' => $addressID,
            'boutiqueShare' => $request->input('boutiqueShare'),
            'adminShare' => $request->input('adminShare'),
            'addressID' => $addressID
        ]);

        $rent->update([
            // 'orderID' => $order['id'],
            'measurementID' => $measurement['id']
        ]);

        // Product::where('id', $rent['productID'])->update([
        //     'productStatus' => "Not Available"
        // ]);

        $boutique = Boutique::where('id', $rent['boutiqueID'])->first();
        $boutiqueseller = User::find($boutique['userID']);
        
        $boutiqueseller->notify(new RentRequest($rent));

        return redirect('/view-rent/'.$rent['id']);
    }

    public function receiveRent($rentID)
    {
        $rent = Rent::where('id', $rentID)->first();
        $rent->update([
            'status' => "On Rent"
        ]);
        $order = Order::where('rentID', $rentID)->update([
            'status' => "On Rent"
        ]);

        return redirect('/view-rent/'.$rent['id']);
    }

    public function showBiddings()
    {
        if(Auth()->user()->roles == "customer") {
        if (Auth::check()) {
        $userID = Auth()->user()->id;
        }

        $page_title = 'Biddings';
        $categories = Category::all();
        $boutiques = Boutique::all();
        $biddings = Bidding::where('status', 'Open')->get();
        $biddingsCount = $biddings->count();
        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        // $time = date();
        // dd(date("Y-m-d"));

        // foreach($biddings as $bidding){
        // $bids = array();
        // foreach($bidding->bids as $bid){
        //     array_push($bids, $bid['bidAmount']);
        // }
        // dd(min($bids));
            // dd($bidding->bids);
        // }


        return view('hinimo/biddings', compact('page_title', 'products', 'categories', 'cart', 'cartCount', 'userID', 'boutiques', 'biddings', 'biddingsCount', 'notificationsCount', 'notifications'));
        
        }else if(Auth()->user()->roles == "boutique") {
            return redirect('/dashboard');
        } else if(Auth()->user()->roles == "admin") {
            return redirect('/admin-dashboard');
        }
    }

    public function showStartNewBidding()
    {
        $page_title = "Start a New Bidding";
        $userID = Auth()->user()->id;
        $categories = Category::all();
        $boutiques = Boutique::all();
        // $tags = Tag::all();
        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        return view('hinimo/bidding-newBidding', compact('page_title', 'categories', 'cart', 'cartCount', 'userID', 'boutiques' , 'notifications', 'notificationsCount'));
    }

    public function savebidding(Request $request)
    {
        $userID = Auth()->user()->id;

        // $measurement = $request->input('measurement');
        // $mName = json_encode($measurement);
        $deadlineOfProduct = date('Y-m-d',strtotime($request->input('deadlineOfProduct')));
        $time = time();
        // dd(date("Y-m-d",$time));
        // dd($time);
        $wearers = null;

        //changes nga wa pajuy sure kay wa nahuman jud------------------------------------------------------------------------
        if($request->input('nameOfWearers') != null){
            $wearersArray = array();

            $nameOfWearers = $request->input('nameOfWearers');
            $pcsOfWearers = $request->input('pcsOfWearers');
     
            $counter = 0;
            foreach($nameOfWearers as $nameOfWearer){
                $wearersArray[$nameOfWearer] = $pcsOfWearers[$counter];

                $counter++;
            }

            $wearers = json_encode($wearersArray);

        }
        //---------------------------------------------------------------------------------
            // dd($wearers);

        //CREATE ID FOR ORDER --------------------------------------------------------
        $bidding = Bidding::orderBy('created_at', 'DESC')->first();
        if(empty($bidding)){
            $biddingID = 'BIDD_001';
        }else{
            $oldID = explode("_", $bidding['id']);
            $idInt = (int) $oldID[1];
            $idInt++;
            if($idInt <= 9){
                $biddingID = 'BIDD_00'.$idInt;
            }elseif($idInt <= 99){
                $biddingID = 'BIDD_0'.$idInt;
            }else{
                $biddingID = 'BIDD_'.$idInt;
            }
        }
        //------------------------------------------------------------------------------

        $bidding = Bidding::create([
            'id' => $biddingID,
            'userID' => $userID,
            'quotationPrice' => $request->input('quotationPrice'), 
            'endDate' => $request->input('endDate'), 
            'deadlineOfProduct' => $deadlineOfProduct,
            'quantity' => $request->input('quantity'),
            'numOfPerson' => $request->input('numOfPerson'),
            'nameOfWearers' => $wearers,
            'fabChoice' => $request->input('fabChoice'), 
            'notes' => $request->input('notes'), 
            'status' => "Open"
        ]);

        // $measurement = Measurement::create([
        //     'userID' => $userID,
        //     'type' => 'bidding',
        //     'typeID' => $bidding['id'],
        //     'data' => $mName
        // ]);

        // $bidding->update([
        //     'measurementID' => $measurement['id']
        // ]);

        //CREATE ID FOR GALLERY --------------------------------------------------------
        $glry = Gallery::orderBy('created_at', 'DESC')->first();
        if(empty($glry)){
            $galleryID = 'GLRY_001';
        }else{
            $oldID = explode("_", $glry['id']);
            $idInt = (int) $oldID[1];
            $idInt++;
            if($idInt <= 9){
                $galleryID = 'GLRY_00'.$idInt;
            }elseif($idInt <= 99){
                $galleryID = 'GLRY_0'.$idInt;
            }else{
                $galleryID = 'GLRY_'.$idInt;
            }
        }
        //------------------------------------------------------------------------------

        $gallery = Gallery::create([
            'id' => $galleryID,
            'userID' => $userID
        ]);


        $upload = $request->file('file');
        if($request->hasFile('file')) {
        // foreach($uploads as $upload){
            $files = new File();
            $destinationPath = public_path('uploads');
            $name = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7).$upload->getClientOriginalName();
            $filename = $destinationPath.'\\'. $name;
            $upload->move($destinationPath, $filename);

            $files->userID = $userID;
            $files->typeID = $bidding['id'];
            $files->filepath = "/".$name;
            $files->save();
            // $filename = "/".$name;


            $files = new File();

            $files->userID = $userID;
            $files->typeID = $gallery['id'];
            $files->filepath = "/".$name;
            $files->save();
        // }
      }

        $boutiques = Boutique::all();
        foreach($boutiques as $boutique)
        {
            $boutiqueseller = User::where('id', $boutique['userID'])->first();
            $boutiqueseller->notify(new NewBidding($bidding));
        }

        return redirect('/biddings');
    }

    public function viewBidding($biddingID)
    {
        if (Auth::check()) {
        $userID = Auth()->user()->id;
        $user = User::find($userID);
        $page_title = 'Biddings';
        $boutiques = Boutique::all();
        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }
        $bidding = Bidding::where('id', $biddingID)->first();
        $bids = Bid::where('biddingID', $bidding['id'])->get();
        $bidsCount = $bids->count();

        return view('hinimo/bidding-details', compact('user', 'userID', 'page_title', 'cart', 'cartCount', 'boutiques', 'bidding', 'bids', 'notificationsCount', 'notifications', 'bidsCount'));
        }
    }

    // public function viewBidder($biddingID)
    // {
    //     $page_title = "Notifications";
    //     $userID = Auth()->user()->id;
    //     $boutiques = Boutique::all();
    //     $user = User::find($userID);
    //     $notifications = $user->notifications;
    //     $notificationsCount = $user->unreadNotifications->count();
    //     $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
    //     if($cart != null){
    //         $cartCount = $cart->items->count();
    //     }else{
    //         $cartCount = 0;
    //     }
    //     $bidding = Bidding::where('id', $biddingID)->first();
    //     $bids = Bid::where('biddingID', $bidding['id'])->get();

    //     return view('hinimo/viewBidder', compact('page_title', 'userID', 'boutiques', 'notifications', 'notificationsCount', 'cart', 'cartCount', 'bidding', 'bids'));
    // }

    public function myBiddings()
    {
        $page_title = "My Biddings";
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

        $biddings = Bidding::where('userID', $userID)->get();
        $biddingsCount = $biddings->count();

        return view('hinimo/myBiddings', compact('page_title', 'userID', 'boutiques', 'notifications', 'notificationsCount', 'cart', 'cartCount', 'biddings', 'biddingsCount'));
    }

    public function reviewBidding($bidID)
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

        $bid = Bid::where('id', $bidID)->first();

        return view('hinimo/reviewBidding', compact('page_title', 'userID', 'user', 'boutiques', 'notifications', 'notificationsCount', 'cart', 'cartCount', 'bid'));
    }

    // public function acceptBid($bidID)
    // {
    //     $bid = Bid::where('id', $bidID)->first();
    //     $bidding= Bidding::where('id', $bid['biddingID'])->first();
        
    //     $bidding->update([
    //         'bidID' => $bid['id'],
    //         'status' => "Closed"
    //     ]);

    //     return redirect('view-bidding/'.$bidding['id']);
    // }

    public function inputAddressforBiding($bidID)
    {
        $page_title = "Submit Address";
        $userID = Auth()->user()->id;
        $user = User::find($userID);
        $boutiques = Boutique::all();
        $addresses = Address::where('userID', $userID)->get();
        $notifications = $user->notifications;
        $notificationsCount = $user->unreadNotifications->count();
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        $deliveryfee = Deliveryfee::where('id', '1')->first();
        $baseFee = $deliveryfee['baseFee'];
        $additionalFee = $deliveryfee['additionalFee'];

        $bid = Bid::where('id', $bidID)->first();
        $mto = null;
        $sp = Sharepercentage::where('id', '1')->first();
        $percentage = $sp['sharePercentage'] / 100;

        return view('hinimo/inputAddress', compact('page_title', 'userID', 'user', 'boutiques', 'notifications', 'notificationsCount', 'cart', 'cartCount', 'bid', 'mto', 'percentage', 'addresses', 'baseFee', 'additionalFee'));
    }

    public function makeOrderforBidding(Request $request)
    {
        $userID = Auth()->user()->id;
        $bid = Bid::where('id', $request->input('bidID'))->first();
        $bidding = Bidding::where('id', $bid->bidding['id'])->first();
        $deliveryAddress = $request->input('deliveryAddress');
        $addressID = $request->input('selectAddress');
            // dd($addressID);

        if($deliveryAddress != null && $addressID == "addAddress"){
            $address = Address::create([
                'userID' => $userID, 
                'contactName' => $request->input('billingName'), 
                'phoneNumber' => $request->input('phoneNumber'),
                'completeAddress' => $request->input('deliveryAddress'),
                'lat' => $request->input('lat'), 
                'lng' => $request->input('lng'), 
                'status' => "Not Default"
            ]);
            $addressID = $address['id'];
            // dd($deliveryAddress);
        }elseif($deliveryAddress != null && $addressID != "addAddress"){
            //leave empty lang para mo exit na sa condition
        }

        // dd($bidding);
        $bidding->update([
            'bidID' => $request->input('bidID'),
            'status' => "Closed"
        ]);

        //CREATE ID FOR ORDER --------------------------------------------------------
        $order = Order::orderBy('created_at', 'DESC')->first();
        if(empty($order)){
            $orderID = 'ORDER_001';
        }else{
            $oldID = explode("_", $order['id']);
            $idInt = (int) $oldID[1];
            $idInt++;
            if($idInt <= 9){
                $orderID = 'ORDER_00'.$idInt;
            }elseif($idInt <= 99){
                $orderID = 'ORDER_0'.$idInt;
            }else{
                $orderID = 'ORDER_'.$idInt;
            }
        }
        //------------------------------------------------------------------------------

        $order = Order::create([
            'id', $orderID,
            'userID' => $userID,
            'biddingID' => $bidding['id'],
            'boutiqueID' => $bid->owner['id'],
            'subtotal' => $request->input('subtotal'),
            'deliveryfee' => $request->input('deliveryfee'),
            'total' => $request->input('total'),
            'deliveryAddress' => $addressID,
            'status' => "Pending",
            'paymentStatus' => "Not Yet Paid",
            'billingName' => $request->input('billingName'),
            'phoneNumber' => $addressID,
            'boutiqueShare' => $request->input('boutiqueShare'),
            'adminShare' => $request->input('adminShare'),
            'addressID' => $addressID
        ]);

        $bidding->update([
            'orderID' => $order['id']
        ]);
        // dd($bidding->bid['id']);

        $boutique = Boutique::where('id', $bid->owner['id'])->first();
        $boutiqueseller = User::find($boutique['userID']);
        $boutiqueseller->notify(new CustomerAcceptsBid($bidding));

        $bids = Bid::where('biddingID', $bidding['id'])->get();
        foreach($bids as $deniedBid){
            if($deniedBid['id'] != $bid['id']){
                $deniedBoutique = Boutique::where('id', $deniedBid['boutiqueID'])->first();
                $deniedBoutiqueSeller = User::where('id', $deniedBoutique['userID'])->first();
                $deniedBoutiqueSeller->notify(new CustomerDoesntAcceptOffer($deniedBid));
            }
        }

        return redirect('/view-bidding-order/'.$bidding['id']);
    }

    public function submitMeasurementforBidding(Request $request)
    {
        $userID = Auth()->user()->id;
        $biddingID = $request->input('biddingID');
        $persons = $request->input('person');
        $mrequests = Measurementrequest::where('type', 'bidding')->where('typeID', $biddingID)->get();
        $data = array();
        $counter = 1;

        foreach($persons as $person){
            $measurementArray = array();
            array_push($measurementArray, $person);

            foreach($mrequests as $mrequest){
                $cmArray = array();
                $categoryName = $mrequest->category['categoryName'];
                $measurements = $request->input("$counter");

                // array_push($cmArray, $categoryName);
                array_push($cmArray, $measurements);
                // DD($measurements);
            }

            // $personJson = json_encode($measurementArray); wa ni gamit hahah
            array_push($measurementArray, $cmArray);
            array_push($data, $measurementArray);
            $counter++;
        }
            // dd($data);

        $dataJson = json_encode($data);

        $measurement = Measurement::create([
            'userID' => $userID,
            'type' => 'bidding',
            'typeID' => $biddingID,
            'data' => $dataJson
        ]);

        Bidding::where('id', $biddingID)->update([
            'measurementID' => $measurement['id']
        ]);
        
        return redirect('view-bidding-order/'.$biddingID);
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

                }elseif($notification->type == 'App\Notifications\BoutiqueDeclinesMto'){
                    $notification->markAsRead();

                    return redirect('/view-mto/'.$notification->data['mtoID'].'#mto-details');

                }elseif($notification->type == 'App\Notifications\NotifyForAlterations'){
                    $notification->markAsRead();

                    $order = Order::where('id', $notification->data['orderID'])->first();

                    if($order['mtoID'] != null){
                        return redirect('/view-mto/'.$order->mto['id']);

                    }elseif($order['cartID'] != null){
                        return redirect('/view-order/'.$order['id']);

                    }elseif($order['rentID'] != null){
                        return redirect('/view-rent/'.$order->rent['rentID']);

                    }elseif($order['biddingID'] != null){
                        return redirect('/view-bidding-order/'.$order->bidding['id']);
                    }

                }elseif($notification->type == 'App\Notifications\NewBid'){
                    $notification->markAsRead();

                    return redirect('/view-bidding/'.$notification->data['biddingID'].'#bidders');

                }elseif($notification->type == 'App\Notifications\NotifyForPickup'){
                    $notification->markAsRead();

                    $order = Order::where('id', $notification->data['orderID'])->first();

                    if($order['mtoID'] != null){
                        return redirect('/view-mto/'.$order->mto['id']);

                    }elseif($order['cartID'] != null){
                        return redirect('/view-order/'.$order['id']);

                    }elseif($order['rentID'] != null){
                        return redirect('/view-rent/'.$order->rent['rentID']);

                    }elseif($order['biddingID'] != null){
                        return redirect('/view-bidding-order/'.$order->bidding['id']);
                    }

                }elseif($notification->type == 'App\Notifications\MeasurementRequests'){
                    $notification->markAsRead();

                    if($notification->data['transactionType'] == "bidding"){
                        return redirect('/view-bidding-order/'.$notification->data['transactionID'].'#measurements');

                    }elseif($notification->data['transactionType'] == "mto"){
                        return redirect('/view-mto/'.$notification->data['transactionID'].'#measurements');

                    }

                }elseif($notification->type == 'App\Notifications\NotifyCustomerOfChat'){
                    $notification->markAsRead();

                    $chat = Chat::where('id', $notification->data['chatID'])->first();
                    $order = Order::where('id', $chat['orderID'])->first();

                    if($order['mtoID'] != null){
                        return redirect('/view-mto/'.$order->mto['id'].'#chat');

                    }elseif($order['cartID'] != null){
                        return redirect('/view-order/'.$order['id'].'#chat');

                    }elseif($order['rentID'] != null){
                        return redirect('/view-rent/'.$order->rent['rentID'].'#chat');

                    }elseif($order['biddingID'] != null){
                        return redirect('/view-bidding-order/'.$order->bidding['id'].'#chat');
                    }

                }elseif($notification->type == 'App\Notifications\AskCustomerForPayPalEmail'){
                    $notification->markAsRead();

                    $refund = Refund::where('id', $notification->data['refundID'])->first();
                    $order = Order::where('id', $refund['orderID'])->first();

                    // echo "<script>$('#submitPayPalEmailModal').modal('show')</script>";
                    if($order['mtoID'] != null){
                        return redirect('/view-mto/'.$order->mto['id']);

                    }elseif($order['cartID'] != null){
                        return redirect('/view-order/'.$order['id']);

                    }elseif($order['rentID'] != null){
                        return redirect('/view-rent/'.$order->rent['rentID']);

                    }elseif($order['biddingID'] != null){
                        return redirect('/view-bidding-order/'.$order->bidding['id']);
                    }
                    
                }elseif($notification->type == 'App\Notifications\RefundSuccessful'){
                    $notification->markAsRead();

                    $refund = Refund::where('id', $notification->data['refundID'])->first();
                    $order = Order::where('id', $refund['orderID'])->first();

                    // echo "<script>$('#submitPayPalEmailModal').modal('show')</script>";
                    if($order['mtoID'] != null){
                        return redirect('/view-mto/'.$order->mto['id']);

                    }elseif($order['cartID'] != null){
                        return redirect('/view-order/'.$order['id']);

                    }elseif($order['rentID'] != null){
                        return redirect('/view-rent/'.$order->rent['rentID']);

                    }elseif($order['biddingID'] != null){
                        return redirect('/view-bidding-order/'.$order->bidding['id']);
                    }
                    
                }

            }
        }
    }

    public function getCategory($genderCategory)
    {
        $categories = Category::where('gender', $genderCategory)->with('categoryTag')->get();

        return response()->json(['categories' => $categories]);
    }

    public function madeToOrder($boutiqueID)
    {
        $boutique = Boutique::where('id', $boutiqueID)->first();
        $page_title = "Made-to-order";
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

    // public function getFabricColor($boutiqueID, $type)
    // {
    //     $colors = Fabric::where('name', $type)->where('boutiqueID', $boutiqueID)->get();

    //     return response()->json(['colors' => $colors]);
    // }

    public function saveMadeToOrder(Request $request)
    {
        $deadlineOfProduct = date('Y-m-d',strtotime($request->input('deadlineOfProduct')));
        $userID = Auth()->user()->id;
        $boutiqueID = $request->input('boutiqueID');
        $wearers = null;

        //changes nga wa pajuy sure kay wa nahuman jud------------------------------------------------------------------------
        if($request->input('nameOfWearers') != null){
            $wearersArray = array();

            $nameOfWearers = $request->input('nameOfWearers');
            $pcsOfWearers = $request->input('pcsOfWearers');
     
            $counter = 0;
            foreach($nameOfWearers as $nameOfWearer){
                $wearersArray[$nameOfWearer] = $pcsOfWearers[$counter];

                $counter++;
            }

            $wearers = json_encode($wearersArray);

        }
        //---------------------------------------------------------------------------------
            // dd($wearers);


        //CREATE ID FOR MTO --------------------------------------------------------
        $mto = Mto::orderBy('created_at', 'DESC')->first();
        if(empty($mto)){
            $mtoID = 'MTO_001';
        }else{
            $oldID = explode("_", $mto['id']);
            $idInt = (int) $oldID[1];
            $idInt++;
            if($idInt <= 9){
                $mtoID = 'MTO_00'.$idInt;
            }elseif($idInt <= 99){
                $mtoID = 'MTO_0'.$idInt;
            }else{
                $mtoID = 'MTO_'.$idInt;
            }
        }
        // dd($mtoID);
        //------------------------------------------------------------------------------

        $mto = Mto::create([
            'id' => $mtoID,
            'userID' => $userID,
            'boutiqueID' => $boutiqueID,
            'deadlineOfProduct' => $deadlineOfProduct,
            'notes' => $request->input('notes'),
            'quantity' => $request->input('quantity'),
            'numOfPerson' => $request->input('numOfPerson'),
            'nameOfWearers' => $wearers,
            'fabChoice' => $request->input('fabChoice'),
            'orderID' => $request->input('orderID'),
            'status' => "Active"
            ]);

        //CREATE ID FOR GALLERY --------------------------------------------------------
        $glry = Gallery::orderBy('created_at', 'DESC')->first();
        if(empty($glry)){
            $galleryID = 'GLRY_001';
        }else{
            $oldID = explode("_", $glry['id']);
            $idInt = (int) $oldID[1];
            $idInt++;
            if($idInt <= 9){
                $galleryID = 'GLRY_00'.$idInt;
            }elseif($idInt <= 99){
                $galleryID = 'GLRY_0'.$idInt;
            }else{
                $galleryID = 'GLRY_'.$idInt;
            }
        }
        //------------------------------------------------------------------------------
        $gallery = Gallery::create([
            'id' => $galleryID,
            'userID' => $userID
        ]);

        $upload = $request->file('file');
        if($request->hasFile('file')) {
            $files = new File();
            $destinationPath = public_path('uploads');
            $name = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7).$upload->getClientOriginalName();
            $filename = $destinationPath.'\\'. $name;
            $upload->move($destinationPath, $filename);

            $files->userID = $userID;
            $files->typeID = $mto['id'];
            // $files->galleryID = $gallery['id'];
            $files->filepath = "/".$name;
            $files->save();

            //for gallery
            $files = new File();

            $files->userID = $userID;
            $files->typeID = $gallery['id'];
            $files->filepath = "/".$name;
            $files->save();
        }

        $boutique = Boutique::where('id', $boutiqueID)->first();
        $boutiqueseller = User::find($boutique['userID']);
        $boutiqueseller->notify(new NewMTO($mto));

      return redirect('view-mto/'.$mto['id']);
    }

    public function submitMeasurementforMto(Request $request)
    {
        $userID = Auth()->user()->id;
        $mtoID = $request->input('mtoID');
        $persons = $request->input('person');
        $mrequests = Measurementrequest::where('type', 'mto')->where('typeID', $mtoID)->get();
        $data = array();
        $counter = 1;

        foreach($persons as $person){
            $measurementArray = array();
            array_push($measurementArray, $person);

            foreach($mrequests as $mrequest){
                $cmArray = array();
                $categoryName = $mrequest->category['categoryName'];
                $measurements = $request->input("$counter");

                // array_push($cmArray, $categoryName);
                array_push($cmArray, $measurements);
                // dd($cmArray);
            }

            // $personJson = json_encode($measurementArray); wa ni gamit hahah
            array_push($measurementArray, $cmArray);
            array_push($data, $measurementArray);
            $counter++;
        }
            // dd($data);

        $dataJson = json_encode($data);

        $measurement = Measurement::create([
            'userID' => $userID,
            'type' => 'mto',
            'typeID' => $mtoID,
            'data' => $dataJson
        ]);

        Mto::where('id', $mtoID)->update([
            'measurementID' => $measurement['id']
        ]);
        
        return redirect('view-mto/'.$mtoID);
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
        $mtos = Mto::where('userID', $userID)->where('orderID', null)->where('status', 'Active')->get();
        // $biddings = Bidding::where('userID', $userID)->where('orderID', '!=', null)->get();
        // $declinedMtos = Mto::where('status', '!=', 'Cancelled')->get();
        // dd($orders[0]['cartID']);

        $transactions = array();
        array_push($transactions, $orders);
        array_push($transactions, $rents);
        array_push($transactions, $mtos);
        // dd($transactions);

        // $productsArray = $products->toArray();
        // array_multisort(array_column($transactions, "created_at"), SORT_DESC, $transactions);

        return view('hinimo/transactions', compact('cart', 'cartCount', 'boutiques', 'page_title', 'notifications', 'notificationsCount', 'mtos', 'orders', 'rents'));
    }

    public function viewBiddingOrder($biddingID)
    {
        $page_title = "Bidding Details";
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
        $bidding = Bidding::find($biddingID);
        $mrequests = Measurementrequest::where('type', 'bidding')->where('typeID', $biddingID)->get();
        $payments = Payment::where('orderID', $bidding->order['id'])->get();
        $chats = Chat::where('orderID', $bidding->order['id'])->get();
        
        $wearersCounter = 0;
        if($bidding['numOfPerson'] != "equals"){
            $nameOfWearers = json_decode($bidding['nameOfWearers']); 
            foreach($nameOfWearers as $nameOfWearer){ 
                $wearersCounter++;
            }
        }else{
            $nameOfWearer = $bidding['quantity'];
        }
        // dd($wearersCounter);

        return view('hinimo/viewBidding', compact('page_title', 'userID', 'user', 'boutiques', 'notifications', 'notificationsCount', 'cart', 'cartCount', 'bidding', 'mrequests', 'payments', 'chats', 'nameOfWearer', 'wearersCounter'));
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
        $payments = Payment::where('orderID', $order['id'])->get();
        $chats = Chat::where('orderID', $order['id'])->get();
        // $boutiqueseller = User::where('id', $order->boutique->owner['id'])->first();
        // dd($boutiqueseller);

        return view('hinimo/viewOrder', compact('cart', 'cartCount', 'boutiques', 'page_title', 'mtos', 'orders', 'rents', 'notifications', 'notificationsCount', 'order', 'payments', 'chats', 'userID'));
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
        $payments = Payment::where('orderID', $rent->order['id'])->get();
        $chats = Chat::where('orderID', $rent->order['id'])->get();

        // $measurements = json_decode($rent->measurement->data);
        // dd($chats);

        return view('hinimo/viewRent', compact('cart', 'cartCount', 'boutiques', 'page_title', 'mtos', 'orders', 'rents', 'notifications', 'notificationsCount', 'rent', 'payments', 'chats'));
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
        // $measurement = json_decode($mto->measurement->data);
        $fabrics = Fabric::where('boutiqueID', $mto->boutique['id'])->get();
        $sp = Sharepercentage::where('id', '1')->first();
        $percentage = $sp['sharePercentage'] / 100;
        $mrequests = Measurementrequest::where('type', 'mto')->where('typeID', $mtoID)->get();
        $payments = Payment::where('orderID', $mto->order['id'])->get();

        if($mto->order['id'] == null){
            $chats = [];
        }else{
            $chats = Chat::where('orderID', $mto->order['id'])->get();
            // dd($mto->order['id']);
        }

        if($mto['numOfPerson'] != "equals"){
            $nameOfWearers = json_decode($mto['nameOfWearers']); 
            foreach($nameOfWearers as $nameOfWearer){ }
        }else{
            $nameOfWearer = $mto['quantity'];
        }


        return view('hinimo/viewMto', compact('userID', 'cart', 'cartCount', 'boutiques', 'page_title', 'mtos', 'orders', 'rents', 'notifications', 'notificationsCount', 'mto', 'fabrics', 'percentage', 'mrequests', 'payments', 'nameOfWearer', 'chats'));
    }

    public function inputAddress($mtoID, $type)
    {
        $page_title = "Submit Address";
        $userID = Auth()->user()->id;
        $user = User::find($userID);
        $boutiques = Boutique::all();
        $addresses = Address::where('userID', $userID)->get();
        $notifications = $user->notifications;
        $notificationsCount = $user->unreadNotifications->count();
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        $mto = Mto::find($mtoID);  

        // if($type == "acceptFabricPrice"){
        //     $mtoPrice = $mto['price'];
        // }elseif($type == "acceptSuggestedFabricPrice"){ //suggestFabric
        //     $mtoPrice = $fabricSuggestion->price;
        // }
        $mtoPrice = $mto['price'];

        $deliveryfee = Deliveryfee::where('id', '1')->first();
        $baseFee = $deliveryfee['baseFee'];
        $additionalFee = $deliveryfee['additionalFee'];

        $sp = Sharepercentage::where('id', '1')->first();
        $percentage = $sp['sharePercentage'] / 100;
        
        return view('hinimo/inputAddress', compact('user', 'cart', 'cartCount', 'boutiques', 'page_title', 'mtos', 'orders', 'rents', 'notifications', 'notificationsCount', 'mto', 'mtoPrice', 'percentage', 'addresses', 'baseFee', 'additionalFee'));

    }

    public function makeOrderforMTO(Request $request)
    {
        $userID = Auth()->user()->id;
        $mtoID = $request->input('mtoID');
        $mto = Mto::find($mtoID);
        $deliveryAddress = $request->input('deliveryAddress');
        $addressID = $request->input('selectAddress');

        if($deliveryAddress != null && $addressID == "addAddress"){
            $address = Address::create([
                'userID' => $userID, 
                'contactName' => $request->input('billingName'), 
                'phoneNumber' => $request->input('phoneNumber'),
                'completeAddress' => $request->input('deliveryAddress'),
                'lat' => $request->input('lat'), 
                'lng' => $request->input('lng'), 
                'status' => "Not Default"
            ]);
            $addressID = $address['id'];
        }elseif($deliveryAddress != null && $addressID != "addAddress"){
            //leave empty lang para mo exit na sa condition
        }

        //CREATE ID FOR ORDER --------------------------------------------------------
        $order = Order::orderBy('created_at', 'DESC')->first();
        if(empty($order)){
            $orderID = 'ORDER_001';
        }else{
            $oldID = explode("_", $order['id']);
            $idInt = (int) $oldID[1];
            $idInt++;
            if($idInt <= 9){
                $orderID = 'ORDER_00'.$idInt;
            }elseif($idInt <= 99){
                $orderID = 'ORDER_0'.$idInt;
            }else{
                $orderID = 'ORDER_'.$idInt;
            }
        }
        //------------------------------------------------------------------------------

        $order = Order::create([
            'id', $orderID,
            'userID' => $userID,
            'mtoID' => $mtoID,
            'boutiqueID' => $mto->boutique['id'],
            'subtotal' => $request->input('subtotal'),
            'deliveryfee' => $request->input('deliveryfee'),
            'total' => $request->input('total'),
            'deliveryAddress' => $addressID, //remove ni
            'status' => "Pending",
            'paymentStatus' => "Not Yet Paid",
            'billingName' => $request->input('billingName'), //remove ni
            'phoneNumber' => $addressID, //remove ni
            'boutiqueShare' => $request->input('boutiqueShare'),
            'adminShare' => $request->input('adminShare'),
            'addressID' => $addressID
        ]);

        $mto->update([
            'orderID' => $order['id'],
            'price' => $order['subtotal']
        ]);

        $boutiqueseller = User::where('id', $mto->boutique->owner['id'])->first();
        $boutiqueseller->notify(new CustomerAcceptsOffer($mto));

        return redirect('/view-mto/'.$mtoID);
    }

    public function cancelMto($mtoID)
    {
        $mto = Mto::where('id', $mtoID)->first();
        Mto::where('id', $mtoID)->update([
            'status' => "Cancelled"
        ]);

        //send notif to boutiquedat u cencelledt
        $boutiqueseller = User::where('id', $mto->boutique->owner['id'])->first();
        $boutiqueseller->notify(new CustomerCancelMto($mto));

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
        elseif($order['biddingID'] != null){
            return redirect('/view-bidding-order/'.$order->bidding['id']);
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

    public function paypalTransactionComplete(Request $request)
    {
        if($request->rentID != null){
            $rent = Rent::where('rentID', $request->rentID)->first();
            $order = Order::where('id', $request->rentOrderID)->first();
            $existingPayments = Payment::where('orderID', $request->rentOrderID)->get();
            $amount = 0;

            $purchaseUnits = $request->details['purchase_units'];
            foreach($purchaseUnits as $purchaseUnit){
               $amount += $purchaseUnit['amount']['value'];
            }

            $newBalance = $request->balance - $amount;
            if($newBalance > 0){
                $status = 'Paid Partially';
            }elseif($newBalance == 0){
                $status = 'Fully Paid';
            }

            $payment = Payment::create([
                'orderID' => $request->rentOrderID,
                'amount' => $amount,
                'balance' => $newBalance,
                'paypalOrderID' => $request->paypalOrderID, 
                'status' => $status
            ]);

            $order->update([
                'status' => 'In-Progress',
                'paymentStatus' => $status
                // 'paypalOrderID' => $request->paypalOrderID
            ]);

            $boutiqueseller = User::where('id', $rent->boutique->owner['id'])->first();
            $boutiqueseller->notify(new CustomerPaysOrder($order));

            return redirect('/view-rent/'.$rent['rentID']);


        }elseif($request->mtoOrderID != null){

            $mto = Mto::where('id', $request->mtoID)->first();
            $order = Order::where('id', $request->mtoOrderID)->first();
            $existingPayments = Payment::where('orderID', $request->mtoOrderID)->get();
            $amount = 0;

            $purchaseUnits = $request->details['purchase_units'];
            foreach($purchaseUnits as $purchaseUnit){
               $amount += $purchaseUnit['amount']['value'];
            }

            $newBalance = $request->balance - $amount;
            if($newBalance > 0){
                $status = 'Paid Partially';
            }elseif($newBalance == 0){
                $status = 'Fully Paid';
            }

            $payment = Payment::create([
                'orderID' => $request->mtoOrderID,
                'amount' => $amount,
                'balance' => $newBalance,
                'paypalOrderID' => $request->paypalOrderID, 
                'status' => $status
            ]);

            $order->update([
                'status' => 'In-Progress',
                'paymentStatus' => $status
                // 'paypalOrderID' => $request->paypalOrderID
            ]);

            $boutiqueseller = User::where('id', $mto->boutique->owner['id'])->first();
            $boutiqueseller->notify(new CustomerPaysOrder($order));

            return redirect('/view-mto/'.$mto['id']);


        }elseif($request->biddingID != null){

            $order = Order::where('id', $request->biddingOrderID)->first();
            $existingPayments = Payment::where('orderID', $request->biddingOrderID)->get();
            $amount = 0;

            $purchaseUnits = $request->details['purchase_units'];
            foreach($purchaseUnits as $purchaseUnit){
               $amount += $purchaseUnit['amount']['value'];
            }


            $newBalance = $request->balance - $amount;
            if($newBalance > 0){
                $status = 'Paid Partially';
            }elseif($newBalance == 0){
                $status = 'Fully Paid';
            }

            $payment = Payment::create([
                'orderID' => $request->biddingOrderID,
                'amount' => $amount,
                'balance' => $newBalance,
                'paypalOrderID' => $request->paypalOrderID, 
                'status' => $status
            ]);

            $order->update([
                'status' => 'In-Progress',
                'paymentStatus' => $status
                // 'paypalOrderID' => $request->paypalOrderID
            ]);

            $boutiqueseller = User::where('id', $order->boutique->owner['id'])->first();
            $boutiqueseller->notify(new CustomerPaysOrder($order));

            return redirect('view-bidding-order/'.$request->biddingID);

            
        }elseif($request->orderTransactionID != null){

            // print_r($request->paypalOrderID);
            $order = Order::where('id', $request->orderTransactionID)->first();
            $existingPayments = Payment::where('orderID', $request->orderTransactionID)->get();
            $amount = 0;

            $purchaseUnits = $request->details['purchase_units'];
            foreach($purchaseUnits as $purchaseUnit){
               $amount += $purchaseUnit['amount']['value'];
            }


            $newBalance = $request->balance - $amount;
            if($newBalance > 0){
                $status = 'Paid Partially';
            }elseif($newBalance == 0){
                $status = 'Fully Paid';
            }

            $payment = Payment::create([
                'orderID' => $request->orderTransactionID,
                'amount' => $amount,
                'balance' => $newBalance,
                'paypalOrderID' => $request->paypalOrderID, 
                'status' => $status
            ]);
            
            $order->update([
                'status' => 'In-Progress',
                'paymentStatus' => $status
                // 'paypalOrderID' => $request->paypalOrderID
            ]);
            
            print_r($payment);
            exit();

            $boutiqueseller = User::where('id', $order->boutique->owner['id'])->first();
            $boutiqueseller->notify(new CustomerPaysOrder($order));

            return redirect('view-order/'.$order['id']);
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

    public function getOrderHistory()
    {
        $userID = Auth()->user()->id;
        $orderHistory = Order::where('userID', $userID)->get();

        return $orderHistory;
    }

    public function mixnmatch()
    {
        $page_title = "Choose your Event";
        $userID = Auth()->user()->id;
        $categories = Category::all();
        $boutiques = Boutique::all();
        $products = Product::where('productStatus', 'Available')->get();
        $productsCount = $products->count();
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }
        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);
        $orderHistories = Order::where('userID', $userID)->get();
        $favorites = Favorite::where('userID', $userID)->get();
        $events = Event::all();
        $eventNames = $events->groupBy('event');
        // dd($products);


        return view('hinimo/mixnmatch', compact('page_title', 'userID', 'categories', 'products', 'cart', 'cartCount', 'boutiques', 'notifications', 'notificationsCount', 'productsCount', 'events', 'eventNames'));
    }

    public function getEventTags($eventName)
    {   
        $eventArray = array();
        $productsArray = array();
        $setsArray = array();
        $storage = array();
        $scores = array();
        $productReference = array();
        $sortedProducts = array();
        $productURL = array();
        $setURL = array();
        $events = Event::where('event', $eventName)->get();

        //events
        foreach($events as $event){
            $counter = 0;
            $tag = Categorytag::where('id', $event->tag['id'])->first();

            //tags on items
            $itemtags = Itemtag::where('tagID', $tag['id'])->get();

            if($itemtags){

                //pagkuha sa tag on item
                foreach($itemtags as $itemtag){

                    //pagkuha sa item
                    if($itemtag['itemType'] == 'product'){

                        $product = Product::where('id', $itemtag['itemID'])->with('owner')->with('rentDetails')->with('productFile')->first();
                        array_push($storage, $product['id']);
                        $productReference[$product['id']] = 'product';
                        $productsArray[$product['id']] = $product;
                        $productURL[$product['id']][] = $product->productFile[0]['filename'];
                        // dd($productURL);

                    }elseif($itemtag['itemType'] == 'set'){
                        $product = Set::where('id', $itemtag['itemID'])->with('owner')->with('rentDetails')->first();
                        // dd($product);
                        array_push($storage, $product['id']);
                        $productReference[$product['id']] = 'set';
                        $setsArray[$product['id']] = $product;

                        foreach($product->items as $item){
                            $prod = Product::where('id', $item['productID'])->first();
                            $setURL[$product['id']][] = $prod->productFile[0]['filename'];
                        }
                        // $productURL[$product['id']] = ''
                    }

                }
            }

            array_push($eventArray, $tag);
        }
        $scores = array_count_values($storage);

        arsort($scores);

        foreach($scores as $id => $score){
            if($productReference[$id]  == 'product'){
                array_push($sortedProducts, $productsArray[$id]);
            }else{
                array_push($sortedProducts, $setsArray[$id]);
            }
        }

        // dd($eventArray);


        return response()->json([
            'tags' => $eventArray,
            'sortedProducts' => $sortedProducts,
            'productURL' => $productURL,
            'setURL' => $setURL
        ]);
        
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

    public function addmnmtoCart($top, $bottom)
    {
        $userID = Auth()->user()->id;
        $cart = Cart::where('userID', $userID)->orderBy('created_at', 'DESC')->first();
        $product = Product::where('id', $top)->first();
        $boutique = Boutique::where('id', $product['boutiqueID'])->first();

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
            'productID' => $top
        ]);

        Cartitem::create([
            'cartID' => $cart['id'],
            'productID' => $bottom
        ]);
        

        return redirect('/'.$boutique['id'].'/mixnmatch');
    }

    public function editProfile(Request $request)
    {
        $userID = Auth()->user()->id;

        $user = User::where('id', $userID)->update([
            'fname' => ucwords($request->input('fname')),
            'lname' => ucwords($request->input('lname')),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
        ]);

        return redirect('user-account');
    }

    public function gallery()
    {
        $page_title = "Gallery";
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

        $pictures = Gallery::where('userID', $userID)->get();

        return view('hinimo/gallery', compact('page_title', 'user', 'boutiques', 'notifications', 'notificationsCount', 'cart', 'cartCount', 'pictures'));

    }

    public function setDetails($setID)
    {
        $user = Auth()->user();
        $set = Set::where('id', $setID)->first();
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

        $cities = City::all();
        $sp = Sharepercentage::where('id', '1')->first();
        $percentage = $sp['sharePercentage'] / 100;


        return view('hinimo/set-single-product-details', compact('set', 'cart', 'cartCount', 'user', 'addresses', 'boutiques', 'page_title', 'notifications', 'notificationsCount', 'cities', 'percentage'));

    }

    public function submitRequestToRentSet($setID)
    {
        $user = Auth()->user();
        $userID = Auth()->user()->id;
        $product = Set::where('id', $setID)->first();
        $addresses = Address::where('userID', $user['id'])->get();
        $boutiques = Boutique::all();
        $page_title = "Request to Rent";
        $addresses = Address::where('userID', $userID)->get();
        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);
        $cart = Cart::where('userID', $user['id'])->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        $cities = City::all();
        $sp = Sharepercentage::where('id', '1')->first();
        $percentage = $sp['sharePercentage'] / 100;
        // dd($product);
        
        // $totalPrice = $product['rentPrice'] + $product['deliveryFee'];

        return view('hinimo/requestToRentSet', compact('product', 'cart', 'cartCount', 'user', 'addresses', 'boutiques', 'page_title', 'notifications', 'notificationsCount', 'cities', 'percentage', 'addresses'));
    }

    public function requestToRentSet(Request $request)
    {
        $id = Auth()->user()->id;
        $user = User::find($id);

        // $measurement = $request->input('measurement');
        // $mName = json_encode($measurement);

        $dateuse = date('Y-m-d',strtotime($request->input('dateToUse')));
        $toadd = $request->input('limitOfDays');
        $dateToBeReturned = date('Y-m-d', strtotime($dateuse.'+'.$toadd.' days'));

        $deliveryAddress = $request->input('deliveryAddress');
        $addressID = $request->input('selectAddress');

        if($deliveryAddress != null && $addressID == "addAddress"){
            $address = Address::create([
                'userID' => $id, 
                'contactName' => $request->input('billingName'), 
                'phoneNumber' => $request->input('phoneNumber'),
                'completeAddress' => $request->input('deliveryAddress'),
                'lat' => $request->input('lat'), 
                'lng' => $request->input('lng'), 
                'status' => "Not Default"
            ]);
            $addressID = $address['id'];
        }elseif($deliveryAddress != null && $addressID != "addAddress"){
            //leave empty lang para mo exit na sa condition
        }

        $rent = Rent::create([
            'boutiqueID' => $request->input('boutiqueID'),
            'customerID' => $id, 
            'status' => "Pending", 
            'setID' => $request->input('setID'), 
            'dateToUse' => $dateuse, 
            'dateToBeReturned' => $dateToBeReturned, 
            'additionalNotes' => $request->input('additionalNotes')
        ]);

        $data = array();
        $cmArray = array();
        // $categoryName = $mrequest->category['categoryName'];
        $measurements = $request->input('measurement');

        // array_push($cmArray, $categoryName);
        array_push($cmArray, $measurements);

        array_push($data, $cmArray);

        $dataJson = json_encode($data);
        // DD($dataJson);

        // $measurement = Measurement::create([
        //     'userID' => $userID,
        //     'type' => 'bidding',
        //     'typeID' => $biddingID,
        //     'data' => $dataJson
        // ]);

        $measurement = Measurement::create([
            'userID' => $id,
            'type' => 'rent',
            'typeID' => $rent['rentID'],
            'data' => $dataJson
        ]);

        $order = Order::create([
            'userID' => $id,
            'rentID' => $rent['rentID'],
            'boutiqueID' => $request->input('boutiqueID'),
            'subtotal' => $request->input('subtotal'),
            'deliveryfee' => $request->input('deliveryfee'),
            'total' => $request->input('total'),
            'deliveryAddress' => $addressID,
            'status' => "Pending",
            'paymentStatus' => "Not Yet Paid",
            'billingName' => $request->input('billingName'), 
            'phoneNumber' => $addressID,
            'boutiqueShare' => $request->input('boutiqueShare'),
            'adminShare' => $request->input('adminShare'),
            'addressID' => $addressID
        ]);

        $rent->update([
            'orderID' => $order['id'],
            'measurementID' => $measurement['id']
        ]);

        // Product::where('id', $rent['productID'])->update([
        //     'productStatus' => "Not Available"
        // ]);

        $boutique = Boutique::where('id', $rent['boutiqueID'])->first();
        $boutiqueseller = User::find($boutique['userID']);
        
        $boutiqueseller->notify(new RentRequest($rent));

        return redirect('/view-rent/'.$rent['rentID']);
    }

    public function favorites()
    {
        $page_title = "Favorites";
        $userID = Auth()->user()->id;
        $favorites = Favorite::where('userID', $userID)->get();
        $favoritesCount = $favorites->count();
        $boutiques = Boutique::all();
        $cart = Cart::where('userID', $userID)->where('status', 'Active')->first();
        if($cart != null){
            $cartCount = $cart->items->count();
        }else{
            $cartCount = 0;
        }

        $notifications;
        $notificationsCount;
        $this->getNotifications($notifications, $notificationsCount);

        // dd($favorites[1]->product->productFile);

        return view('hinimo/favorites', compact('favorites', 'cart', 'cartCount', 'userID', 'favoritesCount', 'boutiques', 'notAvailables', 'page_title', 'notifications', 'notificationsCount'));
    }

    public function addToFavorites($productID)
    {
        $userID = Auth()->user()->id;
        $favorites = Favorite::where('userID', $userID)->get();
        $product = Product::where('id', $productID)->first();

        $favorites = Favorite::create([
            'userID' => $userID,
            'itemID' => $productID
        ]);

        return response()->json([
            'favorites' => $favorites
        ]);
    }

    public function unFavoriteProduct($productID)
    {
        $userID = Auth()->user()->id;
        Favorite::where('userID', $userID)->where('itemID', $productID)->delete();
    }

    public function addSetToFavorites($setID)
    {
        $userID = Auth()->user()->id;
        $favorites = Favorite::where('userID', $userID)->get();
        $set = Set::where('id', $setID)->first();

        $favorites = Favorite::create([
            'userID' => $userID,
            'itemID' => $setID
        ]);

        return response()->json([
            'favorites' => $favorites
        ]);
    }

    public function unFavoriteSet($setID)
    {
        $userID = Auth()->user()->id;
        Favorite::where('userID', $userID)->where('itemID', $setID)->delete();
    }

    public function fileComplain(Request $request)
    {
        // dd($request->input());
        $user = User::where('id', $request->input('userID'))->first();
        $orderID = $request->input('orderID');
        $order = Order::where('id', $orderID)->first();

        $complain = Complain::create([
            'userID' => $request->input('userID'),
            'orderID' => $orderID,
            'complain' => $request->input('complain'),
            'status' => 'Active'
        ]);

        $uploads = $request->file('file');
        if($request->hasFile('file')) {
            foreach($uploads as $upload){
                $files = new File();
                // $name = $upload->getClientOriginalName();
                $destinationPath = public_path('uploads');
                $random = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7).$upload->getClientOriginalName();
                $filename = $destinationPath.'\\'. $random;
                $upload->move($destinationPath, $filename);

                $files->userID = $user['id'];
                $files->complainID = $complain['id'];
                $files->filename = "/".$random;
                $files->save();
                $filename = "/".$random;
            }
        }

        $order->update([
            'status' => 'On Hold'
        ]);

        $boutique = Boutique::where('id', $order->boutique['id'])->first();
        $boutiqueseller = User::where('id', $boutique['userID'])->first();
        $boutiqueseller->notify(new NotifyOfComplain($orderID, $user));

        $admin = User::where('roles', 'admin')->first();
        $admin->notify(new NotifyAdminOfComplain($orderID, $boutique));


        if($order['cartID'] != null){
            return redirect('view-order/'.$orderID);

        }elseif($order['rentID'] != null){
            return redirect('view-rent/'.$order['rentID']);

        }elseif($order['mtoID'] != null){
            return redirect('view-mto/'.$order['mtoID']);

        }elseif($order['biddingID'] != null){
            return redirect('view-bidding-order/'.$order['biddingID']);

        }
    }

    public function cSendChat(Request $request)
    {
        $id = Auth()->user()->id;
        $orderID = $request->input('orderID');
        $order = Order::where('id', $orderID)->first();
        $chat = Chat::create([
            'orderID' => $orderID,
            'receiverID' => $order->boutique['id'],
            'senderID' => $id,
            'senderType' => 'customer',
            'message' => $request->input('message'),
            'status' => 'unread'
        ]);

        $boutique = Boutique::where('id', $order->boutique['id'])->first();
        $boutiqueseller = User::where('id', $boutique['userID'])->first();
        $boutiqueseller->notify(new NotifyBoutiqueOfChat($chat));

        
        if($order['cartID'] != null){
            return redirect('view-order/'.$orderID.'#chat');

        }elseif($order['rentID'] != null){
            return redirect('view-rent/'.$order['rentID'].'#chat');

        }elseif($order['mtoID'] != null){
            return redirect('view-mto/'.$order['mtoID'].'#chat');

        }elseif($order['biddingID'] != null){
            return redirect('view-bidding-order/'.$order['biddingID'].'#chat');

        }
    }

    public function submitPaypalEmail(Request $request)
    {
        $orderID = $request->input('orderID');
        $order = Order::where('id', $orderID)->first();
        $refund = Refund::where('id', $request->input('refundID'))->first();
        // dd($refund);

        $refund->update([
            'paypalEmail' => $request->input('paypalEmail')
        ]);
        // dd($refund);

        $admin = User::where('roles', 'admin')->first();
        $admin->notify(new PaypalEmailSubmitted($refund));


        if($order['cartID'] != null){
            return redirect('view-order/'.$orderID);

        }elseif($order['rentID'] != null){
            return redirect('view-rent/'.$order['rentID']);

        }elseif($order['mtoID'] != null){
            return redirect('view-mto/'.$order['mtoID']);

        }elseif($order['biddingID'] != null){
            return redirect('view-bidding-order/'.$order['biddingID']);

        }
    }

}
