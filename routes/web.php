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


Route::view('/autocomplete', 'hinimo.autocomplete');
Route::view('/googleapi', 'hinimo.addressexample');


Route::middleware(['auth'])->group(function(){

//ADMIN--------------------------------------------------------------------------------------------
Route::get('/admin-dashboard', 'AdminController@dashboard');
Route::get('/admin-sales', 'AdminController@sales');
Route::get('/admin-orders', 'AdminController@orders');
Route::get('/admin-orders/{orderID}', 'AdminController@getOrder');
Route::get('/admin-archives', 'AdminController@archives');
Route::get('/admin-archives/{orderID}', 'AdminController@getArchives');
// Route::get('/admin-made-to-orders', 'AdminController@madeToOrders');
// Route::get('/admin-rents', 'AdminController@rents');

Route::post('/editPercentage', 'AdminController@editPercentage');

Route::get('/admin-tags', 'AdminController@tags');
Route::post('/addTag', 'AdminController@addTag');
Route::get('/admin-categories', 'AdminController@categories');
Route::post('/saveCategory', 'AdminController@saveCategory');
Route::get('/declineCategory/{notificationID}', 'AdminController@declineCategory');

Route::get('/admin-locations', 'AdminController@locations');
Route::get('/admin-getProvince/{regCode}', 'AdminController@getProvince');
Route::get('/admin-getCity/{provCode}', 'AdminController@getCity');
Route::get('/admin-getBrgy/{citymunCode}', 'AdminController@getBrgy');
Route::post('/addLocation', 'AdminController@addLocation');
Route::get('/deleteLocation/{cityID}', 'AdminController@deleteLocation');

Route::get('/categories-notifications/{notificationID}', 'AdminController@viewNotifications');

Route::get('/admin-measurements', 'AdminController@measurements');
Route::post('/admin-addMeasurement', 'AdminController@addMeasurement');


//BOUTIQUE----------------------------------------------------------------------------------------
Route::get('/reqToActivateAccount', 'BoutiqueController@reqToActivateAccount');
Route::post('/reqToVerify', 'BoutiqueController@reqToVerify');

Route::get('/dashboard', 'BoutiqueController@dashboard');
Route::get('/categories', 'BoutiqueController@categories');
Route::post('/requestCategory', 'BoutiqueController@requestCategory');
Route::get('/tags', 'BoutiqueController@tags');
Route::get('/fabrics', 'BoutiqueController@fabrics');
Route::post('/addFabric', 'BoutiqueController@addFabric');

Route::get('/boutique-getProvince/{regCode}', 'BoutiqueController@getProvince');
Route::get('/boutique-getCity/{provCode}', 'BoutiqueController@getCity');
Route::get('/boutique-getBrgy/{citymunCode}', 'BoutiqueController@getBrgy');

//crud product
Route::get('/addproduct', 'BoutiqueController@addProduct');
Route::post('/saveproduct', 'BoutiqueController@saveProduct');
Route::get('/viewproduct/{productID}', 'BoutiqueController@viewProduct');
Route::get('/editView/{productID}', 'BoutiqueController@editView');
Route::post('/editproduct/{productID}', 'BoutiqueController@editProduct');
Route::get('/delete/{productID}', 'BoutiqueController@delete');

//view products
Route::get('/products', 'BoutiqueController@showProducts');
// Route::get('/products/womens', 'BoutiqueController@getwomens');
// Route::get('/products/mens', 'BoutiqueController@getmens');
// Route::get('/products/embellishments', 'BoutiqueController@getembellishments');
// Route::get('/products/customizable', 'BoutiqueController@getcustomizables');
// Route::get('/getGender/{gender}', 'BoutiqueController@getGender');


//TRANSACTIONS-RENT
Route::get('/rents', 'BoutiqueController@rents');
Route::get('/rents/{rentID}', 'BoutiqueController@getRentInfo');
Route::post('/approveRent', 'BoutiqueController@approveRent');
// Route::post('/declineRent', 'BoutiqueController@declineRent');
// Route::post('/updateRentInfo', 'BoutiqueController@updateRentInfo');
// Route::post('/makeOrderforRent', 'BoutiqueController@makeOrderforRent');
Route::get('/rentReturned/{rentID}', 'BoutiqueController@rentReturned');

Route::get('/get-paypal-transaction/{orderId}', 'BoutiqueController@getPaypalOrder');

Route::get('/boutique-notifications', 'BoutiqueController@getnotifications');
Route::get('/view-notifications/{notificationID}', 'BoutiqueController@viewNotifications');


//TRANSACTIONS-MADE TO ORDERS
Route::get('/made-to-orders', 'BoutiqueController@madeToOrders');
Route::get('/made-to-orders/{mtoID}', 'BoutiqueController@getMadeToOrder'); 
Route::post('/declineMto', 'BoutiqueController@declineMto');
// Route::post('/requestCustomer', 'BoutiqueController@requestCustomer');
Route::get('/halfapproveMto/{mtoID}', 'BoutiqueController@halfapproveMto');
Route::post('/addPrice', 'BoutiqueController@addPrice');
Route::post('/recommendFabric', 'BoutiqueController@recommendFabric');
Route::get('/submitMTO/{mtoID}', 'BoutiqueController@submitMTO');
Route::get('/acceptMto/{mtoID}', 'BoutiqueController@acceptMto');

//TRANSACTIONS-ORDERS
Route::get('/orders', 'BoutiqueController@getOrders');
Route::get('/orders/{orderID}', 'BoutiqueController@getOrder');
Route::post('/submitOrder', 'BoutiqueController@submitOrder');
Route::post('/forAlterations', 'BoutiqueController@forAlterations');


//TRANSACTIONS-BIDDINGS
Route::post('/submitBid', 'BoutiqueController@submitBid');
Route::post('/updateBid', 'BoutiqueController@updateBid');
Route::get('/boutique-view-biddings', 'BoutiqueController@biddings');
Route::get('/boutique-view-bidding/{biddingID}', 'BoutiqueController@viewBidding');
Route::get('/boutique-biddings', 'BoutiqueController@boutiqueBiddings');
Route::get('/boutique-bidding/{biddingID}', 'BoutiqueController@viewBoutiqueBidding');



//CUSTOMER--------------------------------------------------------------------------------------------
Route::get('/get-started/welcome', 'CustomerController@welcome');
Route::get('/get-started', 'CustomerController@getStarted');
Route::post('/user-profiling', 'CustomerController@profiling');
Route::get('/user-profiling/done', 'CustomerController@profilingDone');


Route::get('/sortBy/{condition}', 'CustomerController@sortBy');
Route::get('/getProducts/{condition}', 'CustomerController@getProducts');

Route::get('/getMeasurements/{categoryID}', 'CustomerController@getMeasurements');


//REQUEST FOR RENT
Route::post('/requestToRent', 'CustomerController@requestToRent');
// Route::get('/receiveRent/{rentID}', 'CustomerController@receiveRent');

//ORDER
Route::post('/placeOrder', 'CustomerController@placeOrder');
Route::get('/receiveOrder/{orderID}', 'CustomerController@receiveOrder');



//CART
Route::get('/addtoCart/{productID}', 'CustomerController@addtoCart');
Route::get('/cart', 'CustomerController@cart');
Route::get('/checkout', 'CustomerController@checkout');
Route::get('/getCart/{productID}', 'CustomerController@getCart');
Route::get('/removeItem/{cartID}', 'CustomerController@removeItem');

//ADDRESS
// Route::get('/getCity/{provCode}', 'CustomerController@getCity');
// Route::get('/getBrgy/{citymunCode}', 'CustomerController@getBrgy');
Route::post('/addAddress', 'CustomerController@addAddress');
Route::get('/setAsDefault/{addressID}', 'CustomerController@setAsDefault');
// Route::post('/submitAddress', 'CustomerController@submitAddress');


//BIDDING
Route::get('/biddings', 'CustomerController@showBiddings');
Route::get('/biddings/startNewBidding', 'CustomerController@showStartNewBidding');
Route::post('/savebidding', 'CustomerController@savebidding');
Route::get('/getCategory/{genderCategory}', 'CustomerController@getCategory'); //also used in boutique's side
Route::get('/view-bidding/{biddingID}', 'CustomerController@viewBidding');
// Route::get('/view-bidder/{biddingID}', 'CustomerController@viewBidder');
Route::get('/myBiddings', 'CustomerController@myBiddings');
// Route::get('/acceptBid/{bidID}', 'CustomerController@acceptBid');
Route::get('/reviewBidding/{bidID}', 'CustomerController@reviewBidding');
Route::get('/bidding/inputAddress/{bidID}', 'CustomerController@inputAddressforBiding');
Route::post('/makeOrderforBidding', 'CustomerController@makeOrderforBidding');
Route::get('/view-bidding-order/{biddingID}', 'CustomerController@viewBiddingOrder');


//NOTIFICATIONS
Route::get('/user-notifications', 'CustomerController@notifications');
Route::get('/user-notifications/{notificationID}', 'CustomerController@viewNotification');



//BOUTIQUE PROFILE
Route::get('/boutique/{boutiqueID}', 'CustomerController@viewBoutique');


//MADE-TO-ORDER
Route::get('{boutiqueID}/made-to-order', 'CustomerController@madeToOrder');
Route::post('/saveMadeToOrder', 'CustomerController@saveMadeToOrder');
Route::get('/getFabricColor/{type}', 'CustomerController@getFabricColor');
// Route::post('/acceptOffer', 'CustomerController@acceptOffer');
Route::post('/makeOrderforMTO', 'CustomerController@makeOrderforMTO');
// Route::get('/receiveMto/{orderID}', 'CustomerController@receiveMto');
Route::get('/inputAddress/{mtoID}/{type}', 'CustomerController@inputAddress');
Route::get('/cancelMto/{mtoID}', 'CustomerController@cancelMto');


//TRANSACTIONS
Route::get('/user-account', 'CustomerController@useraccount');
Route::get('/user-transactions', 'CustomerController@usertransactions');
Route::get('/view-order/{orderID}', 'CustomerController@viewOrder');
Route::get('/view-rent/{rentID}', 'CustomerController@viewRent');
Route::get('/view-mto/{mtoID}', 'CustomerController@viewMto');

//PAYPAL TRANSACTION
Route::post('/paypal-transaction-complete', 'CustomerController@paypalpaypalTransactionComplete');
// Route::get('/get-paypal-transaction/{orderId}', 'CustomerController@getPaypalOrder');


//MIX&MATCH
Route::get('/{boutiqueID}/mixnmatch', 'CustomerController@mixnmatch');
Route::get('/getMProduct/{productID}', 'CustomerController@getMProduct');
Route::post('/submitMixnmatch', 'CustomerController@submitMixnmatch');
Route::get('/addmnmtoCart/{top}/{bottom}', 'CustomerController@addmnmtoCart');







// COURIER -------------------------------------------------------------------------------------------------------

Route::get('/ionic-dashboard', 'CourierController@dashboard');
Route::get('/ionic-topickup', 'CourierController@topickup');
Route::get('/ionic-todeliver', 'CourierController@todeliver');
Route::get('/ionic-delivered', 'CourierController@delivered');
Route::get('/ionic-completed', 'CourierController@completed');

Route::get('/ionic-viewOrder/{orderID}', 'CourierController@viewOrder');
Route::get('/ionic-pickupOrder/{orderID}', 'CourierController@pickupOrder');
Route::get('/ionic-deliveredOrder/{orderID}', 'CourierController@deliveredOrder');



});


