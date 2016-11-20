@extends ('layouts.app')

@section ('content')
    <h1>{{ $board->name }}</h1>

    <card-lists href="{{ route('api.board.lists', $board) }}"></card-lists>
@stop
