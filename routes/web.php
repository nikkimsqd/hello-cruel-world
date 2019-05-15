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

// $this->get('register-boutique', 'Auth\RegisterController@showBoutiqueRegistrationForm')->name('registerseller');
// $this->post('register-boutique', 'Auth\RegisterController@register');


Auth::routes();
// Route::get('/home', 'HomeController@index');
Route::get('/home', 'CustomerController@index');


//SHOP
Route::get('/shop', 'CustomerController@shop');
Route::get('/index', 'CustomerController@index');
Route::get('/shop/{gender}', 'CustomerController@shopWomens');
Route::get('/shop/{gender}/{category}', 'CustomerController@shopWomens');
Route::get('/single-product-details/{productID}', 'CustomerController@productDetails');
Route::get('/user-account', 'CustomerController@useraccount');
Route::get('/user-transactions', 'CustomerController@usertransactions');



Route::middleware(['auth'])->group(function(){

//ADMIN--------------------------------------------------------------------------------------------
Route::get('/admin-dashboard', 'AdminController@dashboard');
Route::get('/admin-orders', 'AdminController@orders');
Route::get('/admin-made-to-orders', 'AdminController@madeToOrders');
Route::get('/admin-rents', 'AdminController@rents');
Route::get('/admin-categories', 'AdminController@categories');
Route::get('/admin-tags', 'AdminController@tags');
Route::post('/addTag', 'AdminController@addTag');
Route::post('/saveCategory', 'AdminController@saveCategory');
Route::get('/declineCategory/{notificationID}', 'AdminController@declineCategory');

Route::get('/admin-locations', 'AdminController@locations');
Route::get('/admin-getProvince/{regCode}', 'AdminController@getProvince');
Route::get('/admin-getCity/{provCode}', 'AdminController@getCity');
Route::get('/admin-getBrgy/{citymunCode}', 'AdminController@getBrgy');
Route::post('/addLocation', 'AdminController@addLocation');

Route::get('/categories-notifications/{notificationID}', 'AdminController@viewNotifications');


//BOUTIQUE----------------------------------------------------------------------------------------
Route::get('/dashboard', 'BoutiqueController@dashboard');
Route::get('/categories', 'BoutiqueController@categories');
Route::post('/requestCategory', 'BoutiqueController@requestCategory');
// Route::post('/saveCategory', 'BoutiqueController@saveCategory'); naa nani ni boutique


//crud product
Route::get('/addproduct', 'BoutiqueController@addProduct');
Route::post('/saveproduct', 'BoutiqueController@saveProduct');
Route::get('/viewproduct/{productID}', 'BoutiqueController@viewProduct');
Route::get('/editView/{productID}', 'BoutiqueController@editView');
Route::post('/editproduct/{productID}', 'BoutiqueController@editProduct');
Route::get('/delete/{productID}', 'BoutiqueController@delete');

//view products
Route::get('/products', 'BoutiqueController@showProducts');
Route::get('/products/womens', 'BoutiqueController@getwomens');
Route::get('/products/mens', 'BoutiqueController@getmens');
Route::get('/products/embellishments', 'BoutiqueController@getembellishments');
Route::get('/products/customizable', 'BoutiqueController@getcustomizables');
Route::get('/getGender/{gender}', 'BoutiqueController@getGender');


//TRANSACTIONS-RENT
Route::get('/rents', 'BoutiqueController@rents');
Route::get('/rents/{rentID}', 'BoutiqueController@getRentInfo');
Route::post('/approveRent', 'BoutiqueController@approveRent');
Route::post('/declineRent', 'BoutiqueController@declineRent');
Route::post('/updateRentInfo', 'BoutiqueController@updateRentInfo');
Route::post('/makeOrderforRent', 'BoutiqueController@makeOrderforRent');

Route::get('/rent-notifications/{notificationID}', 'BoutiqueController@viewNotifications');


//TRANSACTIONS-MADE TO ORDERS
Route::get('/made-to-orders', 'BoutiqueController@madeToOrders');

	


//CUSTOMER--------------------------------------------------------------------------------------------
Route::get('/get-started/welcome', 'CustomerController@welcome');
Route::get('/get-started', 'CustomerController@getStarted');
Route::post('/user-profiling', 'CustomerController@profiling');
Route::get('/user-profiling/done', 'CustomerController@profilingDone');


Route::get('/sortBy/{condition}', 'CustomerController@sortBy');
Route::get('/getProducts/{condition}', 'CustomerController@getProducts');


//REQUEST FOR RENT
Route::post('/requestToRent', 'CustomerController@requestToRent');


//CART
Route::get('/addtoCart/{productID}', 'CustomerController@addtoCart');
Route::get('/cart', 'CustomerController@cart');
Route::get('/checkout', 'CustomerController@checkout');
Route::get('/getCart/{productID}', 'CustomerController@getCart');
Route::get('/removeItem/{cartID}', 'CustomerController@removeItem');

//ADDRESS
Route::get('/addAddress/{userID}', 'CustomerController@addAddress');
Route::get('/getCity/{provCode}', 'CustomerController@getCity');
Route::get('/getBrgy/{citymunCode}', 'CustomerController@getBrgy');
Route::post('/addAddress', 'CustomerController@addAddress');
Route::get('/setAsDefault/{addressID}', 'CustomerController@setAsDefault');


//BIDDING
Route::get('/biddings', 'CustomerController@showBiddings');
Route::get('/biddings/startNewBidding', 'CustomerController@showStartNewBidding');
Route::post('/savebidding', 'CustomerController@savebidding');

//NOTIFICATIONS
Route::post('/user-notifications', 'CustomerController@notifications');



Route::view('/autocomplete', 'hinimo.autocomplete');

});


