@extends($prefix.'layout.pages.page_lang')

@section('page_lang_header')
    {{ trans('cms.helpers.button.update') . ' '.$page->title }}
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" data-color="red">
            <a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab"
               aria-controls="home" aria-selected="true">@lang('cms.page.tabs.main')</a>
        </li>
        <li class="nav-item" data-color="red">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#images" role="tab"
               aria-controls="profile" aria-selected="false">@lang('cms.page.tabs.image')</a>
        </li>
    </ul>
@endsection

@section('page_lang_body')
    <div class="tab-content" id="myTabContent">
        {{--Главная--}}
        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
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
        </div>
        {{--Изображения сайта--}}
        <div class="tab-pane fade show active " id="images" role="tabpanel" aria-labelledby="profile-tab">
            @include($prefix.'image.global_usage.page', [
                'model' => $page
            ])
        </div>

    </div>
@endsection

