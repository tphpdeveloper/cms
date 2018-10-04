@extends(config('myself.folder').'.layout.app')

@section('panel-header')
    @include(config('myself.folder').'.layout.panel-header.sm')
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    {!! $grid->show('grid-table') !!}

                </div>
            </div>
        </div>
    </div>
@endsection


