@extends(config('myself.folder').'.layout.app')

@section('content')
    @include(config('myself.folder').'.helpers.lang_switch')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">

                    </div>
                    <div class="card-body">

                        @include(config('myself.folder').'.setting.card.main')

                            {{--@include(config('myself.folder').'.setting.card.langs')--}}


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
