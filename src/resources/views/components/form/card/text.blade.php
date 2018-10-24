<div class="form-group {!! $model['lang'] != '' ? 'js_lang_switcher' : '' !!} {{ $model['class'] }}" {!! $model['lang'] != '' ? 'lang="'.$model['lang'].'"' : '' !!}>
    @include(config('myself.folder').'.helpers.label', [
        'name' => $model['name'],
        'alias' => $model['alias']
    ])
    {{ Form::text( $model['name'], $model['value'] ?? Form::old($model['name']), array_merge(['class' => 'form-control'], $model['attributes'] ) ) }}
</div>
