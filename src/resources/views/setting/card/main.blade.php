@include(config('myself.folder').'.components.form.text', [
    'alias' => $model->get('main_title')->label->name,
    'name' => 'main_title',
    'lang' => true,
])

@include(config('myself.folder').'.components.form.text', [
    'alias' => $model->get('main_description')->label->name,
    'name' => 'main_description',
    'lang' => true,
])


@include(config('myself.folder').'.components.form.select', [
    'alias' => $model->get('color_scheme')->label->name,
    'name' => 'color_scheme',
    'value' => $model->get('color_scheme')->value,
])


@include(config('myself.folder').'.components.form.text', [
    'alias' => $model->get('count_item_on_admin_page')->label->name,
    'name' => 'count_item_on_admin_page',
    'value' => $model->get('count_item_on_admin_page')->value,
])
