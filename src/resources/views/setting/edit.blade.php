@extends($prefix.'layout.pages.page_lang')

@section('page_lang_header', trans('cms.helpers.button.update') . ' '.$setting->name)

@section('page_lang_body')

    {!! Form::open(['route' => ['admin.setting.update', $setting->id], 'method' => 'PUT']) !!}
        @include($prefix.'setting.card.edit')

    {!! Form::submit(trans('cms.helpers.button.update'), [
        'class' => 'btn btn-primary btn-simple',
        'title' =>  trans('cms.helpers.button.update')
    ])!!}
    {!! Html::link(route('admin.setting.index'), trans('cms.helpers.button.cancel'), [
        'class' => 'btn btn-danger btn-simple',
        'title' =>  trans('cms.helpers.button.cancel')
    ]) !!}

    {!! Form::close() !!}
@endsection

