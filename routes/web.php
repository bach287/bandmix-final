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
//events
//Route::resource('/events','EventsController');
Route::resource('/feedback','FeedbackController');
Route::get('/', 'HomePageController@index');
Route::get('/search', 'HomePageController@search')->name('masterSearching');;


Route::group(['middleware' => 'auth'], function() {
    Route::get('/events/create', 'EventsController@create')->name('events.create');
    Route::get('/bands/management', 'BandsController@management')->name('bands.manage');

    Route::post('/bands', 'BandsController@store')->name('bands.store');
    Route::get('/bands/create', 'BandsController@create')->name('bands.create');
//    Route::delete('/bands/{id}','BandsController@destroy')->name('bands.destroy');
    Route::get('/bands/delete/{id}', 'BandsController@deleteBand')->name('bands.delete');
    //cart
    Route::get('/cart', 'CartsController@index')->name('cart.show');
    Route::post('/cart', 'CartsController@store')->name('cart.store');
    Route::get('/cart/{id}', 'CartsController@destroy')->name('cart.destroy');
    Route::get('empty', 'CartsController@empty')->name('cart.empty');
    Route::post('/checkout','CartsController@getCheckout')->name('cart.checkout');
    //band
    Route::get('/bands/edit/{id}', 'BandsController@edit')->name('bands.edit');
    Route::post('/bands/{id}', 'BandsController@update')->name('bands.update');
//event
    Route::post('events', 'EventsController@store')->name('events.store');
    Route::get('/events/delete/{id}', 'EventsController@deleteEvent')->name('events.delete');
//    Route::DELETE('event/{event}','EventsController@destroy')->name('events.destroy');
    Route::get('events/{id}/review', 'EventsController@review')->name('events.review');
    Route::post('events/confirm', 'EventsController@confirm')->name('events.confirm');
    //user
    Route::get('/user/edit/{id}','MembersController@edit')->name('members.edit');
    Route::get('/user/{id}/notifications','MembersController@notiView')->name('member.noti');
    Route::get('/bands/{id}/contact','BandsController@contact')->name('bands.contact');
});
//event
Route::get('events','EventsController@index')->name('events.index');
Route::get('events/{id}/contact','EventsController@contact')->name('events.contact');

//events
Route::get('/event/manage','EventsController@manage')->name('events.manage');
Route::get('/events/{id}','EventsController@show')->name('events.show');
Route::get('/events/{id}/edit','EventsController@edit')->name('events.edit');
//Route::get('/events/{id}/delete','EventsController@deleteEvent')->name('events.delete');
Route::get('/', 'HomePageController@index')->name('homepage');
//band
Route::get('/bands','BandsController@index')->name('bands.index');
Route::get('/bands/{slug}','BandsController@show')->name('bands.show');

//news
Route::get('/news','NewsController@index')->name('news.index');
Route::get('/news/{id}','NewsController@show')->name('news.show');

//search
Route::get('/myBook/{id}','MembersController@manageBooks')->name('members.manageBook');
Route::get('user/getDataBook','MembersController@getDataBook')->name('members.dataBook');
Route::get('user/getData','MembersController@getData')->name('members.data');
Route::get('/user/{id}','MembersController@show')->name('members.index');
Route::Post('/user/{id}','MembersController@update')->name('members.update');
Route::get('/myBill/{id}','MembersController@manageBill')->name('members.manageBill');


 Route::get('/About_us','AboutUsController@index')->name('about.index');

//login
Auth::routes();
Route::Post('/','Auth\LoginController@login')->name('login');
Route::get('/login','HomePageController@index');

// Route reg 
Route::post('/authen','Auth\LoginController@authen')->name('authen');
Route::post('/sign-in','Auth\RegisterController@sign_In')->name('sign-in');
Route::post('/check-exit-email','Auth\RegisterController@check_Exist_User')->name('check-exit-email');

Route::post('/change-pass','Auth\RegisterController@change_Pass')->name('change-pass');
Route::post('/reset-pass','Auth\RegisterController@reset_Pass')->name('reset-pass');

