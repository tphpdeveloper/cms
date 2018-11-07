@php
if(isset($attribute['class'])){
    $attribute['class'] .= ' form-group';
}
else{
    $attribute = [
        'class' =>'form-group'
    ];
}
@endphp
{!! Html::tag( 'div', $content, $attribute ) !!}
