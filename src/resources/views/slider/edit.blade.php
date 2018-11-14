@extends($folder_path.'layout.pages.page_lang')

@section('page_lang_header')
    {{ trans('cms.helpers.button.update') . ' '.$slider->name}}
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
            {!! Form::open(['route' => ['admin.slider.update', $slider->id], 'method' => 'PUT']) !!}

            @include($folder_path.'slider.card.field')

            {!! Form::bsButtonSave() !!}
            {!! Form::bsButtonReset() !!}
            {!! Form::bsButtonCancel(route('admin.slider.index')) !!}

            {!! Form::close() !!}
        </div>
        {{--Изображения сайта--}}
        <div class="tab-pane fade  show active" id="images" role="tabpanel" aria-labelledby="profile-tab">
            @include($folder_path.'image.item_global', ['model' => $slider])
        </div>

    </div>
@endsection

