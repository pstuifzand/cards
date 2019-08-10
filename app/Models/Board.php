<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Board
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CardList[] $lists
 * @property-read \App\Models\User $owner
 * @mixin         \Eloquent
 */
class Board extends Model
{
    protected $fillable = ['name', 'user_id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lists()
    {
        return $this->belongsToMany(CardList::class, 'board_list', 'board_id', 'list_id');
    }
}
