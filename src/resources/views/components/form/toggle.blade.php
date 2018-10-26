<div class="form-check {{ $class }}">
    {!!  Form::hidden( $name, 0) !!}
    {!! Html::tag('label',
        Form::checkbox( $name, 1, $checked, array_merge(['class' => 'form-check-input'], $attributes ) ).
        Html::tag('span','',['class' => 'form-check-sign']).
        $alias,
        ['class' => 'form-check-label']
    ) !!}
</div>
