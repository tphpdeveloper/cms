<?php

namespace Tphpdeveloper\Cms\App\Http\Controllers;

use Illuminate\Http\Request;
use Tphpdeveloper\Cms\App\Models\ImageMorph;
use DB;

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
        $namespace = dirname(__NAMESPACE__,2).'\Models\\'.$model_name;
        $model = app()->make($namespace)->find($model_key);
        DB::beginTransaction();
        $to_disable = ImageMorph::where([
            ['image_morph_type', $namespace],
            ['image_morph_id', $model_key],
        ])->update(['main' => false]);
        $to_main = ImageMorph::find($image_morph_id)->update(['main' => true]);
        $data = [];
        $to_disable=false;
        if($to_disable && $to_main) {
            DB::commit();
            $data = [
                'status' => 'ok',
                'notification_primary' => trans('cms.notification.success.update'),
            ];
        }
        else{
            DB::rollBack();
            $data = [
                'status' => 'error',
                'notification_danger' => trans('cms.notification.error.something_wrong')
            ];
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Request $request, $image_morph_id, $model_key, $model_name)
    {
        $namespace = dirname(__NAMESPACE__,2).'\Models\\'.$model_name;

        DB::beginTransaction();
        $morph = ImageMorph::find($image_morph_id);
        $main = $morph->main;
        //if delet main image
        $to_main = false;
        if($main){
            $to_main = ImageMorph::where([
                ['id', '<>', $image_morph_id],
                ['image_morph_type', $namespace],
                ['image_morph_id', $model_key],
            ])->first();
            if($to_main) {
                $to_main->update(['main' => true]);
            }
        }
        $morph = $morph->destroy($image_morph_id);
        $data = [];
        if($morph) {
            DB::commit();
            $data = [
                'status' => 'ok',
                'notification_primary' => trans('cms.notification.success.delete'),
            ];
            if($to_main){
                $data['to_main_id'] = $to_main->id;
            }
            $data['count'] = ImageMorph::where([
                                ['image_morph_type', $namespace],
                                ['image_morph_id', $model_key],
                            ])->count();
        }
        else{
            DB::rollBack();
            $data = [
                'status' => 'error',
                'notification_danger' => trans('cms.notification.error.something_wrong')
            ];
        }
        return response()->json($data);
    }
}
