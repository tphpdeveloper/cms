{!! Form::bsText('name', trans('setting.edit.name'), $setting->nameTranslations->toArray() ?? [], [], true ) !!}
{!! Form::bsText('key', trans('setting.edit.key'), $setting->key ?? '', ['form-control', 'disabled']) !!}

@if( (isset($setting->value_translate) && $setting->value_translate == '' ) || !isset($setting->value_translate) )
{!! Form::bsText('value', trans('setting.edit.value'), $setting->value ?? '') !!}
@endif
@if( (isset($setting->value) && $setting->value == '') || !isset($setting->value))
{!! Form::bsText('value_translate', trans('setting.edit.value'), $setting->value_translateTranslations->toArray() ?? [], [], '', true) !!}
@endif

{!! Form::bsNumber('o', trans('setting.edit.order'), $setting->o ?? '') !!}
