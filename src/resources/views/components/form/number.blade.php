<div class="form-group {{ $class }}" >
    @include(config('myself.folder').'.helpers.label', [
        'name' => $name,
        'alias' => $alias
    ])
    {{ Form::number( $name, $value ?? Form::old($name), array_merge(['class' => 'form-control'], $attributes ) ) }}
</div>
