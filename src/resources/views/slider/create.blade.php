@extends($folder_path.'layout.pages.page_lang')

@section('page_lang_header', trans('cms.helpers.button.create'))

@section('page_lang_body')

    {!! Form::open(['route' => 'admin.slider.store', 'method' => 'POST']) !!}

        @include($folder_path.'slider.card.field')

        {!! Form::bsButtonSave() !!}
        {!! Form::bsButtonReset() !!}
        {!! Form::bsButtonCancel(route('admin.slider.index')) !!}

    {!! Form::close() !!}

@endsection
