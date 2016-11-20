@extends ('layouts.app')

@section ('content')
    <h1>Boards</h1>

    @foreach ($boards as $board)
        <a href="{{ route('boards.show', $board) }}">{{ $board->name }}</a>
    @endforeach
@stop
