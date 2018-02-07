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
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'IndexController@index')->name('home_admin');
    Route::post('login', 'IndexController@login')->name('admin_login');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/top', 'IndexController@top')->name('admin_top');
    Route::get('/tao-danh-muc-san-pham', 'ProductsController@registerCategoryProduct')->name('register_category_product');
    Route::post('/save-danh-muc-san-pham', 'ProductsController@saveCategoryProduct')->name('save_category_product');
    Route::get('/xoa-danh-muc-san-pham/{id}', 'ProductsController@deleteCategoryProduct')->name('delete_category_product');
    Route::get('/sua-danh-muc-san-pham/{id}', 'ProductsController@showEditCategoryProduct')->name('show_edit_category_product');
    Route::post('/sua-danh-muc-san-pham', 'ProductsController@editCategoryProduct')->name('edit_category_product');

    // Tao-San-Pham
    Route::get('/tao-san-pham', 'ProductsController@registerProduct')->name('register_product');
    Route::get('/danh-sach-san-pham', 'ProductsController@listProduct')->name('list_product');
    Route::post('/luu-san-pham', 'ProductsController@saveProduct')->name('save_register_product');
    Route::get('/xoa-san-pham/{id}', 'ProductsController@deleteProduct')->name('delete_product');
    Route::get('/sua-san-pham/{id}', 'ProductsController@showEditProduct')->name('show_edit_product');
    Route::post('/sua-san-pham', 'ProductsController@editProduct')->name('edit_product');

    Route::get('/logout', 'IndexController@logout')->name('admin_logout');
});