<div class="col-md-3">
    <div class="card ">
        <div class="card-body">
            @include(config('myself.folder').'.components.form.select',[
                'name' => 'langs',
                'value' =>  $langs,
                'selected' => array_flip($langs)[app()->getLocale()],
                'attributes' => [
                    'id' => 'langs_switcher'
                ],
            ])
        </div>
    </div>
</div>


@push('script')
    <script>
    $("#langs_switcher").on('change', function(e){
        var lang = this.options[this.selectedIndex].text;
        if($("*[data-languages='*']").length){
            $("*[data-languages='*']").addClass('d-none');
            $("*[data-languages='"+lang+"']").removeClass('d-none');
        }
    });
    </script>
@endpush
