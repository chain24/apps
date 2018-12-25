<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function(){
    Route::get('/user', function( Request $request ){
        return $request->user();
    });
    /*
     |-------------------------------------------------------------------------------
     | Get All Cafes
     |-------------------------------------------------------------------------------
     | URL:            /api/v1/cafes
     | Controller:     API\CafesController@getCafes
     | Method:         GET
     | Description:    Gets all of the cafes in the application
    */
    Route::get('/cafes', 'API\CafesController@getCafes');

    /*
     |-------------------------------------------------------------------------------
     | Get An Individual Cafe
     |-------------------------------------------------------------------------------
     | URL:            /api/v1/cafes/{id}
     | Controller:     API\CafesController@getCafe
     | Method:         GET
     | Description:    Gets an individual cafe
    */
    Route::get('/cafes/{id}', 'API\CafesController@getCafe');

    /*
     |-------------------------------------------------------------------------------
     | Adds a New Cafe
     |-------------------------------------------------------------------------------
     | URL:            /api/v1/cafes
     | Controller:     API\CafesController@postNewCafe
     | Method:         POST
     | Description:    Adds a new cafe to the application
    */
    Route::post('/cafes', 'API\CafesController@postNewCafe');
    /*
     |-------------------------------------------------------------------------------
     | Get All Methods
     |-------------------------------------------------------------------------------
     | URL:            /api/v1/brew-methods
     | Controller:     API\BrewMethodsController@getBrewMethods
     | Method:         GET
     | Description:    Gets all of the brew-methods in the application
    */
    Route::get('/brew-methods', 'API\BrewMethodsController@getBrewMethods');
    /*
     |-------------------------------------------------------------------------------
     | Get cafe of like
     |-------------------------------------------------------------------------------
     | URL:            /api/v1/cafes/{id}/like
     | Controller:     API\CafesController@postLikeCafe
     | Method:         POST
     | Description:    get cafes from collection of likes
    */
    Route::post('/cafes/{id}/like', 'API\CafesController@postLikeCafe');
    /*
     |-------------------------------------------------------------------------------
     | Delete cafe of like
     |-------------------------------------------------------------------------------
     | URL:            /api/v1/cafes/{id}/like
     | Controller:     API\CafesController@deleteLikeCafe
     | Method:         Delete
     | Description:    delete cafes from collection of likes
    */
    Route::delete('/cafes/{id}/like', 'API\CafesController@deleteLikeCafe');
});