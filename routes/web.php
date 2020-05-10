<?php

use App\Complaint;
use Illuminate\Support\Facades\Route;

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



Route::post('/complaint', 'ComplaintController@store');
Route::get('/complaint','ComplaintController@create');



Route::post('/complaint/resolve', 'ComplaintController@resolve');

Route::post('/complaint/reason', 'ComplaintController@reason');





Route::get('/home/table','ComplaintController@showComplaints');
Route::post('/home/table','ComplaintController@sortComplaints');




Route::get('redirect/{driver}', 'Auth\LoginController@redirectToProvider')
    ->name('login.provider')
    ->where('driver', implode('|', config('auth.socialite.drivers')));
Route::get('{driver}/callback', 'Auth\LoginController@handleProviderCallback')
    ->name('login.callback')
    ->where('driver', implode('|', config('auth.socialite.drivers')));

