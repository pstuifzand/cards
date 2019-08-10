<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CardList
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\app\Models\Card[] $cards
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @method        static \Illuminate\Database\Eloquent\Builder|\App\Models\CardList withCards()
 * @mixin         \Eloquent
 */
class CardList extends Model
{
    protected $table = 'lists';

    protected $fillable = ['name'];

    public function cards()
    {
        return $this->hasMany(Card::class, 'list_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_list', 'card_list_id', 'user_id');
    }

    public function scopeWithCards()
    {
        return $this->with(
            [ 'cards' => function ($query) {
                $query->orderBy('position', 'asc'); 
            }]
        );
    }
}
