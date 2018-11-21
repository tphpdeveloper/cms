@extends($prefix.'layout.app')

@section('content')
    @include($prefix.'helpers.lang_switch')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @yield('page_lang_header')
                </div>
                <div class="card-body">
                    @yield('page_lang_body')
                </div>
            </div>
        </div>
    </div>
@endsection
