@extends(config('myself.folder').'.layout.app')

@section('panel-header')
    @include(config('myself.folder').'.layout.panel-header.sm')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    {!! $grid->render() !!}

                </div>
            </div>
        </div>
    </div>
@endsection



