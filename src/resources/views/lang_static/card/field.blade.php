@php
$data = [];
if(isset($lang_static)){
    $data['disabled'] = 'disabled';
}
@endphp
{!! Form::bsText('key',
    trans('cms.page.key'),
    isset($lang_static) ? $lang_static->key : '',
    false,
    $data
) !!}

@php
if(isset($lang_static)){
    $names = $lang_static->nameTranslations->toArray();
}
@endphp
@foreach(config('multilingual.locales') as $lang)
    @if($multilingual || (!$multilingual && app()->getLocale() == $lang))
        {!! Form::bsText('name['.$lang.']',
            trans('cms.page.name').($multilingual ? ' ('.strtoupper($lang).')' : ''),
            isset($lang_static) ? (isset($names[$lang]) ? $names[$lang] : '') : ''
        ) !!}
    @endif
@endforeach
