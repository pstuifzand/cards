<?php
namespace App\Http\Controllers;

class ApiController extends Controller
{
    public function lists()
    {
        return response()->json([
            'lists' => CardList::all(),
        ]);
    }
}
