<?php

namespace Code\Usecases;

use Code\Boundaries\Boards;

use Code\Usecases\GetAllListsOfBoard\Request;
use Code\Usecases\GetAllListsOfBoard\Response;

class GetAllListsOfBoard
{
    /**
     * @var Boards
     */
    protected $boardsGateway;

    /**
     * GetAllListsOfBoard constructor.
     * @param Boards $boardsGateway
     */
    public function __construct(Boards $boardsGateway)
    {
        $this->boardsGateway = $boardsGateway;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function execute(Request $request)
    {
        $boardId = $request->getBoardId();

        $board = $this->boardsGateway->getBoard($boardId);

        $lists = [];
        foreach ($board->cardLists as $list) {
            $lists[] = new stdclass([
                'id' => $list->id,
                'name' => $list->name,
            ]);
        }

        return new GetAllListsOfBoard\Response($lists);
    }
}
