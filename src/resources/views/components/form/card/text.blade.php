<div class="form-group {!! $model['lang'] != '' ? 'js_lang_switcher' : '' !!} {{ $model['class'] }}" {!! $model['lang'] != '' ? 'lang="'.$model['lang'].'"' : '' !!}>
    @include($folder_path.'helpers.label', $model['label'])
    {{ Form::text( $model['name'], $model['value'] ?? Form::old($model['name']), array_merge(['class' => 'form-control'], $model['attributes'] ) ) }}
</div>
