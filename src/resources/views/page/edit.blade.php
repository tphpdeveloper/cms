@extends($folder_path.'layout.pages.page_lang')

@section('page_lang_header', trans('cms.helpers.button.update') . ' '.$page->title)

@section('page_lang_body')

    {!! Form::open(['route' => ['admin.page.update', $page->id], 'method' => 'PUT']) !!}
        @include($folder_path.'page.card.field')

        {!! Form::bsButtonUpdate() !!}
        {!! Form::bsButtonCancel(route('admin.page.index')) !!}

    {!! Form::close() !!}
@endsection

