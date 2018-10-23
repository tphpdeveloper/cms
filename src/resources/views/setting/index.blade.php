@extends(config('myself.folder').'.layout.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        {!! $grid->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



