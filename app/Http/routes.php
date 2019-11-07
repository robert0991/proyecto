<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['ajax']], function () {
    Route::post('worker/state', 'ApiController@state');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', 'HomeController@welcome');
    Route::get('/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@showLoginForm']);
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home/report', 'HomeController@report');
    Route::get('/home/report1', 'HomeController@report1');

    Route::get('pdf', function(){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    });

    Route::get('/worker/create', 'WorkerController@create');
    Route::post('/worker/store', 'WorkerController@store');
    Route::post('/worker/upload',  ['as' => 'worker.upload', 'uses' => 'WorkerController@upload']);
    Route::get('/worker/show/{id_worker}', 'WorkerController@show');
    Route::get('/worker/edit/{id_worker}', ['as' => 'worker.edit', 'uses' =>'WorkerController@edit']);
    Route::post('/worker/update', 'WorkerController@update');
    Route::get('/worker/retirados', 'WorkerController@retirados');
    Route::get('/worker/buscaRetirados', 'WorkerController@buscarRetirados')->name('retirados');
    Route::post('/worker/remove', 'WorkerController@remove');
    Route::get('/worker/report/{id_worker}', 'WorkerController@report');
    Route::get('/worker/reportVacation/{id_worker}', 'WorkerController@reportVacation');
    Route::get('/worker/reportPermit/{id_worker}', 'WorkerController@reportPermit');
    Route::get('/worker/reportOther/{id_worker}', 'WorkerController@reportOther');


    Route::resource('area','AreaController');
    Route::get('/area', ['as' => 'area.index', 'uses' =>'AreaController@index']);
    Route::get('/area/create', 'AreaController@create');
    Route::post('/area/store', 'AreaController@store');
    Route::get('/area/edit/{id_area}',['as' => 'area.edit', 'uses' => 'AreaController@edit']);
    Route::post('/area/update', 'AreaController@update');


    Route::get('/vacation/create/{id_worker}/{name_worker}', 'VacationController@create');
    Route::post('/vacation/store', 'VacationController@store');

    Route::get('/permit/create/{id_worker}/{name_worker}', 'PermitController@create');
    Route::get('/permit/create1/{id_worker}/{name_worker}', 'PermitController@create1');
    Route::post('/permit/store', 'PermitController@store');
    Route::post('/permit/store1', 'PermitController@store1');
});

Route::group(['middleware' => ['api']], function () {
    Route::post('worker/state', 'ApiController@state');
});