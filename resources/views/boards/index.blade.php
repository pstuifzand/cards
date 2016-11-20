@extends ('layouts.app')

@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ url('/home') }}">
                            Home
                        </a>
                    </li>
                    <li class="active">
                        Boards
                    </li>
                </ol>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Boards</h2>
                    </div>
                    <div class="panel-body">
                        @foreach ($boards as $board)
                            <a href="{{ route('boards.show', $board) }}">{{ $board->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
