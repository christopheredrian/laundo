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

    // Routes for Super Admin only
    Route::group(['middleware' => ['superadmin']], function () {
        Route::get('/superAdmin', function () {
            return dd("superadmin");
        });
    });


    // Routes for Admins only (and Super Admin)
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/superAdminAndAdmins', function () {
            return dd("superAdminAndAdmins");
        });
    });


    // Routes for Managers only (also for Super Admin and Admins)
    Route::group(['middleware' => ['manager']], function () {
        Route::get('/superAdminAdminsAndManagers', function () {
            return dd("superAdminAdminsAndManagers");
        });
    });


    // Routes for Employees only (also for  Super Admin, Admins and Managers)
    Route::group(['middleware' => ['employee']], function () {
        Route::get('/superAdminAdminsManagersAndEmployees', function () {
            return dd("superAdminAdminsManagersAndEmployees");
        });
    });


    // Routes for Customers only (also for  Super Admin, Admins and Managers)
    Route::group(['middleware' => ['customer']], function () {
        Route::get('/superAdminAdminsManagersAndCustomers', function () {
            return dd("superAdminAdminsManagersAndCustomers");
        });
    });

});