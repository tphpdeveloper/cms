@extends($folder_path.'layout.pages.page_index')

@section('page_index_header')
    {!! Form::bsButtonCreate(route('admin.page.create')) !!}
@endsection

@section('page_index_body')
    {!! $grid->render() !!}
@endsection



