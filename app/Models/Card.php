<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['name', 'position', 'list_id'];

    public function cardList()
    {
        return $this->belongsTo(CardList::class);
    }
}
