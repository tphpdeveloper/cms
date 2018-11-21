@extends($prefix.'layout.pages.page_index')

@section('page_index_header')
    {!! Html::link(route('admin.setting.create'), trans('cms.helpers.button.create'), [
        'class' => 'btn btn-success btn-simple',
        'title' =>  trans('cms.helpers.button.create')
    ]) !!}
@endsection

@section('page_index_body')
    {!! $grid->render() !!}
@endsection



