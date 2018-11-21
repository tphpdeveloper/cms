@extends($prefix.'layout.pages.page_lang')

@section('page_lang_header')
    {{ trans('cms.helpers.button.update') . ' '.$slider->name}}
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" data-color="red">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
               aria-controls="home" aria-selected="true">@lang('cms.page.tabs.main')</a>
        </li>
        <li class="nav-item" data-color="red">
            <a class="nav-link " id="profile-tab" data-toggle="tab" href="#images" role="tab"
               aria-controls="profile" aria-selected="false">@lang('cms.page.tabs.image')</a>
        </li>
    </ul>
@endsection

@section('page_lang_body')

    <div class="tab-content" id="myTabContent">
        {{--Главная--}}
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            {!! Form::open(['route' => ['admin.slider.update', $slider->id], 'method' => 'PUT']) !!}

            @include($prefix.'slider.card.field')

            {!! Form::submit(trans('cms.helpers.button.update'), [
                'class' => 'btn btn-primary btn-simple',
                'title' =>  trans('cms.helpers.button.update')
            ])!!}
            {!! Html::link(route('admin.slider.index'), trans('cms.helpers.button.cancel'), [
                'class' => 'btn btn-danger btn-simple',
                'title' =>  trans('cms.helpers.button.cancel')
            ]) !!}

            {!! Form::close() !!}
        </div>
        {{--Изображения сайта--}}
        <div class="tab-pane fade " id="images" role="tabpanel" aria-labelledby="profile-tab">
            @include($prefix.'image.global_usage.page', [
                'model' => $slider
            ])
        </div>

    </div>
@endsection

