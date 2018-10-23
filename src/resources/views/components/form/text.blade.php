<div class="form-group {!! $lang != '' ? 'js_lang_switcher' : '' !!} {{ $d_none }}" {!! $lang != '' ? 'lang="'.$lang.'"' : '' !!}>
    {{ Form::label( $name, $alias, ['class' => 'control-label'] ) }}
    {{ Form::text( $name, $value, array_merge(['class' => 'form-control'], $attributes ) ) }}
</div>

