<?php

use App\Http\Controllers\SectorController;
use App\Http\Controllers\LocalizationController;

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

Route::get('/home', 'HomeController@index')->name('home')->middleware('language');
Route::get('/lang/{lang}', 'LocalizationController@lang_change')->name('lang_change');

Route::group(['middleware' => ['verified','role:Administrador']], function()
{
    //All the routes that belongs to the group goes here
   // Route::get('dashboard', function() {} );

   Route::resource('sectors','SectorController');
   Route::get('sectors/delete/{id}', 'SectorController@delete');
   
   Route::resource('roles','RoleController');
   Route::get('roles/delete/{id}', 'RoleController@delete');

   Route::resource('users','UserController');
   Route::get('users/delete/{id}', 'UserController@delete');
   //Route::get('/lang/{lang}', 'LocalizationController@lang_change');

   Route::resource('langs','LangController');
   Route::post('langs/translate','LangController@translate')->name('translate');
   Route::post('langs/savetranslate','LangController@save_translate')->name('saveTranslate');
   Route::get('langs/delete/{key}','LangController@delete_translate');
   Route::post('langs/edit','LangController@edit_translate')->name('editTranslate');
   Route::post('langs/updateTranslate','LangController@update_translate')->name('updateTranslate');

   Route::resource('subscriptions','SubscriptionController');
   Route::get('subscriptions/delete/{id}', 'SubscriptionController@delete');

   Route::resource('partners','PartnerController');
   Route::get('partners/delete/{id}', 'PartnerController@delete');

   Route::resource('distributors','DistributorController');
   Route::get('distributors/delete/{id}', 'DistributorController@delete');
});
