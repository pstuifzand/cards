<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [ 'name', 'list_id' ];

    public function cardList()
    {
        return $this->belongsTo(CardList::class);
    }
}
