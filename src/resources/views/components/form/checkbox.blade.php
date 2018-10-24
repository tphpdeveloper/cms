<div class="form-check {{ $class }}">
    {!! Html::tag('label',
        Form::checkbox( $name, $value ?? Form::old($name), $checked, array_merge(['class' => 'form-check-input'], $attributes ) ).
        Html::tag('span','',['class' => 'form-check-sign']).
        $alias,
        ['class' => 'form-check-label']
    ) !!}

</div>
