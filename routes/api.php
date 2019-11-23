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
    Route::post('import', 'API\ReadCodeController@store');
    Route::post('checkout', 'API\OrderController@store');
    Route::get('me', 'API\AuthController@me');
});

Route::get('examinationPerConsultation/{id}','API\ExaminationController@examinationPerConsultation');
Route::get('investigationPerPatient/{id}','API\InvestigationController@investigationPerPatient');
Route::get('problemPerConsultation/{id}','API\ProblemController@problemPerConsultation');
Route::get('problemsPerPatient/{id}','API\ProblemController@problemsPerPatient');
Route::get('medicationPerConsultation/{id}','API\MedicationController@medicationPerConsultationPerConsultation');
Route::get('permissions/{id?}', 'API\PermissionController@index');
Route::post('assignPermissions', 'API\RoleController@assignPermissions');
Route::get('codes', 'API\ReadCodeController@index');
Route::get('patients/all', 'API\PatientController@all');

Route::apiResources([
    'patients' => 'API\PatientController',
    'problems' => 'API\ProblemController',
    'users' => 'API\UserController',
    'investigations'=>'API\InvestigationController',
    'consultations'=>'API\ConsultationController',
    'medications'=>'API\MedicationController',
    'examinations'=>'API\ExaminationController',
    'sessions'=>'API\SessionController',
    'roles' => 'API\RoleController',
    'products' => 'API\ProductController',
    'appointments' => 'API\AppointmentController',
]);

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
