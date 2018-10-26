@extends($folder_path.'layout.pages.page_lang')

@section('page_lang_header')
    {{ $setting->name }}
@endsection

@section('page_lang_body')
    {!! Form::open(['route' => ['admin.setting.update', $setting->id], 'method' => 'PUT']) !!}
        @include($folder_path.'setting.card.main')

        {!! Form::bsButtonUpdate() !!}
        {!! Form::bsButtonCancel(route('admin.setting.index')) !!}

    {!! Form::close() !!}
    {{--@include($folder_path.'setting.card.langs')--}}
@endsection
