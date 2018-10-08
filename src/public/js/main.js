$(document).on('load', function () {

    //******** tabs in admin panel **********
    if ($('#myTab').length) {
        $('#myTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    }
    //****** end tabs in admin panel ********

    //************ ckeditor *****************
    if($(".ckeditor").length){
        CKEDITOR.replace( '.ckeditor' );
    }
    //********* end ckeditor ****************
});
