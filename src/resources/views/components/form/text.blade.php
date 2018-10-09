@if(!isset($lang) || !$lang)
    <div class="form-group">
        {{ Form::label( $name, $alias, ['class' => 'control-label'] ) }}
        {{ Form::text( $name, $value, array_merge( ['class' => 'form-control'], ( $attributes ?? [] ) ) ) }}
    </div>
@else
    @php
        $value_translate = $model->get($name)->value_translateTranslations->toArray();
        $al = $alias;
        $nm = $name;
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

        $alias = $al . ' ('.strtoupper($lang).$star.')';
        $name = $nm . '['.$lang.']';

        @endphp
        <div class="form-group js_lang_switcher {{ $d_none ?? '' }}" lang="{{ $lang ?? ''}}">
            {{ Form::label( $name, $alias, ['class' => 'control-label'] ) }}
            {{ Form::text( $name, $value, array_merge(['class' => 'form-control'], ( $attributes ?? [] ) ) ) }}
        </div>
    @endforeach
@endif

