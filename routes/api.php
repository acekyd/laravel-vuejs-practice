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

Route::group(['middleware' => 'api'], function() {
    Route::get('tasks', function() {
        return App\Task::latest()->orderBy('created_at', 'desc')->get();
    });

    Route::get('task/{id}', function($id) {
        return App\Task::findOrFail($id);
    });

    Route::post('task/store', function(Request $request) {
        return App\Task::create(['body' => $request->input(['body'])]);
    });

    Route::patch('task/{id}', function(Request $request, $id) {
        App\Task::findOrFail($id)->update(['body' => $request->input(['body'])]);
    });

    Route::delete('task/{id}', function($id) {
        return App\Task::destroy($id);
    });
});