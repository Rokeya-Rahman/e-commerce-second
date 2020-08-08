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



Route::group(['middleware' => 'admin'], function () {

    Route::get('/setting/account-setting', [
        'uses'  =>  'AdminController@accountSetting',
        'as'    =>  'account-setting'
    ]);

    Route::get('/setting/edit-password', [
        'uses'  =>  'AdminController@editPassword',
        'as'    =>  'edit-password'
    ]);

    Route::post('/setting/change-password', [
        'uses'  =>  'AdminController@changePassword',
        'as'    =>  'change-password'
    ]);

    Route::post('/setting/new-password', [
        'uses'  =>  'AdminController@newPassword',
        'as'    =>  'new-password'
    ]);

});


Route::group(['middleware' => 'category'], function () {

    Route::get('/category/add-category', [
        'uses'  =>  'CategoryController@addCategory',
        'as'    =>  'add-category'
    ]);

    Route::post('/category/save-category', [
        'uses'  =>  'CategoryController@saveCategory',
        'as'    =>  'save-category'
    ]);

    Route::get('/category/manage-category', [
        'uses'  =>  'CategoryController@manageCategory',
        'as'    =>  'manage-category'
    ]);

    Route::get('/category/category-details/{id}', [
        'uses'  =>  'CategoryController@categoryDetails',
        'as'    =>  'category-details'
    ]);

    Route::post('/category/unpublished-category', [
        'uses'  =>  'CategoryController@unpublishedCategory',
        'as'    =>  'unpublished-category'
    ]);

    Route::post('/category/published-category', [
        'uses'  =>  'CategoryController@publishedCategory',
        'as'    =>  'published-category'
    ]);

    Route::get('/category/edit-category/{id}', [
        'uses'  =>  'CategoryController@editCategory',
        'as'    =>  'edit-category'
    ]);

    Route::post('/category/update-category', [
        'uses'  =>  'CategoryController@updateCategory',
        'as'    =>  'update-category'
    ]);

    Route::post('/category/delete-category', [
        'uses'  =>  'CategoryController@deleteCategory',
        'as'    =>  'delete-category'
    ]);

});

Route::group(['middleware' => 'brand'], function () {

    Route::get('/brand/add-brand', [
        'uses'  =>  'BrandController@addBrand',
        'as'    =>  'add-brand'
    ]);

    Route::post('/brand/save-brand', [
        'uses'  =>  'BrandController@saveBrand',
        'as'    =>  'save-brand'
    ]);

    Route::get('/brand/manage-brand', [
        'uses'  =>  'BrandController@manageBrand',
        'as'    =>  'manage-brand'
    ]);

    Route::get('/brand/brand-details/{id}', [
        'uses'  =>  'BrandController@brandDetails',
        'as'    =>  'brand-details'
    ]);

    Route::post('/brand/unpublished-brand', [
        'uses'  =>  'BrandController@unpublishedBrand',
        'as'    =>  'unpublished-brand'
    ]);

    Route::post('/brand/published-brand', [
        'uses'  =>  'BrandController@publishedBrand',
        'as'    =>  'published-brand'
    ]);

    Route::get('/brand/edit-brand/{id}', [
        'uses'  =>  'BrandController@editBrand',
        'as'    =>  'edit-brand'
    ]);

    Route::post('/brand/update-brand', [
        'uses'  =>  'BrandController@updateBrand',
        'as'    =>  'update-brand'
    ]);

    Route::post('/brand/delete-brand', [
        'uses'  =>  'BrandController@deleteBrand',
        'as'    =>  'delete-brand'
    ]);

});

Route::group(['middleware' => 'product'], function () {

    Route::get('/product/add-product', [
        'uses'  =>  'ProductController@addProduct',
        'as'    =>  'add-product'
    ]);

    Route::post('/product/save-product', [
        'uses'  =>  'ProductController@saveProduct',
        'as'    =>  'save-product'
    ]);

    Route::get('/product/get-category-brand-name/{categoryId}/{brandId}', [
        'uses'  =>  'ProductController@getCategoryBrandName',
        'as'    =>  'get-category-name'
    ]);

    Route::get('/product/manage-product', [
        'uses'  =>  'ProductController@manageProduct',
        'as'    =>  'manage-product'
    ]);

    Route::get('/product/product-details/{id}', [
        'uses'  =>  'ProductController@productDetails',
        'as'    =>  'product-details'
    ]);

    Route::post('/product/unpublished-product', [
        'uses'  =>  'ProductController@unpublishedProduct',
        'as'    =>  'unpublished-product'
    ]);

    Route::post('/product/published-product', [
        'uses'  =>  'ProductController@publishedProduct',
        'as'    =>  'published-product'
    ]);

    Route::get('/product/edit-product/{id}', [
        'uses'  =>  'ProductController@editProduct',
        'as'    =>  'edit-product'
    ]);

    Route::post('/product/update-product', [
        'uses'  =>  'ProductController@updateProduct',
        'as'    =>  'update-product'
    ]);

    Route::get('/product/edit-category-brand-name/{editProductId}/{editCategoryId}/{editBrandId}', [
        'uses'  =>  'ProductController@editCategoryBrandName',
        'as'    =>  'edit-category-name'
    ]);

    Route::post('/product/delete-product', [
        'uses'  =>  'ProductController@deleteProduct',
        'as'    =>  'delete-product'
    ]);

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
