{!! Form::bsFormGroup(
    Form::bsLabel( $data['name'], $data['alias']).
    Form::text( $data['name'], $data['value'], array_merge(['class' => 'form-control'], $data['attributes'] ) ).
    Form::bsErrors($data['error_name']),
    $data['form_group_attributes']
) !!}
