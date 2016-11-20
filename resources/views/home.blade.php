@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Menu
                        </h4>
                    </div>
                    <div class="panel-body">
                        <a href="{{ route('boards.index') }}">Boards</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
