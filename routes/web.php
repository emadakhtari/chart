<?php

use App\Models\User;
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
//

Auth::routes(['register' => false]);
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//Route::get('profile', function () {
//})->middleware('auth');

Auth::routes();

//Users
Route::resource('users', 'UsersController');
Route::resource('users', 'UsersController');
Route::post('uploadCrop', 'UsersController@uploadCrop')->name('users.uploadCrop.ajax');

//Roles&Permissions
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');

//ChartsCategories&Charts
Route::resource('chartCategories', 'ChartCategoriesController');
Route::resource('charts', 'ChartsController');
Route::get('chart-create_import', 'ChartsController@create_import')->name('charts.create_import');
Route::post('chart-create_import', 'ChartsController@store_import')->name('charts.store_import');
Route::post('chart-delete-ChartItem', 'ChartsController@deleteChartItem')->name('deleteChartItem.chart.ajax');

//Clients
Route::resource('clients', 'ClientController');
