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
// Route::get('/patient','API\PatientController@index');
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', 'API\AuthController@login');
    Route::post('logout', 'API\AuthController@logout');
    Route::post('refresh', 'API\AuthController@refresh');
    Route::get('me', 'API\AuthController@me');

});
Route::apiResources([
    'patients' => 'API\PatientController',
    'users' => 'API\UserController',
    'consultations'=>'API\ConsultationController'
]);

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
