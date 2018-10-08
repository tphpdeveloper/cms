<div class="form-group">
    @if(isset($alias))
        {{ Form::label( $name, $alias, ['class' => 'control-label'] ) }}
    @endif
    {{ Form::select($name, ($value ?? []), ($selected ?? null) , array_merge( ['class' => 'form-control'], ( $attributes ?? [] ) ) ) }}
</div>
