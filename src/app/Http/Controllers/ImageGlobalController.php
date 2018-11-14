<?php

namespace Tphpdeveloper\Cms\App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ImageGlobalController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Model $model
     */
    public function update(Request $request, $image_morph_id, $model_key, $model_name)
    {
        $model = app()->make(dirname(__NAMESPACE__,2).'\Models\\'.$model_name)->find($model_key);
//        dd($model);
        $res = $model->images()->updateExistingPivot($model, ['main' => false]);
        dd($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy()
    {

    }
}
