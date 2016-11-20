<?php

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Board;
use App\Models\CardList;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/lists', function (Request $request) {
    $lists = \Auth::user()->boards()->first()->lists()->with(['cards' => function($query) {
        $query->orderBy('position', 'asc');
    }])->get();
    return response()->json($lists);
})->middleware('auth:api');

Route::get('/board/{board}/lists', function(Request $request, Board $board) {
    $lists = $board->lists()->with(['cards' => function($query) {
        $query->orderBy('position', 'asc');
    }])->get();
    return response()->json($lists);
})->middleware('auth:api')->name('api.board.lists');

Route::post('/board/{board}/lists', function (Request $request, Board $board) {
    $board->lists()->create($request->only(['name']));
    return redirect()->route('api.board.lists', $board);
})->middleware('auth:api');

Route::get('/lists/{list}', function(Request $request, CardList $list) {
    $list->load(['cards' => function($query) {
        $query->orderBy('position', 'asc');
    }]);
    return response()->json($list);
})->middleware('auth:api')->name('api.lists.show');

Route::post('/lists/{list}/cards', function (Request $request, CardList $list) {
    $name = $request->input('name');
    $position = $list->cards()->max('position') + 1;
    $list->cards()->create(compact('name', 'position'));
    return redirect()->route('api.lists.show', $list);
})->middleware('auth:api');

Route::post('/lists/{list}/cards/{card}/move', function (Request $request, CardList $list, Card $card) {
    $newList = CardList::findOrFail($request->input('new_list_id'));
    $position = $request->input('position');
    $card->position = $position;
    \DB::table('cards')
        ->where('position', '>=', $position)
        ->where('list_id', '=', $newList->id)
        ->increment('position');
    $card->list_id = $request->input('new_list_id');
    $card->save();
    return response()->json(['ok' => true]);
})->middleware('auth:api');
