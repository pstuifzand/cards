<?php

use Illuminate\Http\Request;
use App\Models\Card;
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
    $lists = CardList::with(['cards' => function($query) {
        $query->orderBy('position', 'asc');
    }])->get();
    return response()->json($lists);
});

Route::post('/lists/{id}/cards', function (Request $request, $id) {
    CardList::findOrFail($id)
        ->cards()->create($request->only(['name']));
    $lists = CardList::with('cards')->get();
    return response()->json(['ok' => true]);
});

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
});
