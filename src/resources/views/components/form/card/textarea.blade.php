@php
    if(isset($data['attributes']['class'])){
        $data['attributes']['class'] .= 'js_text_editor';
    }
    else{
        $data['attributes']['class'] = 'form-control js_text_editor';
    }
@endphp
{!! Form::bsFormGroup(
    Form::bsLabel( $data['name'], $data['alias']).
    Form::textarea( $data['name'], $data['value'], $data['attributes'] ).
    Form::bsErrors($data['error_name']),
    $data['form_group_attributes']
) !!}

{{--{{ dump($data['value']) }}--}}

@push('script')
    <script>
        $(document).ready(function () {
            //************ ckeditor *****************
            CKEDITOR.replace("{{ $data['name'] }}", {
                enterMode: 2,
                shiftEnterMode: 1,
                uiColor: '#AADC6E',
            });
            //********* end ckeditor ****************
        });
    </script>
@endpush
