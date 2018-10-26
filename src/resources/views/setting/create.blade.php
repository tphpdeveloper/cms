@extends($folder_path.'layout.page_lang')

@section('card-body')
    {!! Form::open(['route' => ['admin.setting.storage', $setting->id], 'method' => 'POST']) !!}
        @include($folder_path.'setting.card.create')


        @include($folder_path.'helpers.btn', [
            'text_ok' => trans('setting.button.save'),
            'route_cancel' => route('admin.setting.index'),
            'text_cancel' => trans('setting.button.cancel'),
        ])

    {!! Form::close() !!}
    {{--@include($folder_path.'setting.card.langs')--}}
@endsection
