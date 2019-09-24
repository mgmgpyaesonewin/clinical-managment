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

Route::get('examinationPerConsultation/{id}','API\ExaminationController@examinationPerConsultation');
Route::get('investigationPerConsultation/{id}','API\InvestigationController@investigationPerConsultation');
Route::get('problemPerConsultation/{id}','API\ProblemController@problemPerConsultation');
Route::get('medicationPerConsultation/{id}','API\MedicationController@medicationPerConsultationPerConsultation');
Route::get('permissions', 'API\PermissionController@index');
Route::post('assignPermissions', 'API\RoleController@assignPermissions');

Route::apiResources([
    'patients' => 'API\PatientController',
    'problems' => 'API\ProblemController',
    'users' => 'API\UserController',
    'investigations'=>'API\InvestigationController',
    'consultations'=>'API\ConsultationController',
    'medications'=>'API\MedicationController',
    'examinations'=>'API\ExaminationController',
    'roles' => 'API\RoleController'
]);

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
