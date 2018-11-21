{!! Form::bsText('name',
    trans('cms.page.name'),
    isset($lang) ? $lang->name : ''
) !!}


{!! Form::bsCheckbox('disabled', trans('cms.page.disabled'), (isset($lang) ? $lang->disabled : 0)) !!}
