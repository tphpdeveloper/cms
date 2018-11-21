@extends($prefix.'layout.pages.page_index')

@section('page_index_header', trans('cms.helpers.button.update') . ' '.$lang->name)

@section('page_index_body')

    {!! Form::open(['route' => ['admin.lang.update', $lang->id], 'method' => 'PUT']) !!}
        @include($prefix.'lang.card.field')

    {!! Form::submit(trans('cms.helpers.button.update'), [
            'class' => 'btn btn-primary btn-simple',
            'title' =>  trans('cms.helpers.button.update')
        ])!!}
    {!! Html::link(route('admin.lang.index'), trans('cms.helpers.button.cancel'), [
        'class' => 'btn btn-danger btn-simple',
        'title' =>  trans('cms.helpers.button.cancel')
    ]) !!}

    {!! Form::close() !!}
@endsection

