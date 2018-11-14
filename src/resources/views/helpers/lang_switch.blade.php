@if($multilingual)
    <div class="row justify-content-end">
        <div class="{{ $class ??  'col-md-2' }}">
            <div class="card ">
                <div class="card-body">
                    {!! Form::bsSelect('', '', config('multilingual.locales'),
                        array_flip(config('multilingual.locales'))[app()->getLocale()],
                        [
                        'id' => 'js_lang_switcher',
                        'label_attributes' => [
                                'class' => 'd-none',
                            ]
                        ]
                    ) !!}
                </div>
            </div>
        </div>
    </div>


    @push('script')
        <script>

            $("#js_lang_switcher").change(function (e) {
                var lang = this.options[this.selectedIndex].text;

                if ($(".js_lang_switcher").length) {

                    $(".js_lang_switcher").addClass('d-none');
                    $(".js_lang_switcher[lang='" + lang + "']").removeClass('d-none');
                }
            });
        </script>
    @endpush
@endif
