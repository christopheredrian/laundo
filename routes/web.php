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

Route::get('/home', 'HomeController@index')->name('home');

// Routes for authenticated users (Super Admin, Admins, Managers, Employees & Customers)
Route::group(['middleware' => ['auth']], function () {
    // Routes for all
    Route::get('/home', function () {
        return view('userHome');
    });

    Route::get('/all', function () {
        return dd("all");
    });

    // Routes for Admin only
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/admin', function () {
            return dd("admin");
        });
    });


    // Routes for Business Owner only
    Route::group(['middleware' => ['business_owner']], function () {
        Route::get('/businessOwner', function () {
            return dd("business_owner");
        });
    });


    // Routes for Employees only
    Route::group(['middleware' => ['employee']], function () {
        Route::get('/employee', function () {
            return dd("employee");
        });
    });


    // Routes for Customers only
    Route::group(['middleware' => ['customer']], function () {
        Route::get('/customer', function () {
            return dd("customer");
        });
    });

});