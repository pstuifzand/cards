<?php

namespace Code\Usecases\GetAllListsOfBoard;

class Response
{
    protected $cardLists;

    public function __construct($cardLists)
    {
        $this->cardLists = $cardLists;
    }
}
