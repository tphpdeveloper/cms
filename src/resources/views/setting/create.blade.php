@extends($folder_path.'layout.pages.page_lang')

@section('page_lang_header', trans('cms.helpers.button.create'))


@section('page_lang_body')
    {!! Form::open(['route' => 'admin.setting.store', 'method' => 'POST']) !!}
        @include($folder_path.'setting.card.create')

        {!! Form::bsButtonSave() !!}
        {!! Form::bsButtonReset() !!}
        {!! Form::bsButtonCancel(route('admin.setting.index')) !!}

    {!! Form::close() !!}
@endsection
