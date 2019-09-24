<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthApiController;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

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
	//User Login
	Route::post('/signin', [AuthApiController::class, 'signin']);

	//User Forget Password
	Route::post('/forget-password', [AuthApiController::class, 'forget_password']);

	//User County List
	Route::get('/country', [AuthApiController::class, 'country']);

	//User State List
	Route::get('/state/{id}', [AuthApiController::class, 'state']);

	//User State List
	Route::get('/city/{id}', [AuthApiController::class, 'city']);

	//User Register First Step
	Route::post('/signup', [AuthApiController::class, 'signup']);

	//User Verify Email
	Route::post('/emailverify', [AuthApiController::class, 'email_verification']);

	//User Register Second Step
	Route::post('/register', [AuthApiController::class, 'signup_second_step']);


	//=============================================After Login With Login Token=====================================//

	//Game List
	Route::post('/game_list', [ApiController::class, 'game_list']);	

	//Game Compitition Level
	Route::post('/comp_level', [ApiController::class, 'game_comp_level']);	

	//Game Category
	Route::post('/event_category', [ApiController::class, 'event_category']);

	//Game Event List
	Route::post('/event_list', [ApiController::class, 'event_list']);

	//Game Event Search
	Route::post('/event_search', [ApiController::class, 'event_search']);

	//Game Event Search
	Route::post('/event_details', [ApiController::class, 'event_details']);

	//Game Filter Data Fetch
	Route::post('/filter_fetch', [ApiController::class, 'filter_fetch']);

	//Filtered Game Event List
	Route::post('/filtered_event_list', [ApiController::class, 'filtered_event_list']);

	//Game Joining
	Route::post('/event_joining', [ApiController::class, 'event_joining']);

	//Game Statistics List
	Route::post('/event_statistic_list', [ApiController::class, 'event_statistic_list']);







