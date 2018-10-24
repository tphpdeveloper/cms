{!! Form::open(['route' => ['admin.setting.update', $setting->id], 'method' => 'PUT']) !!}

    {!! Form::bsText('name', trans('setting.edit.name'), $setting->nameTranslations->toArray(), [], true ) !!}
    {!! Form::bsText('key', trans('setting.edit.key'), $setting->key, ['form-control', 'disabled']) !!}

    @if($setting->value_translate == '')
    {!! Form::bsText('value', trans('setting.edit.value'), $setting->value) !!}
    @endif
    @if($setting->value == '')
    {!! Form::bsText('value_translate', trans('setting.edit.value'), $setting->value_translateTranslations->toArray(), [], '', true) !!}
    @endif

    {!! Form::bsNumber('o', trans('setting.edit.order'), $setting->o, ['min' => 0]) !!}
    {!! Form::bsToggle('dis', trans('setting.edit.disabled'), $setting->disabled, $setting->disabled) !!}

    @include(config('myself.folder').'.helpers.btn', [
        'text_ok' => trans('setting.button.update'),
        'route_cancel' => route('admin.setting.index'),
        'text_cancel' => trans('setting.button.cancel'),
    ])

{!! Form::close() !!}
