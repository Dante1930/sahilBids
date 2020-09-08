<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
    Route::namespace('Auth')->group(function(){
        
        Route::get('/dashboard','LoginController@dashboard')->name('dashboard')->middleware('auth:admin');

        Route::get('/add-user','UserController@addUser')->name('add.user');
        
        //Login Routes
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login');
        Route::post('/logout','LoginController@logout')->name('logout');
    
        //Forgot Password Routes
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    
        //Reset Password Routes
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');



    
    });

        Route::get('/product', 'ProductController@index')->name('product');
        Route::get('/product/create', 'ProductController@create')->name('product.create');


        Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit');

        Route::post('/product/store', 'ProductController@store')->name('product.store');
        Route::post('/product/update/{id}', 'ProductController@update')->name('product.update');
        Route::delete('/product/delete/{id}', 'ProductController@destroy')->name('product.destroy');

        Route::get('/adminuser', 'AdminController@index')->name('adminuser');
        Route::get('/adminuser/create', 'AdminController@showRegistrationForm')->name('adminuser.create');

        Route::post('/adminuser/register', 'AdminController@register')->name('adminuser.register');
        Route::get('/adminuser/edit/{id}', 'AdminController@edit')->name('adminuser.edit');

        Route::post('/adminuser/update/{id}', 'AdminController@update')->name('adminuser.update');

                Route::delete('/adminuser/delete/{id}', 'AdminController@destroy')->name('adminuser.destroy');


});

