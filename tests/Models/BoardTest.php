<?php
namespace Models;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Board;
use App\Models\User;

class BoardTest extends \TestCase
{
    use DatabaseTransactions;

    public function testName()
    {
        $board = Board::create([
            'name' => 'test',
            'user_id' => 1,
        ]);
        $this->assertEquals($board->name, 'test');
    }

    public function testOwner()
    {
        $user = User::create([
            'name' => 'Peter',
            'email' => 'test@example.com',
            'password' => \Hash::make('test'),
        ]);
        $board = Board::create([
            'name' => 'test',
            'user_id' => $user->id,
        ]);
        $this->assertEquals($board->owner->name, 'Peter');
    }

    public function testOwnerChange()
    {
        $user = User::create([
            'name' => 'Peter',
            'email' => 'test@example.com',
            'password' => \Hash::make('test'),
        ]);
        $user2 = User::create([
            'name' => 'Peter 2',
            'email' => 'test2@example.com',
            'password' => \Hash::make('test2'),
        ]);
        $board = Board::create([
            'name' => 'test',
            'user_id' => $user->id,
        ]);
        $board->owner()->associate($user2);
        $board->save();
        $this->assertEquals($board->owner->name, 'Peter 2');
    }

    public function testBoardLists()
    {
        $user = User::create([
            'name' => 'Peter',
            'email' => 'test@example.com',
            'password' => \Hash::make('test'),
        ]);

        $board = Board::create([
            'name' => 'Todo List',
            'user_id' => $user->id,
        ]);

        $names = collect(['To Do', 'Doing', 'Done']);
        $names->each(function($name) use ($board) {
            $board->lists()->create([
                'name' => $name,
            ]);
        });
        $this->assertEquals($board->lists()->count(), 3);

        $board->lists()->first()->withCards();

    }
}
