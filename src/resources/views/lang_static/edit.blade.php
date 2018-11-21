@extends($prefix.'layout.pages.page_index')

@section('page_index_body')

    {!! Form::open(['route' => ['admin.lang-static.update', $lang_static->id], 'method' => 'PUT']) !!}
        @include($prefix.'lang_static.card.field')

    {!! Form::submit(trans('cms.helpers.button.update'), [
            'class' => 'btn btn-primary btn-simple',
            'title' =>  trans('cms.helpers.button.update')
        ])!!}
    {!! Html::link(route('admin.lang-static.index'), trans('cms.helpers.button.cancel'), [
        'class' => 'btn btn-danger btn-simple',
        'title' =>  trans('cms.helpers.button.cancel')
    ]) !!}

    {!! Form::close() !!}
@endsection

