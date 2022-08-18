<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ResturantsController;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\LogoutController;














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

Route::get('/admin', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('cities', CitiesController::class);
Route::resource('regions', RegionsController::class);
Route::resource('categories',CategoriesController::class);
Route::resource('clients',ClientsController::class);
Route::resource('contacts',ContactsController::class);
Route::resource('settings',SettingsController::class);
Route::resource('offers',OffersController::class);
Route::resource('comments',CommentsController::class);
Route::resource('resturants',ResturantsController::class);
Route::resource('meals',MealsController::class);
Route::resource('orders',OrdersController::class);
Route::resource('users',UsersController::class);
Route::resource('admins',AdminController::class);





Route::post('/update-settings/{id}', [App\Http\Controllers\SettingsController::class,'update'])->name('update-settings');

Route::get('/search', [App\Http\Controllers\ContactsController::class,'search'])->name('search');
Route::get('/edit/{id}', [App\Http\Controllers\ResturantsController::class,'edit'])->name('edit');
Route::post('/update/{id}', [App\Http\Controllers\ResturantsController::class,'update'])->name('update');

Route::get('/edit-meal/{id}', [App\Http\Controllers\MealsController::class,'edit'])->name('edit');
Route::post('/update-meal/{id}', [App\Http\Controllers\MealsController::class,'update'])->name('update-meal');
Route::get('/edit-password/{id}', [App\Http\Controllers\AdminController::class,'edit'])->name('edit-password');




    Route::group(['middleware' => ['auth', 'permission']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', [App\Http\Controllers\LogoutController::class,'perform'])->name('logout');

        /**
         * User Routes
         */
        Route::group(['prefix' => 'users'], function() {
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');
            Route::post('/create', 'UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'UsersController@show')->name('users.show');
            Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
            Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
            Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
        });

        
        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);
    });




