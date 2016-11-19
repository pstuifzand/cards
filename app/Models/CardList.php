<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
