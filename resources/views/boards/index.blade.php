@extends ('layouts.app')

@push('head')
    <style>
        .action-link { cursor: pointer; }
    </style>
@endpush

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
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span>Boards</span>
                            <a class="action-link create-board-form">
                                Create new Board
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <ul>
                            @foreach ($boards as $board)
                                <li><a href="{{ route('boards.show', $board) }}">{{ $board->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="model-create-board" tabindex="-1" role="dialog">
        <form action="{{ route('boards.store') }}" method="post" class="form-horizontal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close">&times;</button>
                        <h4 class="modal-title">
                            Create new Board
                        </h4>
                    </div>

                    <div class="modal-body">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">Name</label>
                            <div class="col-md-6"><input id="create-board-name" type="text" class="form-control" name="name"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="close">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@push('footer_scripts')
    <script>
        jQuery(document).on('click', '.create-board-form', function() {
            $('#model-create-board').modal('show');
        });
        jQuery(document).on('click', '.close, [data-dismiss=close]', function() {
            $(this).parents('.modal').modal('hide');
        });

    </script>
@endpush
