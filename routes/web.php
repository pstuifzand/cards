<?php

use Illuminate\Http\Request;
use App\Jobs\DeployNewCode;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/settings', function(Request $request) {
    return view('settings');
});

Route::resource('boards', 'BoardController');

Route::post('/deploy/cards', function(Request $request) {
    dispatch(new DeployNewCode());
    return 'OK';
});
