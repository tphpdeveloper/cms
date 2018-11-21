{!! Form::bsText('name',
    trans('cms.page.name'),
    isset($setting) ? $setting->name : '',
    false,
    ['required']
) !!}

{!! Form::bsText('key', trans('cms.page.key'), $setting->key ?? '', false, [isset($setting) ? 'disabled'  : ''] ) !!}

@if( (isset($setting->value_translate) && $setting->value_translate == '' ) || !isset($setting->value_translate) )
{!! Form::bsText('value', trans('cms.page.value'), $setting->value ?? '') !!}
@endif
@if( (isset($setting->value) && $setting->value == '') || !isset($setting->value))
{!! Form::bsText('value_translate',
    trans('cms.page.value'),
    isset($setting) ? $setting->value_translateTranslations->toArray() : [],
    true) !!}
@endif

{!! Form::bsNumber('o', trans('cms.page.order'), $setting->o ?? 0) !!}
