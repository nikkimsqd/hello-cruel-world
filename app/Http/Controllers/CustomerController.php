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



class CustomerController extends Controller
{

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


    public function index()
    {
        $userID = Auth()->user()->id;
    	$categories = Category::all();
    	$products = Product::all();
        $cartCount = Cart::where('userID', $userID)->where('status', "Pending")->count();
        $carts = Cart::where('userID', $userID)->where('status', "Pending")->get();
        $boutiques = Boutique::all();

    	return view('hinimo/index', compact('categories', 'products', 'carts', 'cartCount', 'userID', 'boutiques'));
    }

    public function shop()
    {
        if (Auth::check()) {
       		$userID = Auth()->user()->id;
            $products = Product::all();
        	$productsCount = Product::all()->count();
        	$categories = Category::all();
        	$cartCount = Cart::where('userID', $userID)->where('status', "Pending")->count();
        	$carts = Cart::where('userID', $userID)->where('status', "Pending")->get();
            $boutiques = Boutique::all();
            // dd($boutiques);
      
        	return view('hinimo/shop', compact('products', 'categories', 'carts', 'cartCount', 'userID', 'productsCount', 'boutiques'));
        }else {
            $products = Product::all();
            $productsCount = Product::all()->count();
            $categories = Category::all();
            $cartCount = Cart::where('userID', "")->where('status', "Pending")->count();
            $carts = Cart::where('userID', "")->where('status', "Pending")->get();
            $boutiques = Boutique::all();

            return view('hinimo/shop', compact('products', 'categories', 'carts', 'cartCount', 'userID', 'productsCount', 'boutiques'));
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
        
        $totalPrice = $product['rentPrice'] + $product['deliveryFee'];
        // dd($totalPrice);

    	return view('hinimo/single-product-details', compact('product', 'carts', 'cartCount', 'user', 'addresses', 'boutiques', 'totalPrice'));
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
   		$userID = Auth()->user()->id;
    	$carts = Cart::where('userID', $userID)->where('status', "Pending")->get();
        $boutiques = Boutique::all();
    	
    	return view('hinimo/cart', compact('carts', 'boutiques'));
    }

    public function removeItem($cartID)
    {
        $item = Cart::where('id', $cartID)->delete();

        return redirect('/checkout');
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
    	return view('hinimo/checkout');
    }

    public function useraccount()
    {
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

        return view('hinimo/useraccount', compact('categories', 'products', 'carts', 'cartCount', 'user', 'cities', 'barangays', 'addresses', 'boutiques'));

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

    // public function propaganda()
    // {
    //     $userID = Auth()->user()->id;
    //     // $userID = "3";

    //     $boutique = Boutique::where('userID', $userID)->first();

    //     if($boutique == null){
    //         $categories = Category::all();
    //         $products = Product::all();
    //         $cartCount = Cart::where('userID', $userID)->where('status',"Pending")->count();
    //         $carts = Cart::where('userID', $userID)->where('status', "Pending")->get();

    //         return view('hinimo/propaganda', compact('categories', 'products', 'carts', 'cartCount', 'userID'));

    //     }else{

    //         $categories = Category::all();
    //         $products = Product::all();
    //         $cartCount = Cart::where('userID', $userID)->where('status',"Pending")->count();
    //         $carts = Cart::where('userID', $userID)->where('status', "Pending")->get();

    //         return view('hinimo/shop', compact('categories', 'products', 'carts', 'cartCount', 'userID'));

    //     }
    // }

    // public function registerboutique()
    // {

    //     $userID = Auth()->user()->id;
    //     $categories = Category::all();
    //     $products = Product::all();
    //     $cartCount = Cart::where('userID', $userID)->where('status',"Pending")->count();
    //     $carts = Cart::where('userID', $userID)->where('status', "Pending")->get();

    //     return view('hinimo/upgradetoseller', compact('categories', 'products', 'carts', 'cartCount', 'userID'));
    // }

    // public function saveboutique(Request $request)
    // {   
    //     $userID = Auth()->user()->id;

    //     $boutique = Boutique::create([
    //         'userID' => $userID,
    //         'boutiqueName' => $request->input('boutiqueName'),
    //         'boutiqueAddress' => $request->input('boutiqueAddress')
    //     ]);

    //     // $id = Auth()->user()->id;
    //     $user = User::find($userID);

    //     return redirect('dashboard');
    // }


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

        $rent = Rent::create([
            'boutiqueID' => $request->input('boutiqueID'),
            'customerID' => $id, 
            'status' => "Pending", 
            'productID' => $request->input('productID'), 
            'dateToUse' => $request->input('dateToUse'), 
            'locationToBeUsed' => $request->input('locationToBeUsed'), 
            'addressOfDelivery' => $request->input('addressOfDelivery'),
            'additionalNotes' => $request->input('additionalNotes'),
            // 'deliveryFee' => $request->input('')
        ]);

        return redirect('/shop');
    }

    public function showBiddings()
    {
        if (Auth::check()) {
            $userID = Auth()->user()->id;
        }

        $page_title = 'BIDDINGS';
        $products = [];
        $productsCount = Product::all()->count();
        $categories = Category::all();
        $cartCount = Cart::where('userID', "")->where('status', "Pending")->count();
        $carts = Cart::where('userID', "")->where('status', "Pending")->get();
        $boutiques = Boutique::all();

        return view('hinimo/bidding', compact('page_title', 'products', 'categories', 'carts', 'cartCount', 'userID', 'productsCount', 'boutiques'));
    }

    public function showStartNewBidding()
    {
        $page_title = "START A BIDDING";
        $userID = Auth()->user()->id;
        $products = [];
        $productsCount = Product::all()->count();
        $categories = Category::all();
        $cartCount = Cart::where('userID', $userID)->where('status', "Pending")->count();
        $carts = Cart::where('userID', $userID)->where('status', "Pending")->get();
        $boutiques = Boutique::all();
  
        return view('hinimo/bidding-newBidding', compact('page_title', 'products', 'categories', 'carts', 'cartCount', 'userID', 'productsCount', 'boutiques'));
    }
}
