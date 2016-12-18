<?php
namespace Models;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\CardList;

class CardListTest extends \TestCase
{
    use DatabaseTransactions;

    public function testCardListEmpty()
    {
        $cardList = CardList::create(['name' => 'To Do']);
        $this->assertEquals($cardList->cards()->count(), 0);
    }

    public function testCardListItems()
    {
        $cardList = CardList::create(['name' => 'To Do']);
        $this->assertEquals($cardList->cards()->count(), 0);

        $card = $cardList->cards()->create(['name' => 'Item 1']);
        $card2 = $cardList->cards()->create(['name' => 'Item 2']);

        $this->assertEquals($cardList->cards()->count(), 2);
        $this->assertEquals($card->name, 'Item 1');
        $this->assertEquals($card2->name, 'Item 2');
    }
}
