@include(config('myself.folder').'.components.form.select', [
    'alias' => $model->get('langs')->label->name,
    'name' => 'langs',
    'value' => $model->get('langs')->value,
])
