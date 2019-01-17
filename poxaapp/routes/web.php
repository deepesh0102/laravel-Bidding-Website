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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});
/**
 * Frontend routes
 */
Route::get('/', 'HomeController@index')->name('index');
Auth::routes();

Route::get('/newwelcome', 'HomeController@newhome')->name('newhome');
Route::get('/home', 'HomeController@home')->name('home')->middleware('auth');
Route::get('/aboutus', 'HomeController@aboutUs')->name('aboutus');
Route::get('/how-it-works', 'HomeController@howItWorks')->name('howItWorks');
Route::get('/packages', 'HomeController@packages')->name('packages');
Route::post('/payment', 'HomeController@payment')->name('payment');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('user')->namespace('user')->group(function () {


    Route::get('/home', 'UsersController@index')->name('home');


});


Route::namespace('front')->group(function () {
    Route::get("/products", 'ProductController@index')->name('front.show.products');
//    Route::get("/products/{product}", 'ProductController@show')->name('front.get.product');
    Route::get("/sold/product/{id}/{product}", 'ProductController@sold')->name('front.get.soldproduct');
    Route::get("/upcoming/product/{id}/{product}", 'ProductController@upcoming')->name('front.get.upcoming');
    Route::get('/products/{categoryId}','ProductController@getProductByCategory')->name('front.get.ProductByCategory');
    Route::get("/products/{id}/{product}", 'ProductController@show')->name('front.get.product');
    Route::post("/addBidd", 'AuctionsAjaxController@addBidd')->name('front.ajax.addBidd');
    Route::post("/showSingleProduct", 'AuctionsAjaxController@showSingleProduct')->name('front.ajax.showSingleProduct');
    Route::post("/showMultipleProduct", 'AuctionsAjaxController@showMultipleProduct')->name('front.ajax.showMultipleProduct');
    Route::post("/updatewinner", 'AuctionsAjaxController@updatewinner')->name('front.ajax.updatewinner');
});








/**
 * Admin routes
 */
Route::prefix('admin')->group(function(){

    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout','Auth\AdminLoginController@logout')->name('admin.logout');
    Route::match(['get','post'],'/updatepassword','AdminController@updatepassword')->name('admin.updatepassword');
    Route::get('/error404','AdminController@error404')->name('admin.error');


     // Password reset routes
    Route::post('/password/email','Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset','Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/reset','Auth\AdminResetPasswordController@reset');
    Route::get('password/reset/{token}','Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');



    // Categories Routes (Admin)
    Route::match(['get','post'],'/category/add-category','CategoryController@addCategory')->name('category.addcategory');
    Route::match(['get','post'],'/category/edit-category/{id}','CategoryController@editCategory')->name('category.editcategory');
    Route::match(['get','post'],'/category/delete-category/{id}','CategoryController@deleteCategory')->name('category.deletecategory');
    Route::match(['get','post'],'/category/update-status-category/{id}/{status}','CategoryController@updatestatusCategory')->name('category.updatestatuscategory');
    Route::get('/category/list-categories','CategoryController@viewCategories')->name('category.viewcategory');
    Route::get('/category/list-child-categories/{id}','CategoryController@viewChildCategories')->name('category.viewchildcategory');

    // Products Routes
    Route::match(['get','post'],'/product/add-product','ProductsController@addProduct')->name('product.addproduct');
    Route::match(['get','post'],'/product/copy-product','ProductsController@copyProduct')->name('product.copyproduct');
    Route::match(['get','post'],'/product/edit-product/{id}','ProductsController@editProduct')->name('product.editproduct');
    Route::match(['get','post'],'/product/delete-product/{id}','ProductsController@deleteProduct')->name('product.deleteproduct');
    Route::match(['get','post'],'/product/update-status-product/{id}/{status}','ProductsController@updatestatusProduct')->name('product.updatestatusproduct');
    Route::get('/product/product-listing','ProductsController@viewProducts')->name('product.viewproduct');

    //Product Image Listing
    Route::get('/product/product-image-listing/{id}','ProductImageController@index')->name('product.viewproductimage');
    Route::match(['get','post'], '/product/add-product-image/{id}','ProductImageController@store')->name('product.addproductimage');
    Route::match(['get','post'], '/product/delete-product-image/{id}','ProductImageController@destroy')->name('product.deleteproductimage');

    //Product Auction
    Route::get('/product/auction-listing/{id}', 'AuctionController@index')->name('auction.index');
    Route::match(['get','post'],'/product/add-auction/{id}', 'AuctionController@store')->name('auction.store');
    Route::match(['get','post'],'/product/edit-auction/{auction_id}', 'AuctionController@update')->name('auction.update');
    Route::match(['get','post'],'/product/delete-auction/{id}', 'AuctionController@destroy')->name('auction.destroy');
    Route::get('/auction/live-auction-listing', 'AuctionController@liveAuctions')->name('auction.live_acuction');
    Route::get('/auction/upcoming-auction-listing', 'AuctionController@upComingAuctions')->name('auction.up_coming_acuction');
    Route::get('/auction/won-auction-listing', 'AuctionController@wonAuctions')->name('auction.won_acuction');
    Route::match(['get','post'],'/auction/auction-winner/{product_id}/{auction_id}', 'AuctionController@winner')->name('auction.bidlistingByProduct');
    Route::match(['get','post'],'/auction/bid-listing', 'AuctionController@bidListing')->name('auction.bidlisting');

    //users management in admin
    Route::get('/users/autobidder-listing', 'AutoBidderController@index')->name('autobidder.index');
    Route::get('/users/add-autobidder', 'AutoBidderController@create')->name('autobidder.create');
    Route::post('/users/add-autobidder', 'AutoBidderController@store')->name('autobidder.store');
    Route::get('/users/edit-autobidder/{autobidder_id}', 'AutoBidderController@edit')->name('autobidder.edit');
    Route::post('/users/edit-autobidder/{autobidder_id}', 'AutoBidderController@update')->name('autobidder.update');
    Route::get('/users/delete-autobidder/{autobidder_id}', 'AutoBidderController@destroy')->name('autobidder.destroy');
    Route::get('/users/user-listing', 'AutoBidderController@userListing')->name('user.userlisting');
    Route::get('/users/add-user', 'AutoBidderController@createUser')->name('user.create');
    Route::post('/users/add-user', 'AutoBidderController@storeUser')->name('user.store');
    Route::get('/users/edit-user/{autobidder_id}', 'AutoBidderController@editUser')->name('user.edit');
    Route::post('/users/edit-user/{autobidder_id}', 'AutoBidderController@updateUser')->name('user.update');


    //Bidding Packages
    Route::get('/bidding/bidding-package-listing','BiddingPackageController@index')->name('bidding.index');
    Route::get('/bidding/add-bidding-package','BiddingPackageController@create')->name('bidding.create');
    Route::post('/bidding/add-bidding-package','BiddingPackageController@store')->name('bidding.store');
    Route::get('/bidding/edit-bidding-package/{bidding_package_id}', 'BiddingPackageController@edit')->name('bidding.edit');
    Route::post('/bidding/edit-bidding-package/{bidding_package_id}', 'BiddingPackageController@update')->name('bidding.update');
    Route::get('/bidding/delete-bidding-package/{bidding_package_id}', 'BiddingPackageController@destroy')->name('bidding.destroy');


});
