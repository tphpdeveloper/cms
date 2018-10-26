<div class="form-group">
    @include($folder_path.'helpers.label', $label)
    {!! Form::select($name, $list, $selected , array_merge( ['class' => 'form-control'], $attributes ) ) !!}
</div>
