@if($errors->has($name))
    @php $errors_string = '';
    foreach($errors->get($name) as $error ){
        $errors_string .= Html::tag('span', $error, ['class' => 'form-text text-danger'] );
    }
    @endphp
    {!! $errors_string !!}
@endif
