@extends($prefix.'layout.pages.page_lang')

@section('page_lang_header', trans('cms.helpers.button.create'))

@section('page_lang_body')

    {!! Form::open(['route' => 'admin.slider.store', 'method' => 'POST']) !!}

        @include($prefix.'slider.card.field')

        {!! Form::submit(trans('cms.helpers.button.save'), [
            'class' => 'btn btn-primary btn-simple',
            'title' =>  trans('cms.helpers.button.save')
        ])!!}
        {!! Form::reset(trans('cms.helpers.button.reset'), [
            'class' => 'btn  btn-simple',
            'title' =>  trans('cms.helpers.button.reset')
        ]) !!}
        {!! Html::link(route('admin.slider.index'), trans('cms.helpers.button.cancel'), [
            'class' => 'btn btn-danger btn-simple',
            'title' =>  trans('cms.helpers.button.cancel')
        ]) !!}

    {!! Form::close() !!}

@endsection
