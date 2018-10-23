@extends(config('myself.folder').'.layout.app')

@section('content')
    <div class="row">
        @include(config('myself.folder').'.helpers.lang_switch')
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        {!! Form::model($setting, ['route' => ['admin.setting.update', $setting->id], 'method' => 'PUT']) !!}
                            {!! Form::bsText('name', 'Название настройки', ) !!}


                        {!! Form::close() !!}

                        {{--{!! Form::open(['route' => ['admin.setting.update', 1], 'method' => 'PUT']) !!}--}}

                        {{--@include(config('myself.folder').'.setting.card.main')--}}

                        {{--@include(config('myself.folder').'.setting.card.langs')--}}

                        {{--{!! Form::submit('Изменить данные', ['class' => 'btn btn-primary']) !!}--}}
                        {{--{!! Form::close() !!}--}}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
