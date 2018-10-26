<div class="form-group {{ $class }}" >
    @include($folder_path.'helpers.label', $label)
    {{ Form::number( $name, $value ?? Form::old($name), array_merge(['class' => 'form-control', 'min' => 0], $attributes ) ) }}
</div>
