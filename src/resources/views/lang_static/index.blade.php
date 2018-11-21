@extends($prefix.'layout.pages.page_lang')

@section('page_lang_header')
    {!! Html::link(route('admin.lang-static.create'), trans('cms.helpers.button.create'), [
            'class' => 'btn btn-success btn-simple',
            'title' =>  trans('cms.helpers.button.create')
        ]) !!}
@endsection

@section('page_lang_body')
    {!! $grid->render() !!}
@endsection



