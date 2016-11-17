<div class="list">
    <div class="list--name">
        {{ $list->name }}
    </div>
    <div class="list--cards connected">
        @each('card.show', $list->cards, 'card')
    </div>
</div>
