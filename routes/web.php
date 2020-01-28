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

// use Illuminate\Routing\Route;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::group(['prefix' => 'product'], function() {
        Route::get('/', 'ProductController@index');
        Route::get('/new', 'ProductController@create');
        Route::get('/{id}', 'ProductController@edit');
    
        Route::post('/','ProductController@save');
        Route::put('/{id}','ProductController@update');
        Route::delete('/{id}','ProductController@destroy');
        
    });
    
    Route::group(['prefix' => 'customer'],function(){
        Route::get('/','CustomerController@index');
        Route::get('/new', 'CustomerController@create');
        Route::get('/{id}', 'CustomerController@edit');
    
        Route::post('/','CustomerController@save');
        Route::put('/{id}','CustomerController@update');
        Route::delete('/{id}','CustomerController@destroy');
    });
    
    Route::group(['prefix' => 'invoice'],function(){
        Route::get('/new','InvoiceController@create')->name('invoice.create');
        Route::get('/{id}','InvoiceController@edit')->name('invoice.edit');
        Route::get('/', 'InvoiceController@index')->name('invoice.index');
    
        Route::put('/{id}', 'InvoiceController@update')->name('invoice.update');
        Route::get('/{id}/delete', 'InvoiceController@deleteProduct')->name('invoice.delete_product');
        Route::delete('/{id}/delete', 'InvoiceController@destroy')->name('invoice.destroy');
        Route::post('/','InvoiceController@save')->name('invoice.store');
    });
});
Route::get('/home', 'HomeController@index')->name('home');


