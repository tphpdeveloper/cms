@extends($prefix.'layout.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 ">
            @yield('page_image_body')
        </div>

        <div class="col-sm-4 ">
            @include($prefix.'helpers.lang_switch', ['class' => 'col-12'])
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(['id' => 'js_form_update_image', 'files' => true]) !!}
                    <div class="card" id="single">
                        @include($prefix.'image.single_card')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


    </div>
@endsection
