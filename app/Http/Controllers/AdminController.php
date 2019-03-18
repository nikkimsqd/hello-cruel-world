<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;


class AdminController extends Controller
{

    public function addBoutique()
    {
        return view('auth/registerseller');
    }
    
    public function tags()
	{
		$user = Auth()->user()->id;
		$boutique = Boutique::where('userID', $user)->first();
		$categories = Category::all();

		dd($boutique);

		return view('boutique/tags', compact('categories', 'boutique', 'user'));
	}

	public function addTag(Request $request)
	{
		$user = Auth()->user()->id;

		$tags = Tag::create([
			'userID' => $user,
			'name' => $request->input('tag')
		]);
	}
}
