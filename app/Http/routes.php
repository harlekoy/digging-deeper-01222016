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

Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function() {

    Route::resource('projects', 'ProjectController', [
        'only' => ['index', 'store', 'show', 'update', 'destroy']
    ]);

    Route::resource('tasks', 'TaskController', [
        'only' => ['index', 'store', 'show', 'update', 'destroy']
    ]);

    Route::resource('projects.tasks', 'ProjectTaskController', [
        'only' => ['index', 'store', 'show', 'update', 'destroy']
    ]);
    
});
