<?php

use App\Repositories\Frontend\DailyServiceRepository;
use App\TransactionActivity;
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
    'prefix' => 'auth',
], function ($router) {
    Route::post('login', 'API\AuthController@login');
    Route::post('logout', 'API\AuthController@logout');
    Route::post('refresh', 'API\AuthController@refresh');
    Route::post('import', 'API\ReadCodeController@store');
    Route::post('checkout', 'API\OrderController@store');
    Route::get('me', 'API\AuthController@me');
});

// Route::get('test', function (DailyServiceRepository $dsrepo, TransactionActivity $trans) {
// });
Route::get('examinationPerConsultation/{id}', 'API\ExaminationController@examinationPerConsultation');
Route::get('investigationPerPatient/{id}', 'API\InvestigationController@investigationPerPatient');
Route::get('examinationPerPatient/{id}', 'API\ExaminationController@examinationPerPatient');
Route::get('medicationPerPatient/{id}', 'API\MedicationController@medicationPerConsultationPerPatient');
Route::get('problemPerConsultation/{id}', 'API\ProblemController@problemPerConsultation');
Route::get('problemsPerPatient/{id}', 'API\ProblemController@problemsPerPatient');
Route::get('problem/{id}', 'API\ProblemController@getProblemByID');
Route::get('medicationPerConsultation/{id}', 'API\MedicationController@medicationPerConsultationPerConsultation');
Route::get('permissions/{id?}', 'API\PermissionController@index');
Route::post('assignPermissions', 'API\RoleController@assignPermissions');
Route::get('codes', 'API\ReadCodeController@index');
Route::get('week', 'API\ReadCodeController@search');
Route::get('patients/all', 'API\PatientController@all');
Route::get('searchuser', 'API\UserController@searchUser');
Route::get('searchpatient', 'API\PatientController@searchpatient');
Route::post('saveExamination', 'API\ExaminationController@saveExamination');
Route::post('getExamination', 'API\ExaminationController@getExaminationByProbID');
Route::post('saveComment', 'API\ConsultationController@saveComment');
Route::put('patients/{id}/deposit', 'API\PatientController@updateDeposit');
Route::get('getservices', 'API\ServiceController@getServices');
Route::delete('servicegroups', 'API\ServiceController@removeGroupService');
Route::post('servicegroups', 'API\ServiceController@createGroupService');
Route::post('getRequetsByProblemID', 'API\RequestController@getRequetsByProblemID');

Route::apiResources([
    'requests' => 'API\RequestController',
    'reportdocuments' => 'API\ReportDocumentController',
    'patients' => 'API\PatientController',
    'problems' => 'API\ProblemController',
    'users' => 'API\UserController',
    'investigations' => 'API\InvestigationController',
    'consultations' => 'API\ConsultationController',
    'medications' => 'API\MedicationController',
    'examinations' => 'API\ExaminationController',
    'sessions' => 'API\SessionController',
    'roles' => 'API\RoleController',
    'services' => 'API\ServiceController',
    'additionalservices' => 'API\AdditionalServiceController',
    'products' => 'API\ProductController',
    'appointments' => 'API\AppointmentController',
    // 'requests' => 'API\ConsultationRequestController',
    'dailyservices' => 'API\DailyServiceController',
]);

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
