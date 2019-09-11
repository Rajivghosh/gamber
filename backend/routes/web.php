<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::prefix('/admin')->group(function() {

	Route::get('/', ['uses' => 'Admin\IndexController@index']);
	Route::post('/', ['uses' => 'Admin\IndexController@login']);
	Route::get('/register', ['uses' => 'Admin\RegisterController@index']);
	Route::post('/register', ['uses' => 'Admin\RegisterController@register']);

	Route::get('/home', ['uses' => 'Admin\HomeController@index', 'middleware' => 'auth:web']);
	Route::get('/logout', ['uses' => 'Admin\IndexController@logout', 'middleware' => 'auth:web']);

	// /admin/game
    Route::prefix('/game')->middleware('auth:web')->group(function() {
    	Route::get('/list', ['uses' => 'Admin\GameController@index']);
    	Route::get('/add', ['uses' => 'Admin\GameController@add']);
    	Route::post('/add', ['uses' => 'Admin\GameController@save']);
    	Route::get('/edit/{id}', ['uses' => 'Admin\GameController@edit']);
        Route::get('/remove/{id}', ['uses' => 'Admin\GameController@remove']);    
        Route::get('/settings/{id}', ['uses' => 'Admin\GameController@settings']);  
        Route::get('/rules/{id}', ['uses' => 'Admin\GameController@rules']);   
        Route::post('/rules', ['uses' => 'Admin\GameController@rulessave']);  
        Route::post('/settings', ['uses' => 'Admin\GameController@settingSave']);
    });	

    //admin/Game Type
    Route::prefix('/game_type')->middleware('auth:web')->group(function(){
        Route::get('/list', ['uses' => 'Admin\GameTypeController@index']);        
        Route::get('/add', ['uses' => 'Admin\GameTypeController@add']);
        Route::post('/add', ['uses' => 'Admin\GameTypeController@save']);
        Route::get('/edit/{id}', ['uses' => 'Admin\GameTypeController@edit']);
        Route::get('/remove/{id}', ['uses' => 'Admin\GameTypeController@remove']);
    });

    //admin/Competition level
    Route::prefix('/competition-level')->middleware('auth:web')->group(function(){
        Route::get('/list', ['uses' => 'Admin\CompetitionLevelController@index']);        
        Route::get('/add', ['uses' => 'Admin\CompetitionLevelController@add']);
        Route::post('/add', ['uses' => 'Admin\CompetitionLevelController@save']);
        Route::get('/edit/{id}', ['uses' => 'Admin\CompetitionLevelController@edit']);
        Route::get('/remove/{id}', ['uses' => 'Admin\CompetitionLevelController@remove']);
    });
    //admin/eventcategory
    Route::prefix('/eventcategory')->middleware('auth:web')->group(function(){
        Route::get('/list', ['uses' => 'Admin\EventCategoryController@index']);        
        Route::get('/add', ['uses' => 'Admin\EventCategoryController@add']);
        Route::post('/add', ['uses' => 'Admin\EventCategoryController@save']);
        Route::get('/edit/{id}', ['uses' => 'Admin\EventCategoryController@edit']);
        Route::get('/remove/{id}', ['uses' => 'Admin\EventCategoryController@remove']);
        Route::post('/listlevelID', ['uses' => 'Admin\EventCategoryController@listlevelById']);
        

        Route::prefix('/sub')->middleware('auth:web')->group(function(){
            Route::get('/{id}', ['uses' => 'Admin\EventSubCategoryController@index']);
            Route::get('/{id}/data', ['uses' => 'Admin\EventSubCategoryController@data']);
            Route::post('/save', ['uses' => 'Admin\EventSubCategoryController@save']);
            Route::get('/edit/{id}', ['uses' => 'Admin\EventSubCategoryController@edit']);
            Route::get('/remove/{id}', ['uses' => 'Admin\EventSubCategoryController@remove']);
        });
    });

    Route::prefix('/event')->middleware('auth:web')->group(function(){
        Route::get('/list', ['uses' => 'Admin\EventController@index']);
        Route::get('/add', ['uses' => 'Admin\EventController@add']);
        Route::post('/add', ['uses' => 'Admin\EventController@save']);
        Route::get('/edit/{id}', ['uses' => 'Admin\EventController@edit']);
        Route::get('/remove/{id}', ['uses' => 'Admin\EventController@remove']);
        Route::post('/listlevelID', ['uses' => 'Admin\EventController@listlevelById']);
        Route::post('/listvenueID', ['uses' => 'Admin\EventController@listvenueById']);
        Route::post('/listgametypeID', ['uses' => 'Admin\EventController@listgametypeById']);
        Route::post('/listcatID', ['uses' => 'Admin\EventController@listcatById']);
        Route::post('/listsubcatID', ['uses' => 'Admin\EventController@listsubcatbyID']);
        Route::get('/details/{id}', ['uses' => 'Admin\EventController@details']);
        
    });

    Route::prefix('/users')->middleware('auth:web')->group(function(){
        Route::get('/list', ['uses' => 'Admin\AdminUserController@index']);
        Route::get('/add', ['uses' => 'Admin\AdminUserController@add']);
        Route::post('/add', ['uses' => 'Admin\AdminUserController@save']);
        Route::get('/edit/{id}', ['uses' => 'Admin\AdminUserController@edit']);
        Route::get('/remove/{id}', ['uses' => 'Admin\AdminUserController@remove']);
        Route::get('/details/{id}', ['uses' => 'Admin\AdminUserController@details']);
        Route::post('/status', ['uses' => 'Admin\AdminUserController@status'])->name('user.status');
    });
    Route::prefix('/badges')->middleware('auth:web')->group(function(){
        Route::get('/list', ['uses' => 'Admin\AdminBadgesController@index']);
        Route::get('/add', ['uses' => 'Admin\AdminBadgesController@add']);
        Route::post('/add', ['uses' => 'Admin\AdminBadgesController@save']);
        Route::get('/edit/{id}', ['uses' => 'Admin\AdminBadgesController@edit']);
        Route::get('/remove/{id}', ['uses' => 'Admin\AdminBadgesController@remove']);

    });
    Route::prefix('/venue')->middleware('auth:web')->group(function(){
        Route::get('/list', ['uses' => 'Admin\AdminVenueController@index']);
        Route::get('/add', ['uses' => 'Admin\AdminVenueController@add']);
        Route::post('/add', ['uses' => 'Admin\AdminVenueController@save']);
        Route::get('/edit/{id}', ['uses' => 'Admin\AdminVenueController@edit']);
        Route::get('/remove/{id}', ['uses' => 'Admin\AdminVenueController@remove']);

    });
});

Route::get('/schedule_event', ['uses' => 'Cron\CronController@schedule_event']); 

//User 
Route::prefix('/user')->group(function() {

    Route::get('/register', ['uses' => 'Users\IndexController@index']);
    Route::post('/register', ['uses' => 'Users\IndexController@register']);
    Route::post('/echeckExistEmail', ['uses' => 'Users\IndexController@echeckExistEmail']);
});