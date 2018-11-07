{!! Form::bsText('title',
    trans('cms.page.name'),
    isset($page) ? $page->titleTranslations->toArray() : [],
    true
) !!}

{!! Form::bsText('slug',
    trans('cms.page.key'),
    isset($page) ? $page->slug : ''
) !!}

{!! Form::bsTextarea('short_description',
    trans('cms.page.short_description'),
    isset($page) ? $page->short_descriptionTranslations->toArray() : [],
    true
) !!}

{!! Form::bsTextarea('description',
    trans('cms.page.description'),
    isset($page) ? $page->descriptionTranslations->toArray() : [],
    true
) !!}

{!! Form::bsText('meta_title',
    trans('cms.page.meta_title'),
    isset($page) ? $page->meta_titleTranslations->toArray() : [],
    true
) !!}

{!! Form::bsText('meta_description',
    trans('cms.page.meta_description'),
    isset($page) ? $page->meta_descriptionTranslations->toArray() : [],
    true
) !!}
