<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MainController;
//use App\Http\Controllers\Api\Client\MainController;
use App\Http\Controllers\Api\Client\AuthController;
use App\Http\Controllers\Api\Client\OrderController;
//use App\Http\Controllers\Api\Resturant\AuthController;
//use App\Http\Controllers\Api\Resturant\MainController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

 });
Route::group(['prefix' =>'v1','namespace' =>'Api'],function () {

    Route::group(['prefix' =>'general'],function () {
        Route::get('/categories', [App\Http\Controllers\Api\MainController::class, 'categories']);
        Route::get('/cities', [App\Http\Controllers\Api\MainController::class, 'cities']);

        Route::get('/regions', [App\Http\Controllers\Api\MainController::class, 'regions']);

        Route::get('/about-app', [App\Http\Controllers\Api\MainController::class, 'aboutApp']);

    });
    Route::group(['prefix' =>'client'],function () {

        Route::post('/client-register', [App\Http\Controllers\Api\Client\AuthController::class, 'clientRegister']);

        Route::get('/client-login', [App\Http\Controllers\Api\Client\AuthController::class, 'clientLogin']);

        Route::get('/resturants', [App\Http\Controllers\Api\Client\MainController::class, 'getResturants']);

        Route::get('/resturant-meals', [App\Http\Controllers\Api\Client\MainController::class, 'resturantMeals']);

        Route::get('/meal-details', [App\Http\Controllers\Api\Client\MainController::class, 'mealDetails']);

        Route::get('/comments', [App\Http\Controllers\Api\Client\MainController::class, 'comments']);

        Route::post('/add-comment', [App\Http\Controllers\Api\Client\MainController::class, 'addComment']);

        Route::get('/resturant-information', [App\Http\Controllers\Api\Client\MainController::class, 'resturantInformation']);

        Route::get('/offers', [App\Http\Controllers\Api\Client\MainController::class, 'offers']);
        Route::get('/all-offers', [App\Http\Controllers\Api\Client\MainController::class, 'allOffers']);

        Route::get('/new-orders', [App\Http\Controllers\Api\Client\OrderController::class, 'newOrders']);

        Route::get('/old-orders', [App\Http\Controllers\Api\Client\OrderController::class, 'oldOrders']);

        Route::get('/accept-order', [App\Http\Controllers\Api\Client\OrderController::class, 'acceptOrder']);

        Route::get('/reject-order', [App\Http\Controllers\Api\Client\OrderController::class, 'cancelOrder']);

        Route::group(['middleware'=>['auth:client_api']],function(){

            Route::post('/register-token', [App\Http\Controllers\api\Client\AuthController::class, 'registerToken']);

            Route::post('/remove-token', [App\Http\Controllers\api\Client\AuthController::class, 'removeToken']);

            Route::post('/profile', [App\Http\Controllers\Api\Client\AuthController::class, 'profile']);

            Route::post('/contact-us', [App\Http\Controllers\Api\Client\AuthController::class, 'contactUs']);

            Route::post('/reset-password', [App\Http\Controllers\Api\Client\AuthController::class, 'resetPassword']);

            Route::post('/new-password', [App\Http\Controllers\Api\Client\AuthController::class, 'newPassword']);

            Route::get('/client-notification', [App\Http\Controllers\api\Client\MainController::class, 'clientNotifications']);

            Route::post('/new-order', [App\Http\Controllers\Api\Client\OrderController::class, 'newOrder']);

            Route::get('/show-order', [App\Http\Controllers\Api\Client\OrderController::class, 'showOrder']);

      });



    });

    Route::group(['prefix' =>'resturants'],function () {

        Route::post('/resturant-register', [App\Http\Controllers\Api\Resturant\AuthController::class, 'resturantRegister']);

        Route::get('/resturant-login', [App\Http\Controllers\Api\Resturant\AuthController::class, 'resturantLogin']);

        Route::get('/meal-details', [App\Http\Controllers\Api\Resturant\MainController::class, 'mealDetails']);

        Route::get('/comments', [App\Http\Controllers\Api\Resturant\MainController::class, 'comments']);

        Route::post('/add-comment', [App\Http\Controllers\Api\Resturant\MainController::class, 'addComment']);

        Route::get('/resturant-information', [App\Http\Controllers\Api\Resturant\MainController::class, 'resturantInformation']);

        Route::get('/offers', [App\Http\Controllers\Api\Resturant\MainController::class, 'offers']);
        Route::get('/all-offers', [App\Http\Controllers\Api\Resturant\MainController::class, 'allOffers']);

        Route::get('/old-orders', [App\Http\Controllers\Api\Resturant\MainController::class, 'oldOrders']);

        Route::group(['middleware'=>['auth:resturant_api']],function(){

            Route::post('/register-token', [App\Http\Controllers\Api\Resturant\AuthController::class, 'registerToken']);

            Route::post('/remove-token', [App\Http\Controllers\Api\Resturant\AuthController::class, 'removeToken']);

            Route::post('/profile', [App\Http\Controllers\Api\Resturant\AuthController::class, 'profile']);

            Route::post('/contact-us', [App\Http\Controllers\Api\Resturant\AuthController::class, 'contactUs']);

            Route::post('/reset-password', [App\Http\Controllers\Api\Resturant\AuthController::class, 'resetPassword']);

            Route::post('/new-password', [App\Http\Controllers\Api\Resturant\AuthController::class, 'newPassword']);

            Route::get('/notifications', [App\Http\Controllers\Api\Resturant\MainController::class, 'resturantNotifications']);

            Route::get('/resturant-meals', [App\Http\Controllers\Api\Resturant\MainController::class, 'resturantMeals']);

            Route::post('/add-meals', [App\Http\Controllers\Api\Resturant\MainController::class, 'addMeal']);

            Route::post('/edit-meal', [App\Http\Controllers\Api\Resturant\MainController::class, 'editMeal']);
            Route::get('/get-new-orders', [App\Http\Controllers\Api\Resturant\MainController::class, 'getNewOrders']);

            Route::get('/get-old-orders', [App\Http\Controllers\Api\Resturant\MainController::class, 'getOldtOrders']);

            Route::get('/get-now-orders', [App\Http\Controllers\Api\Resturant\MainController::class, 'getNowOrders']);

            Route::post('/accept-order', [App\Http\Controllers\Api\Resturant\MainController::class, 'acceptOrder']);

            Route::post('/reject-order', [App\Http\Controllers\Api\Resturant\MainController::class, 'cancelOrder']);

            Route::post('/confirm-order', [App\Http\Controllers\Api\Resturant\MainController::class, 'confirmOrder']);

            Route::get('/all-offers', [App\Http\Controllers\Api\Resturant\MainController::class, 'allOffers']);

            Route::post('/add-offers', [App\Http\Controllers\Api\Resturant\MainController::class, 'addOffer']);
            Route::get('/commisions', [App\Http\Controllers\Api\Resturant\MainController::class, 'commission']);




      });



    });

});
