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


	public function dashboard()
	{
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$users = User::all();
		$orders = Order::all();
		$rents = Rent::all();


		return view('admin/dashboard', compact('admin', 'users', 'orders', 'rents'));
	}

	public function orders()
	{
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$orders = Order::all();

		return view('admin/orders', compact('admin', 'orders'));
	}

    public function addBoutique()
    {
        return view('auth/registerseller');
    }
    
    public function tags()
	{
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$tags = Tag::all();

		return view('admin/tags', compact('admin', 'tags'));
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
		$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();
		$tags = Tag::all();


		$categories = Category::all();
		$womens = Category::where('gender', "Womens")->get();
		$mens = Category::where('gender', "Mens")->get();
			

		return view('admin/categories',compact('admin', 'categories','womens', 'mens'));
	}

	public function addCategories()
	{
    	$id = Auth()->user()->id;
		// $products = Product::where('userID', $id)->get();
		$user = User::find($id);
		$boutiques = Boutique::where('userID', $id)->get();
		// dd($user);

		foreach ($boutiques as $boutique) {
			$boutique;
		}

		return view('boutique/addCategories' ,compact('user', 'boutique'));
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
    	$id = Auth()->user()->id;
		$admin = User::where('id', $id)->first();

		$rents = Rent::all();

		return view('admin/rents', compact('admin', 'rents'));
	}

}
