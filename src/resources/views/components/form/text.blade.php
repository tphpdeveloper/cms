@if(!isset($lang) || !$lang)
    <div class="form-group">
        {{ Form::label( $name, $alias, ['class' => 'control-label'] ) }}
        {{ Form::text( $name, $value, array_merge( ['class' => 'form-control'], ( $attributes ?? [] ) ) ) }}
    </div>
@else
    @php
        $value_translate = $model->get($name)->value_translateTranslations->toArray();
    @endphp
    @foreach($langs as $lang)
        @php
        $star =  '';
        $d_none = '';
        $value = isset($value_translate[$lang]) ? $value_translate[$lang] : '';


        if($lang == app()->getLocale()){
            $star =  ' * ';
        }
        else{
            $d_none = 'd-none';
        }

        $alias .= ' ('.strtoupper($lang).$star.')';
        $name .= '['.$lang.']';

        @endphp
        <div class="form-group {{ $d_none ?? '' }}" data-languages="{{ $lang ?? ''}}">
            {{ Form::label( $name, $alias, ['class' => 'control-label'] ) }}
            {{ Form::text( $name, $value, array_merge(['class' => 'form-control'], ( $attributes ?? [] ) ) ) }}
        </div>
    @endforeach
@endif

