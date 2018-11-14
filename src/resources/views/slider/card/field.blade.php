{!! Form::bsText('name',
    trans('cms.page.name'),
    isset($slider) ? $slider->name : ''
) !!}

{!! Form::bsTextarea('text_1',
    trans('cms.page.text_1'),
    isset($slider) ? $slider->text_1Translations->toArray() : [],
    true
) !!}

{!! Form::bsTextarea('text_2',
    trans('cms.page.text_2'),
    isset($slider) ? $slider->text_2Translations->toArray() : [],
    true
) !!}

{!! Form::bsTextarea('text_3',
    trans('cms.page.text_3'),
    isset($slider) ? $slider->text_3Translations->toArray() : [],
    true
) !!}
