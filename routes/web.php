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
Route::get('/dashboard', 'BoutiqueController@dashboard');
Route::view('/weddinggowns', 'boutique.weddinggowns');
Route::view('/entourage', 'boutique.entourage');
Route::view('/accessories', 'boutique.accessories');
Route::view('/made-to-orders', 'boutique.madetoorders');
Route::view('/rents', 'boutique.rents');
Route::view('/boutique-account', 'boutique.boutiqueaccount');
	

	
Route::get('/products', 'BoutiqueController@showProducts');
Route::get('/getGender/{gender}', 'BoutiqueController@getGender');


Route::get('/addproduct', 'BoutiqueController@addProduct');
Route::post('/saveproduct', 'BoutiqueController@saveProduct');
Route::get('/viewproduct/{productID}', 'BoutiqueController@viewProduct');
Route::get('/editView/{productID}', 'BoutiqueController@editView');
Route::post('/editproduct/{productID}', 'BoutiqueController@editProduct');
Route::get('/delete/{productID}', 'BoutiqueController@delete');



//customer
Route::get('/index', 'CustomerController@index');
Route::get('/shop', 'CustomerController@shop');
Route::get('/shop/{gender}', 'CustomerController@shopWomens');
Route::get('/shop/{gender}/{category}', 'CustomerController@shopWomens');
Route::get('/single-product-details/{productID}', 'CustomerController@productDetails');
Route::get('/user-account/{userID}', 'CustomerController@useraccount');
Route::get('/addAddress/{userID}', 'CustomerController@addAddress');

Route::view('/autocomplete', 'hinimo.autocomplete');




//CART
Route::get('/addtoCart/{productID}', 'CustomerController@addtoCart');
Route::get('/cart', 'CustomerController@cart');
Route::get('/checkout', 'CustomerController@cart');
Route::get('/getCart/{productID}', 'CustomerController@getCart');
Route::get('/removeItem/{cartID}', 'CustomerController@removeItem');


//ADDRESS
Route::get('/getProvince/{regCode}', 'CustomerController@getProvince');
Route::get('/getCity/{provCode}', 'CustomerController@getCity');
Route::get('/getBrgy/{citymunCode}', 'CustomerController@getBrgy');
Route::post('/addAddress', 'CustomerController@addAddress');
Route::get('/setAsDefault/{addressID}', 'CustomerController@setAsDefault');



});









// Route::view('/about', 'hinimo.about');
// Route::view('/how-it-works', 'hinimo.how');
// Route::view('/shop', 'hinimo.shop');
// Route::view('/shop/noelle-west-bridals', 'hinimo.noellewest');
// Route::view('/shop/younstyle', 'hinimo.younstyle');
// Route::view('/shop/kolossas', 'hinimo.kolossas');
// Route::view('/lookbook', 'hinimo.lookbook');
// Route::view('/contact-us', 'hinimo.contactus');
// Route::view('/create-design-choose-mannequin', 'hinimo.choosemannequin');
// Route::view('/create-design', 'hinimo.createdesign');
// Route::view('/my-account', 'hinimo.useraccount');
// Route::view('/created-designs', 'hinimo.designs');
// Route::view('/user-profile', 'hinimo.userprofile');
// Route::view('/logout', 'hinimo.index');
// Route::view('/my-designs', 'hinimo.designs');




//admin
Route::view('/admindashboard', 'admin.admindashboard');
