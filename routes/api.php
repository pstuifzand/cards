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
    $lists = $board->lists()->withCards()->get();
    return response()->json($lists);
})->middleware('auth:api')->name('api.board.lists');

Route::post('/lists', function (Request $request) {
    \Auth::user()->boards()->first()->lists()->create($request->only(['name']));
    return redirect('/api/lists');
})->middleware('auth:api');

Route::get('/lists/{id}', function(Request $request, $id) {
    $list = CardList::findOrFail($id)->with(['cards' => function($query) {
        $query->orderBy('position', 'asc');
    }])->first();
    return response()->json($list);
});

Route::post('/lists/{id}/cards', function (Request $request, $id) {
    $list = CardList::findOrFail($id)->with(['cards' => function($query) {
        $query->orderBy('position', 'asc');
    }])->first();
    $name = $request->input('name');
    $position = $list->cards()->max('position') + 1;
    $list_id = $id;
    $list->cards()->create(compact('list_id', 'name', 'position'));
    return redirect("/api/lists/$id");
})->middleware('auth:api');

Route::post('/lists/{id}/cards/{cardId}/move', function (Request $request, $id, $cardId) {
    $list = CardList::findOrFail($id);
    $card = Card::findOrFail($cardId);
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
