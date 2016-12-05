@extends ('layouts.app')

@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <bs-breadcrumbs>
                    @foreach ($crumbs as $crumb)
                        <bs-breamcrumb href="{{ $crumb['url'] }}"></bs-breadcrubms>
                    @endforeach
                </bs-breadcrumbs>

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

                <bs-panel title="{{ $board->name }}">
                    <card-lists href="{{ route('api.board.lists', $board) }}"></card-lists>
                </bs-panel>
            </div>
        </div>
    </div>
@stop
