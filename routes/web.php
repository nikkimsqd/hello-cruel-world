<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index');



Route::middleware(['auth'])->group(function(){


//boutique
Route::view('/dashboard', 'boutique.dashboard');
Route::view('/weddinggowns', 'boutique.weddinggowns');
Route::view('/entourage', 'boutique.entourage');
Route::view('/accessories', 'boutique.accessories');
Route::view('/made-to-orders', 'boutique.madetoorders');
Route::view('/rents', 'boutique.rents');
Route::view('/boutique-account', 'boutique.boutiqueaccount');
	
Route::get('/products', 'BoutiqueController@showProducts');
Route::post('/uploadproduct', 'BoutiqueController@uploadProduct');




});










//customer
Route::view('/index', 'hinimo.index');
Route::view('/about', 'hinimo.about');
Route::view('/how-it-works', 'hinimo.how');
Route::view('/shop', 'hinimo.shop');
Route::view('/shop/noelle-west-bridals', 'hinimo.noellewest');
Route::view('/shop/younstyle', 'hinimo.younstyle');
Route::view('/shop/kolossas', 'hinimo.kolossas');
Route::view('/lookbook', 'hinimo.lookbook');
Route::view('/contact-us', 'hinimo.contactus');
Route::view('/create-design-choose-mannequin', 'hinimo.choosemannequin');
Route::view('/create-design', 'hinimo.createdesign');
Route::view('/my-account', 'hinimo.useraccount');
Route::view('/created-designs', 'hinimo.designs');
Route::view('/user-profile', 'hinimo.userprofile');
Route::view('/logout', 'hinimo.index');
Route::view('/my-designs', 'hinimo.designs');




//admin
Route::view('/admindashboard', 'admin.admindashboard');
