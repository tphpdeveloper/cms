<div class="card-header">
    <div class="thumbnail text-center">
        <div>

            <img src="{{ isset($image) ? $image->url : '' }}"
                 alt="{{ isset($image) ? $image->name : '' }}"
                 title="{{ isset($image) ? $image->title : '' }}"
                 class="js_has_image @if(!isset($image)) d-none @endif "
            >
            <img src="{{ asset($folder_path.'/img/no_image.jpg') }}"
                 alt="{{ !isset($image) ? trans('cms.page.no_image') : '' }}"
                 title="{{ !isset($image) ? trans('cms.page.no_image') : '' }}"
                 class="js_no_image @if(isset($image)) d-none @endif"
            >
            <div class="caption">
                <p class="text-center">{{ isset($image) ? $image->title : trans('cms.page.name_image') }}</p>
            </div>
        </div>
    </div>
</div>
<div class="card-body">
    {!! Form::bsText('alt', 'Alt',  isset($image) ? $image->altTranslations->toArray() : '' , true) !!}
    {!! Form::bsText('title', 'Title', isset($image) ? $image->titleTranslations->toArray() : '', true) !!}
</div>
<div class="card-footer">
    {!! Form::hidden('route', isset($image) ? route('admin.image.update', $image->id) : '') !!}
    <div class="js_upload_image_parent d-none flex-wrap justify-content-xl-between justify-content-md-between justify-content-lg-center justify-content-sm-center">
        {!! Form::button(trans('cms.helpers.button.save'), ['class' => 'btn btn-primary mb-sm-1 mb-lg-1', 'onclick' => 'storeImage()']) !!}
        {!! Form::button(trans('cms.helpers.button.edit'), ['class' => 'btn btn-danger mb-sm-1 mb-lg-1', 'onclick' => 'deletePreviewImage()']) !!}
    </div>
    <div class="js_update_image_parent d-flex flex-wrap justify-content-xl-between justify-content-md-between justify-content-lg-center justify-content-sm-center">
        {!! Html::tag('label',
            trans('cms.helpers.button.upload').
            Form::file('preview_image', ['class' => 'd-none js_upload_preview_image', 'id' => 'upload_preview_image', 'onchange' => 'uploadPreviewImage(this)']),
            [
            'class' => 'btn btn-default mb-sm-1 mb-lg-1',
            'for' => 'upload_preview_image'
            ]
        ) !!}
        {!! Form::button(trans('cms.helpers.button.update'), ['class' => 'btn btn-primary btn-simple mb-sm-1 mb-lg-1', 'onclick' => 'updateImage("'.( isset($image) ? $image->id : 0 ).'")']) !!}

    </div>
</div>


