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
    return redirect('/shop');
});

Auth::routes();
Route::get('/home', 'HomeController@index');


//SHOP
Route::get('/shop', 'CustomerController@shop');
Route::get('/index', 'CustomerController@index');
Route::get('/shop/{gender}', 'CustomerController@shopWomens');
Route::get('/shop/{gender}/{category}', 'CustomerController@shopWomens');
Route::get('/single-product-details/{productID}', 'CustomerController@productDetails');
Route::get('/user-account', 'CustomerController@useraccount');



Route::middleware(['auth'])->group(function(){

//admin
Route::get('/admin-dashboard', 'AdminController@dashboard');
Route::get('/admin-orders', 'AdminController@orders');
Route::get('/admin-made-to-orders', 'AdminController@madeToOrders');
Route::get('/admin-rents', 'AdminController@rents');
Route::get('/admin-categories', 'AdminController@categories');
Route::get('/admin-tags', 'AdminController@tags');
Route::post('/addTag', 'AdminController@addTag');
Route::post('/saveCategory', 'AdminController@saveCategory');


//boutique
Route::get('/dashboard', 'BoutiqueController@dashboard');
Route::get('/categories/', 'BoutiqueController@categories');
Route::get('/addCategories', 'BoutiqueController@addCategories');
// Route::post('/saveCategory', 'BoutiqueController@saveCategory'); naa nani ni boutique



Route::get('/addproduct', 'BoutiqueController@addProduct');
Route::post('/saveproduct', 'BoutiqueController@saveProduct');
Route::get('/viewproduct/{productID}', 'BoutiqueController@viewProduct');
Route::get('/editView/{productID}', 'BoutiqueController@editView');
Route::post('/editproduct/{productID}', 'BoutiqueController@editProduct');
Route::get('/delete/{productID}', 'BoutiqueController@delete');


Route::get('/products', 'BoutiqueController@showProducts');
Route::get('/products/womens', 'BoutiqueController@showProducts');
Route::get('/products/mens', 'BoutiqueController@showProducts');
Route::get('/products/embellishments', 'BoutiqueController@showProducts');
Route::get('/getGender/{gender}', 'BoutiqueController@getGender');



//TRANSACTIONS-RENT
Route::get('/made-to-orders', 'BoutiqueController@madeToOrders');
Route::get('/rents', 'BoutiqueController@rents');
Route::get('/getRentInfo/{rentID}', 'BoutiqueController@getRentInfo');
Route::post('/approveRent', 'BoutiqueController@approveRent');
Route::get('/declineRent/{rentID}', 'BoutiqueController@declineRent');




Route::view('/weddinggowns', 'boutique.weddinggowns');
Route::view('/entourage', 'boutique.entourage');
Route::view('/accessories', 'boutique.accessories');
// Route::view('/made-to-orders', 'boutique.madetoorders');
Route::view('/boutique-account', 'boutique.boutiqueaccount');
	


//CUSTOMER--------------------------------------------------------------------------------------------
Route::get('/get-started/welcome', 'CustomerController@welcome');
Route::get('/get-started', 'CustomerController@getStarted');
Route::post('/user-profiling', 'CustomerController@profiling');
Route::get('/user-profiling/done', 'CustomerController@profilingDone');
// Route::get('/get-started/tops', 'CustomerController@tops');





Route::get('/sortBy/{condition}', 'CustomerController@sortBy');
Route::get('/getProducts/{condition}', 'CustomerController@getProducts');


//upgrade account
Route::get('/upgrade-user-account', 'CustomerController@propaganda');
// Route::get('/register-boutique', 'CustomerController@registerboutique');
Route::post('/save-boutique', 'CustomerController@saveboutique');

Route::view('/autocomplete', 'hinimo.autocomplete');


//request for rent
Route::post('/requestToRent', 'CustomerController@requestToRent');




//CART
Route::get('/addtoCart/{productID}', 'CustomerController@addtoCart');
Route::get('/cart', 'CustomerController@cart');
Route::get('/checkout', 'CustomerController@checkout');
Route::get('/getCart/{productID}', 'CustomerController@getCart');
Route::get('/removeItem/{cartID}', 'CustomerController@removeItem');


//ADDRESS
Route::get('/addAddress/{userID}', 'CustomerController@addAddress');
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
