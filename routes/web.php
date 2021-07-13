<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControllers\AdminController;
use App\Http\Controllers\AdminControllers\categoryController;
use App\Http\Controllers\AdminControllers\ProductController;
use App\Models\Category;
use App\Http\Controllers\AdminControllers\BrandController;
use App\Http\Controllers\AdminControllers\CustomerController;

use App\Http\Controllers\AdminControllers\HomeBannerController;
use App\Http\Controllers\AdminControllers\OrderController;
//Customer Controllers Starts
use App\Http\Controllers\Customer\Customer;
//Customer Controllers Ends

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



Route::get('/admin',[AdminController::class,'index'])->name('admin');

Route::post('/admin/auth',[AdminController::class,'auth'])->name('auth');

// Route::get('/admin/updatepassword',[AdminController::class,'updatePassword']);

Route::group(['middleware'=>'Admin_auth'],function(){
    
Route::get('admin/dashboard',[AdminController::class,'dashboard'])->name('dashboard');


//Category Routes Starts Here
Route::get('admin/category',[categoryController::class,'showCategory'])->name('category');

Route::get('admin/category/add_category',[categoryController::class,'showCategoryForm'])->name('addCategory');

Route::post('admin/category/add_category',[categoryController::class,'addCategory'])->name('addCategory');

Route::get('admin/category/edit_category/{id}',[categoryController::class,'showEditCategory'])->name('editCategory');

Route::post('admin/category/edit_category/{id}',[categoryController::class,'saveEditCategory'])->name('saveEditCategory');

Route::get('admin/category/delete/{id}',[categoryController::class,'deleteCategory']);
//Category Routes Ends Here




//Product Routes Starts Here
Route::get('admin/product',[ProductController::class,'showProduct'])->name('product');

Route::get('admin/product/add_product/{product_id}',[ProductController::class,'showProductForm'])->name('addProduct');

Route::post('admin/product/add_product/{product_id}',[ProductController::class,'addProduct'])->name('addProduct');

Route::get('admin/product/product_details/{id}',[ProductController::class,'showProductDetails'])->name('product_details');

Route::get('admin/product/edit_product/{id}',[ProductController::class,'showEditProduct'])->name('editProduct');

Route::post('admin/product/edit_product/{id}',[ProductController::class,'saveEditProduct'])->name('saveEditProduct');

Route::get('admin/product/delete/{id}',[ProductController::class,'deleteProduct']);
//Product Routes Ends Here


//Brand Routes Starts Here
Route::get('admin/brand',[BrandController::class,'showBrand'])->name('Brand');

Route::get('admin/brand/add_brand',[BrandController::class,'showBrandForm'])->name('addBrand');

Route::post('admin/brand/add_brand',[BrandController::class,'addBrand'])->name('addBrand');

Route::get('admin/brand/edit_brand/{brand_id}',[BrandController::class,'showEditBrand'])->name('editBrand');

Route::post('admin/brand/edit_brand/{brand_id}',[BrandController::class,'saveEditBrand'])->name('saveEditBrand');

Route::get('admin/brand/delete/{id}',[BrandController::class,'deleteBrand']);
//Brand Routes Ends Here

//Home Banner Routes Starts Here
Route::get('admin/banner',[HomeBannerController::class,'showBanner'])->name('Banner');

Route::get('admin/banner/add_banner',[HomeBannerController::class,'showBannerForm'])->name('addBanner');

Route::post('admin/banner/add_banner',[HomeBannerController::class,'addBanner'])->name('addBanner');

Route::get('admin/banner/edit_banner/{id}',[HomeBannerController::class,'showEditBanner'])->name('editBanner');

Route::post('admin/banner/edit_banner/{id}',[HomeBannerController::class,'saveEditBanner'])->name('saveEditBanner');

Route::get('admin/banner/delete/{id}',[HomeBannerController::class,'deleteBanner']);

//Home Banner Routes Ends Here


//Customers Routes Starts Here
Route::get('admin/customer',[CustomerController::class,'showCustomer'])->name('customer');

Route::get('admin/customer/{id}',[CustomerController::class,'showCustomerDetails'])->name('customerDetails');

Route::get('admin/customer/status/{id}',[CustomerController::class,'manageCustomerStatus'])->name('status');

//Customers Routes Ends Here

//Admin Orders Routes Starts Here
Route::get('admin/orders',[OrderController::class,'showOrder'])->name('showOrder');
Route::get('/admin/order/{orderID}',[OrderController::class,'orderDetail'])->name('orderDetail');
Route::get('/admin/updateOrder/{orderID}',[OrderController::class,'updateOrder'])->name('updateOrder');
//Admin Orders Routes Ends Here



Route::get('admin/logout',[AdminController::class,'logout'])->name('logout');
});

//Front End/Customer Routes Starts Here
Route::get('/',[Customer::class,'index']);

//Particular Product Details Rooute
Route::get('/product/{slug}',[Customer::class,'showProductDetails'])->name('productDetails');

Route::post('/product/add_to_cart',[Customer::class,'addToCart'])->name('addToCart');

Route::get('/product/cart/viewCartProduct',[Customer::class,'viewCartProduct'])->name('viewCartProduct');

Route::get('/product/cart/deleteProduct/{pid}',[Customer::class,'deleteCartProduct'])->name('deleteCartProduct');

Route::get('/category/{categorySlug}',[Customer::class,'showCategoryProduct'])->name('showCategoryProduct');

Route::get('/category/priceRange/{id}',[Customer::class,'priceRange'])->name('priceRange');

Route::post('/searchProduct/auto_suggestion',[Customer::class,'auto_suggestion_product'])->name('productAutoSuggestion');

Route::get('searchProduct',[Customer::class,'searchProduct'])->name('searchProduct');

Route::get('User/Registration',[Customer::class,'userRegistration'])->name('userRegistration');

Route::post('User/Registration',[Customer::class,'userRegistrationForm'])->name('userRegistrationForm');

Route::post('/User/Login',[Customer::class,'userLoginForm'])->name('userLoginForm');

Route::get('/User/Logout',[Customer::class,'userLogout'])->name('userLogout');

Route::get('/email_verification/{rand_id}',[Customer::class,'emailVerified']);

Route::get('/product/cart/checkout',[Customer::class,'productCheckout'])->name('productCheckout');

Route::post('/product/cart/checkout/placeOrder',[Customer::class,'placeOrder'])->name('placeOrder');

Route::get('/product/placeOrder/orderconfirmed',[Customer::class,'orderconfirmed']);

Route::group(['middleware'=>'Customer_auth'],function(){
  
    Route::get('/orders',[Customer::class,'myOrder'])->name('myOrder');
    Route::get('/orders/{orderID}',[Customer::class,'orderDetail'])->name('orderDetail');

   
});

Route::post('/forgotPassword',[Customer::class,'forgotPassword'])->name('forgotPassword');
Route::get('/forgotPasswordCode/{email}',[Customer::class,'showForgotCodeForm'])->name('showForgotCodeForm');
Route::post('/verifyforgotPasswordCode',[Customer::class,'forgotPasswordCode'])->name('forgotPasswordCode');

Route::get('/changePassword',[Customer::class,'showNewPasswordForm']);
Route::post('/changePassword',[Customer::class,'setNewPassword']);

//Front End/Customer Routes Starts Here


