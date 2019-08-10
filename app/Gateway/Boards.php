<?php

namespace App\Gateway;

use Code\Entities\Board;
use Code\Entities\CardList;
use Code\Entities\Card;

class Boards implements \Code\Boundaries\Boards
{
    public function getBoard($boardId)
    {
        $board = new Board();

        $row = DB::table('boards')->where('id', $boardId)->first();
        $board->id = $boardId;
        $board->name = $row->name;
        $board->cardLists = [];

        $lists = DB::table('board_list')->where('board_id', $boardId)->all();

        foreach ($lists as $list) {
            $l = new CardList();
            $l->name = $list->name;
        }

        return $board;
    }
}

