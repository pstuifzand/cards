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
                    <li>
                        <a href="{{ route('boards.index') }}">
                            Boards
                        </a>
                    </li>
                    <li class="active">
                        {{ $board->name }}
                    </li>
                </ol>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title">
                            {{ $board->name }}
                        </h1>
                    </div>
                    <div class="panel-body">
                        <card-lists href="{{ route('api.board.lists', $board) }}"></card-lists>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
