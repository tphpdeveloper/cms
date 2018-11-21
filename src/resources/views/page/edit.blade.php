@extends($prefix.'layout.pages.page_lang')

@section('page_lang_header', trans('cms.helpers.button.update') . ' '.$page->title)

@section('page_lang_body')

    {!! Form::open(['route' => ['admin.page.update', $page->id], 'method' => 'PUT']) !!}
        @include($prefix.'page.card.field')

    {!! Form::submit(trans('cms.helpers.button.update'), [
            'class' => 'btn btn-primary btn-simple',
            'title' =>  trans('cms.helpers.button.update')
        ])!!}
    {!! Html::link(route('admin.page.index'), trans('cms.helpers.button.cancel'), [
        'class' => 'btn btn-danger btn-simple',
        'title' =>  trans('cms.helpers.button.cancel')
    ]) !!}

    {!! Form::close() !!}
@endsection

