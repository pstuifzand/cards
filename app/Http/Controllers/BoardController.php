<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Board;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = \Auth::user()->boards;
        return view('boards.index')->with('boards', $boards);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request, [
            'name' => 'required|max:255',
            ]
        );



        /**
 * @var $board App\Board 
*/
        $board = new Board($request->only(['name']));
        $board->user_id = \Auth::user()->id;
        $board->save();
        return redirect()->route('boards.show', $board);
    }

    /**
     * Display the specified resource.
     *
     * @param  Board $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        return view('boards.show')
            ->with('board', $board)
            ->with('crumbs', []);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
