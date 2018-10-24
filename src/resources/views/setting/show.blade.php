@extends(config('myself.folder').'.layout.app')

@section('content')
    @include(config('myself.folder').'.helpers.lang_switch')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" data-color="blue">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                   aria-controls="home" aria-selected="true">Главная</a>
                            </li>
                            <li class="nav-item" data-color="blue">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#langs" role="tab"
                                   aria-controls="profile" aria-selected="false">Языки</a>
                            </li>
                            <li class="nav-item" data-color="blue">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                   aria-controls="contact" aria-selected="false">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => ['admin.setting.update', 1], 'method' => 'PUT']) !!}
                        <div class="tab-content" id="myTabContent">
                                {{--Главная--}}
                                <div class="tab-pane fade show active " id="home" role="tabpanel"
                                     aria-labelledby="home-tab">
                                    @include(config('myself.folder').'.setting.card.main')
                                </div>
                                {{--Языки сайта--}}
                                <div class="tab-pane fade " id="langs" role="tabpanel" aria-labelledby="profile-tab">
                                    @include(config('myself.folder').'.setting.card.langs')
                                </div>
                                <div class="tab-pane fade " id="contact" role="tabpanel" aria-labelledby="contact-tab">

                                </div>

                        </div>
                        {!! Form::submit('Изменить данные', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection



