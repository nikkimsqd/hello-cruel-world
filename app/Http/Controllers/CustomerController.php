<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Cart;
use App\User;
use App\Region;
use App\Province;
use App\City;
use App\Barangay;
use App\Address;


class CustomerController extends Controller
{
    public function index()
    {
        $userid = Auth()->user()->id;
    	$categories = Category::all();
    	$products = Product::all();
        $cartCount = Cart::where('userID', $userid)->where('status', "Pending")->count();
        $carts = Cart::where('userID', $userid)->where('status', "Pending")->get();

    	return view('hinimo/index', compact('categories', 'products', 'carts', 'cartCount', 'userid'));
    }

    public function shop()
    {
   		$userid = Auth()->user()->id;
    	$products = Product::all();
    	$categories = Category::all();
    	$cartCount = Cart::where('userID', $userid)->where('status', "Pending")->count();
    	$carts = Cart::where('userID', $userid)->where('status', "Pending")->get();
    	// dd($carts);

    	return view('hinimo/shop', compact('products', 'categories', 'carts', 'cartCount', 'userid'));
    }

    public function productDetails($productID)
    {
    	$product = Product::where('productID', $productID)->first();

    	return view('hinimo/single-product-details', compact('product'));
    }

    public function addtoCart($productID)
    {
    	// print_r("yey");

   		$userid = Auth()->user()->id;
    	$cart = Cart::create([
    		'productID' => $productID,
    		'userID' => $userid,
    		'status' => "Pending"
    	]);

    	return redirect('/shop');
    }

    public function cart()
    {
   		$userid = Auth()->user()->id;
    	$carts = Cart::where('userID', $userid)->where('status', "Pending")->get();
    	
    	return view('hinimo/cart', compact('carts'));
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

    public function useraccount($userID)
    {
        // $userid = Auth()->user()->id;
        $user = User::find($userID);
        // dd($user['id']);
        // $userid = Auth()->user()->id;
        $categories = Category::all();
        $products = Product::all();
        $cartCount = Cart::where('userID', $user['id'])->where('status',"Pending")->count();
        $carts = Cart::where('userID', $user['id'])->where('status', "Pending")->get();
        $addresses = Address::where('userID', $user['id'])->get();


        $regions = Region::all();
        $provinces = Province::orderBy('provDesc', 'ASC')->get();
        $cities = City::all();
        $barangays = Barangay::all();

        return view('hinimo/useraccount', compact('categories', 'products', 'carts', 'cartCount', 'user', 'regions', 'provinces', 'cities', 'barangays', 'addresses'));

    }

    public function getCity($provCode)
    {

        $userid = Auth()->user()->id;

        $cities = City::where('provCode', $provCode)->get();
        // print_r("yey");

        // return redirect('/user-account/'.$userid);

        return response()->json(['cities' => $cities]);
    }

    public function getProvince($regCode)
    {
        $userid = Auth()->user()->id;
        $provinces = Province::where('regCode', $regCode)->get();

        return response()->json(['provinces' => $provinces]);
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
            'province' => $request->input('province'), 
            'city' => $request->input('city'), 
            'barangay' => $request->input('barangay'), 
            'completeAddress' => $request->input('completeAddress'),
            'status' => "Default"
        ]);

        return redirect('/user-account/'.$id);
    }

    // public function addAddress()
    // {
    //     $user = User::find($userID);
    //     $cartCount = Cart::where('userID', $user['id'])->where('status',"Pending")->count();
    //     $carts = Cart::where('userID', $user['id'])->where('status', "Pending")->get();



    //     return view('hinimo/addAddress', compact('user', 'carts', 'cartCount'));

    // }

    public function setAsDefault($addressID)
    {
        $id = Auth()->user()->id;

        $addresses = Address::where('status', "Default")->update([
            'status' => ""
        ]);


        $address = Address::where('id', $addressID)->update([
            'status' => "Default"
        ]);

        return redirect('/user-account/'.$id);

    }


}
