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

Route::get('qr-code', function () {
    return QrCode::size(500)->generate('Welcome');
});

//IONIC QR ROUTE
Route::get('/ionic-getqr/{data}', 'IonicController@getqr');

// $this->get('register-boutique', 'Auth\RegisterController@showBoutiqueRegistrationForm')->name('registerseller');
// $this->post('register-boutique', 'Auth\RegisterController@register');


Auth::routes();
// Route::get('/home', 'CustomerController@index');


//SHOP
Route::get('/shop', 'CustomerController@shop');
Route::get('/tally', 'CustomerController@tally');
Route::get('/index', 'CustomerController@index');
Route::get('/shop/{gender}', 'CustomerController@shopViaGender');
Route::get('/shop/{gender}/{category}', 'CustomerController@shopViaCategory');
Route::get('/single-product-details/{productID}', 'CustomerController@productDetails');
Route::get('/set-single-product-details/{setID}', 'CustomerController@setDetails');
Route::get('/search', 'CustomerController@search');


Route::view('/autocomplete', 'hinimo.autocomplete');
Route::view('/googleapi', 'hinimo.addressexample');
Route::view('/mixnmatch-old', 'hinimo.mixnmatch-old');


Route::middleware(['auth'])->group(function(){

//ADMIN--------------------------------------------------------------------------------------------
	Route::get('/admin-dashboard', 'AdminController@dashboard');
	Route::get('/admin-sales', 'AdminController@sales');
	Route::get('/admin-orders', 'AdminController@orders');
	Route::get('/admin-orders/{orderID}', 'AdminController@getOrder');
	Route::get('/admin-archives', 'AdminController@archives');
	Route::get('/admin-archives/{orderID}', 'AdminController@getArchives');
	Route::get('/admin-forpickups', 'AdminController@forpickups');
	Route::get('/admin-forpickups/{orderID}', 'AdminController@getForpickups');
	// Route::get('/admin-made-to-orders', 'AdminController@madeToOrders');
	// Route::get('/admin-rents', 'AdminController@rents');


	Route::post('/editPercentage', 'AdminController@editPercentage');


	Route::get('/admin-deliveryfee', 'AdminController@deliveryfee');
	Route::post('/admin-savedeliveryfee', 'AdminController@savedeliveryfee');
	Route::post('/admin-updatedeliveryfee', 'AdminController@updatedeliveryfee');


	Route::get('/admin-addAccount', 'AdminController@addAccount');
	Route::post('/admin-saveAccount', 'AdminController@saveAccount');
	Route::get('/view-courier/{courierID}', 'AdminController@viewCourier');
	// Route::get('/editPriorityNumber/{courierID}', 'AdminController@editPriorityNumber'); //wa nni gamit na
	Route::get('/deactivate-courier/{courierID}', 'AdminController@deactivateCourier');
	Route::get('/activate-courier/{courierID}', 'AdminController@activateCourier');


	Route::get('/admin-tags', 'AdminController@tags');
	Route::post('/addTag', 'AdminController@addTag');
	Route::get('/deleteTag/{tagID}', 'AdminController@deleteTag');


	Route::get('/admin-categories', 'AdminController@categories');
	Route::post('/saveCategory', 'AdminController@saveCategory');
	Route::post('/saveSubCategory', 'AdminController@saveSubCategory');
	Route::post('/declineCategory', 'AdminController@declineCategory');


	Route::get('/admin-locations', 'AdminController@locations');
	Route::get('/admin-getProvince/{regCode}', 'AdminController@getProvince');
	Route::get('/admin-getCity/{provCode}', 'AdminController@getCity');
	Route::get('/admin-getBrgy/{citymunCode}', 'AdminController@getBrgy');
	Route::post('/addLocation', 'AdminController@addLocation');
	Route::get('/deleteLocation/{cityID}', 'AdminController@deleteLocation');

	Route::get('/categories-notifications/{notificationID}', 'AdminController@viewNotifications');

	Route::get('/admin-measurements', 'AdminController@measurements');
	Route::post('/admin-addMeasurement', 'AdminController@addMeasurement');


	Route::get('/admin-payouts', 'AdminController@payouts');
	Route::get('/savePayout/{orderID}/{batchID}', 'AdminController@savePayout');
	Route::get('/requestPaypalAccount/{orderID}', 'AdminController@requestPaypalAccount');
	Route::get('/view-payout/{orderID}', 'AdminController@viewPayout');

	Route::get('/askPayPalEmail/{orderID}', 'AdminController@askPayPalEmail');
	Route::get('/refundCustomer/{orderID}', 'AdminController@refundCustomer');
	Route::get('/refuseRefund/{orderID}', 'AdminController@refuseRefund');


	Route::get('/admin-events', 'AdminController@getEvents');
	Route::post('/admin-saveEvent', 'AdminController@saveEvent');
	Route::get('/admin-viewEvent/{eventName}', 'AdminController@viewEvent');


	// COMPLAINTS
	Route::get('/complaints', 'AdminController@complaints');
	Route::get('/viewComplaint/{complainID}', 'AdminController@viewComplaint');
	Route::get('/getComplaint/{complainID}', 'AdminController@getComplaint');


	Route::get('/chat-w-boutiques', 'AdminController@chatswBoutique');
	Route::get('/chat-w-boutique/{boutiqueID}', 'AdminController@chatwBoutique');
	Route::post('/chatBoutique', 'AdminController@chatBoutique');


	// Route::get('/mailbox', 'AdminController@mailbox');
	// Route::get('/compose', 'AdminController@compose');
	// Route::post('/sendCompose', 'AdminController@sendCompose');



//BOUTIQUE----------------------------------------------------------------------------------------


	Route::get('/boutique-profile', 'BoutiqueController@boutiqueProfile');
	Route::get('/reqToActivateAccount', 'BoutiqueController@reqToActivateAccount');
	Route::post('/reqToVerify', 'BoutiqueController@reqToVerify');
	Route::get('/get-paypal-transaction/{orderId}', 'BoutiqueController@getPaypalOrder');

	Route::get('/dashboard', 'BoutiqueController@dashboard');
	Route::get('/categories', 'BoutiqueController@categories');
	Route::post('/requestCategory', 'BoutiqueController@requestCategory');


	//QUESTIONABLE ROUTES
	// Route::get('/tags', 'BoutiqueController@tags');
	Route::get('/fabrics', 'BoutiqueController@fabrics');
	Route::post('/addFabric', 'BoutiqueController@addFabric');
	Route::get('/deleteFabric/{fabricID}', 'BoutiqueController@deleteFabric');


	//LOCATIONS
	Route::get('/boutique-getProvince/{regCode}', 'BoutiqueController@getProvince');
	Route::get('/boutique-getCity/{provCode}', 'BoutiqueController@getCity');
	Route::get('/boutique-getBrgy/{citymunCode}', 'BoutiqueController@getBrgy');


	//crud product
	Route::get('/products', 'BoutiqueController@showProducts');
	Route::get('/addproduct', 'BoutiqueController@addProduct');
	Route::post('/saveproduct', 'BoutiqueController@saveProduct');
	Route::get('/viewproduct/{productID}', 'BoutiqueController@viewProduct');
	Route::get('/editView/{productID}', 'BoutiqueController@editView');
	Route::post('/editproduct/{productID}', 'BoutiqueController@editProduct');
	Route::get('/delete/{productID}', 'BoutiqueController@delete');
	Route::get('/deleteSet/{setID}', 'BoutiqueController@deleteSet');


	//view products
	// Route::get('/products/womens', 'BoutiqueController@getwomens');
	// Route::get('/products/mens', 'BoutiqueController@getmens');
	// Route::get('/products/embellishments', 'BoutiqueController@getembellishments');
	// Route::get('/products/customizable', 'BoutiqueController@getcustomizables');
	// Route::get('/getGender/{gender}', 'BoutiqueController@getGender');


	//SETS
	Route::get('/sets', 'BoutiqueController@showSets');
	Route::get('/addset', 'BoutiqueController@addset');
	Route::post('/saveset', 'BoutiqueController@saveset');
	Route::get('/viewset/{setID}', 'BoutiqueController@viewSet');
	Route::get('/editViewSet/{setID}', 'BoutiqueController@editViewSet');
	Route::post('/editSet', 'BoutiqueController@editSet');

	Route::get('/getProductsforSet/{categoryID}/{subcategoryID}', 'BoutiqueController@getProductsforSet'); //get productsss
	Route::get('/getProductforSet/{productID}', 'BoutiqueController@getProductforSet'); //get single product details


	//TRANSACTIONS-RENT
	Route::get('/rents', 'BoutiqueController@rents');
	Route::get('/rents/{rentID}', 'BoutiqueController@getRentInfo');
	Route::get('/approveRent/{rentID}', 'BoutiqueController@approveRent');
	// Route::post('/approveRent', 'BoutiqueController@approveRent');
	Route::post('/declineRent', 'BoutiqueController@declineRent');
	// Route::post('/updateRentInfo', 'BoutiqueController@updateRentInfo');
	// Route::post('/makeOrderforRent', 'BoutiqueController@makeOrderforRent');
	Route::get('/rentReturned/{rentID}', 'BoutiqueController@rentReturned');



	//NOTIFICATIONS
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
	Route::get('/updateAlteration/{alterationID}/{value}', 'BoutiqueController@updateAlteration');


	//TRANSACTIONS-BIDDINGS
	Route::post('/submitBid', 'BoutiqueController@submitBid');
	Route::post('/updateBid', 'BoutiqueController@updateBid');
	Route::get('/boutique-view-biddings', 'BoutiqueController@biddings');
	Route::get('/boutique-view-bidding/{biddingID}', 'BoutiqueController@viewBidding');
	Route::get('/boutique-biddings', 'BoutiqueController@boutiqueBiddings');
	Route::get('/boutique-bidding/{biddingID}', 'BoutiqueController@viewBoutiqueBidding');

	Route::get('/boutique-bids', 'BoutiqueController@bids');

	Route::post('/requestMeasurement', 'BoutiqueController@requestMeasurement');


	//ARCHIVES
	Route::get('/archive-orders', 'BoutiqueController@archiveOrders');
	Route::get('/archive-rents', 'BoutiqueController@archiveRents');
	Route::get('/archive-made-to-orders', 'BoutiqueController@archiveMtos');
	Route::get('/archive-boutique-biddings', 'BoutiqueController@archiveBiddings');


	Route::get('/paypal-account', 'BoutiqueController@paypalAccount');
	Route::post('/updatePaypalAccount', 'BoutiqueController@updatePaypalAccount');
	Route::post('/addPaypalAccount', 'BoutiqueController@addPaypalAccount');


	Route::get('/getCategoryTags/{categoryID}', 'BoutiqueController@getCategoryTags');


	// Route::get('/boutique-mailbox', 'BoutiqueController@mailbox');
	// Route::get('/boutique-readmail/{emailID}', 'BoutiqueController@readmail');


	//SEND CHAT TO CUSTOMERS
	Route::post('/bSendChat', 'BoutiqueController@bSendChat');

	//SEND CHAT TO ADMIN
	Route::get('/chat-w-admin', 'BoutiqueController@chatwAdmin');
	Route::post('/chatAdmin', 'BoutiqueController@chatAdmin');

	//FILE FOR DISPUTE
	Route::post('/fileforDispute', 'BoutiqueController@fileforDispute');



	Route::get('/getSubcategory/{categoryID}', 'BoutiqueController@getSubcategory');


//CUSTOMER--------------------------------------------------------------------------------------------
	Route::post('/cSendChat', 'CustomerController@cSendChat');
	
	Route::post('/submitPaypalEmail', 'CustomerController@submitPaypalEmail');

	Route::get('/shopReco', 'CustomerController@shopReco');

	Route::get('/get-started/welcome', 'CustomerController@welcome');
	Route::get('/get-started', 'CustomerController@getStarted');
	Route::post('/user-profiling', 'CustomerController@profiling');
	Route::get('/user-profiling/done', 'CustomerController@profilingDone');


	Route::get('/sortBy/{condition}', 'CustomerController@sortBy');
	Route::get('/getProducts/{condition}', 'CustomerController@getProducts'); //wala gamit??

	Route::get('/getMeasurements/{categoryID}', 'CustomerController@getMeasurements');

	//PROFILE
	Route::get('/user-account', 'CustomerController@useraccount');
	Route::post('/editProfile', 'CustomerController@editProfile');


	//REQUEST FOR RENT
	Route::get('/requestToRent/{productID}', 'CustomerController@submitRequestToRent');
	Route::post('/requestToRent', 'CustomerController@requestToRent');
	Route::get('/receiveRent/{rentID}', 'CustomerController@receiveRent');
	// Route::get('/getRentDates/{productID}', 'CustomerController@getRentDates');

	Route::get('/requestToRentSet/{setID}', 'CustomerController@submitRequestToRentSet');
	Route::post('/requestToRentSet', 'CustomerController@requestToRentSet');

	//ORDER
	Route::post('/placeOrder', 'CustomerController@placeOrder');
	Route::get('/receiveOrder/{orderID}', 'CustomerController@receiveOrder');



	//CART
	Route::get('/addSettoCart/{productID}', 'CustomerController@addSettoCart');
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
	Route::get('/deleteAddress/{addressID}', 'CustomerController@deleteAddress');
	Route::get('/editAddress/{addressID}', 'CustomerController@editAddress');


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
	Route::post('/submitMeasurementforBidding', 'CustomerController@submitMeasurementforBidding');


	//NOTIFICATIONS
	Route::get('/user-notifications', 'CustomerController@notifications');
	Route::get('/user-notifications/{notificationID}', 'CustomerController@viewNotification');


	//BOUTIQUE PROFILE
	Route::get('/boutique/{boutiqueID}', 'CustomerController@viewBoutique');


	//MADE-TO-ORDER
	Route::get('{boutiqueID}/made-to-order', 'CustomerController@madeToOrder');
	Route::post('/saveMadeToOrder', 'CustomerController@saveMadeToOrder');
	Route::get('/getFabricColor/{boutiqueID}/{type}', 'CustomerController@getFabricColor');
	// Route::post('/acceptOffer', 'CustomerController@acceptOffer');
	Route::post('/makeOrderforMTO', 'CustomerController@makeOrderforMTO');
	// Route::get('/receiveMto/{orderID}', 'CustomerController@receiveMto');
	Route::get('/inputAddress/{mtoID}/{type}', 'CustomerController@inputAddress');
	Route::get('/cancelMto/{mtoID}', 'CustomerController@cancelMto');
	Route::post('/submitMeasurementforMto', 'CustomerController@submitMeasurementforMto');

	//TRANSACTIONS
	Route::get('/user-transactions', 'CustomerController@usertransactions');
	Route::get('/view-order/{orderID}', 'CustomerController@viewOrder');
	Route::get('/view-rent/{rentID}', 'CustomerController@viewRent');
	Route::get('/view-mto/{mtoID}', 'CustomerController@viewMto');
	Route::post('/fileComplain', 'CustomerController@fileComplain');
	// Route::post('/fileComplainforBidding', 'CustomerController@fileComplainforBidding');
	// Route::post('/fileComplainforBidding', 'CustomerController@fileComplainforBidding');


	//PAYPAL TRANSACTION
	Route::post('/paypal-transaction-complete', 'CustomerController@paypalTransactionComplete');
	// Route::get('/get-paypal-transaction/{orderId}', 'CustomerController@getPaypalOrder');

	//EVENTS
	// Route::get('/{boutiqueID}/mixnmatch', 'CustomerController@mixnmatch');
	Route::get('events', 'CustomerController@mixnmatch');
	Route::get('/getMProduct/{productID}', 'CustomerController@getMProduct');
	Route::post('/submitMixnmatch', 'CustomerController@submitMixnmatch');
	Route::get('/addmnmtoCart/{top}/{bottom}', 'CustomerController@addmnmtoCart');

	Route::get('/getEventTags/{eventName}', 'CustomerController@getEventTags');


	Route::get('/gallery', 'CustomerController@gallery');

	Route::get('/favorites', 'CustomerController@favorites');
	Route::get('/addToFavorites/{productID}', 'CustomerController@addToFavorites');
	Route::get('/addSetToFavorites/{setID}', 'CustomerController@addSetToFavorites');

	Route::get('/unFavoriteProduct/{productID}', 'CustomerController@unFavoriteProduct');
	Route::get('/unFavoriteSet/{productID}', 'CustomerController@unFavoriteSet');




// COURIER -------------------------------------------------------------------------------------------------------

Route::get('/ionic-dashboard', 'CourierController@dashboard');
Route::get('/ionic-topickup', 'CourierController@topickup');
Route::get('/ionic-todeliver', 'CourierController@todeliver');
Route::get('/ionic-delivered', 'CourierController@delivered');
Route::get('/ionic-completed', 'CourierController@completed');

Route::get('/ionic-viewOrder/{orderID}', 'CourierController@viewOrder');
Route::get('/ionic-pickupOrder/{orderID}', 'CourierController@pickupOrder');
Route::get('/ionic-deliveredOrder/{orderID}', 'CourierController@deliveredOrder');

Route::get('/courier-notifications/{notificationID}', 'CourierController@viewNotifications');


});


