<?php

use App\Http\Controllers\SectorController;
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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin',  'middleware' => 'verified'], function()
{
    //All the routes that belongs to the group goes here
   // Route::get('dashboard', function() {} );
   Route::resource('sectors','SectorController');
   Route::get('sectors/delete/{id}', 'SectorController@delete');
   
   Route::resource('roles','RoleController');
   Route::get('roles/delete/{id}', 'RoleController@delete');
});
