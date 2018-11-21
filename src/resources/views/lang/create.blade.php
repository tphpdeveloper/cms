@extends($prefix.'layout.pages.page_index')

@section('page_index_header', trans('cms.helpers.button.create'))


@section('page_index_body')
    {!! Form::open(['route' => 'admin.lang.store', 'method' => 'POST']) !!}
        @include($prefix.'lang.card.field')

    {!! Form::submit(trans('cms.helpers.button.save'), [
        'class' => 'btn btn-primary btn-simple',
        'title' =>  trans('cms.helpers.button.save')
    ])!!}
    {!! Form::reset(trans('cms.helpers.button.reset'), [
        'class' => 'btn  btn-simple',
        'title' =>  trans('cms.helpers.button.reset')
    ]) !!}
    {!! Html::link(route('admin.lang.index'), trans('cms.helpers.button.cancel'), [
        'class' => 'btn btn-danger btn-simple',
        'title' =>  trans('cms.helpers.button.cancel')
    ]) !!}

    {!! Form::close() !!}
@endsection
