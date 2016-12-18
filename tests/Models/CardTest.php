<?php
namespace Models;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Card;

class CardTest extends \TestCase
{
    public function testName()
    {
        $card = new Card(['name' => 'test']);
        $this->assertEquals($card->name, 'test');
    }

    public function testCardListEmpty()
    {
        $card = new Card();
        $this->assertEquals($card->cardList()->count(), 0);
    }

    public function testCardList()
    {
        $card = new Card();
        $this->assertEquals($card->cardList()->count(), 0);
    }
}
