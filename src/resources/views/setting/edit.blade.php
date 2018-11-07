@extends($folder_path.'layout.pages.page_lang')

@section('page_lang_header', trans('cms.helpers.button.update') . ' '.$setting->name)

@section('page_lang_body')

    {!! Form::open(['route' => ['admin.setting.update', $setting->id], 'method' => 'PUT']) !!}
        @include($folder_path.'setting.card.edit')

        {!! Form::bsButtonUpdate() !!}
        {!! Form::bsButtonCancel(route('admin.setting.index')) !!}

    {!! Form::close() !!}
@endsection

