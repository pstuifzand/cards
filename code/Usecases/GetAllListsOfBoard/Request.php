<?php

namespace Code\Usecases\GetAllListsOfBoard;

class Request
{
    /**
     * @var integer
     */
    protected $boardId;

    public function __construct($boardId)
    {
        $this->boardId = $boardId;
    }

    /**
     * @return int
     */
    public function getBoardId()
    {
        return $this->boardId;
    }
}
