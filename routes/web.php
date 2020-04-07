<?php

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

Route::post('/test', function () {
    return request();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/main', 'MainController');
Route::resource('/multi_checkbox', 'MultiCheckboxController');
Route::resource('/dependable_dropdown', 'DependableDropdownController');

Route::post('/form/multi_checkbox/export', 'MultiCheckboxController@export')->name('multi_checkbox.export');

Route::post('/dependable_dropdown/attributes', 'DependableDropdownController@attributes')->name('dependable_dropdown.attributes');

Auth::routes();

