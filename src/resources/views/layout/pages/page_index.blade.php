@extends($prefix.'layout.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @yield('page_index_header')
                </div>
                <div class="card-body">
                    @yield('page_index_body')
                </div>
            </div>
        </div>
    </div>
@endsection



