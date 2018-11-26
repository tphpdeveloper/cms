<?php

namespace Tphpdeveloper\Cms\App\Http\Controllers;

use Illuminate\Http\Request;
use Tphpdeveloper\Cms\App\Models\Image;
use Tphpdeveloper\Cms\App\Models\ImageMorph;
use Carbon\Carbon;
use DB;

class ImageMorphController extends BackendController
{
    private $namespace = '';

    public function __construct()
    {
        $this->namespace = dirname(__NAMESPACE__,2).'\Models\\';
    }

    /**
     * Show all images for select
     *
     */
    public function index()
    {
        $images = Image::all();
        $data = [];

        if($images) {
            $data = [
                'status' => 'ok',
                'notification_primary' => trans('cms.notification.success.select'),
                'items' => view($this->getPrefix().'image.global_usage.item_modal')
                    ->with('images', $images)
                    ->render()
            ];
        }
        else{
            $data = [
                'status' => 'error',
                'notification_danger' => trans('cms.notification.error.something_wrong')
            ];
        }
        return response()->json($data);
    }

    /**
     * Add to modal new images
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $model_key, $model_name)
    {
        $namespace = $this->namespace.$model_name;
        $model = app()->make($namespace)->find($model_key);
        $items = '';
        $true = [];

        //attach to model image
        if(count($images_id = $request->images)){
            DB::beginTransaction();
            $pivot_images = $model->images()->wherePivotIn('image_id', $images_id)->get();
            $pivot_ids = $pivot_images->pluck('id')->toArray();

            //for add unique images
            $images_id = array_diff($images_id, $pivot_ids);
            if(!count($images_id)){
                return response()->json([
                    'status' => 'error',
                    'notification_danger' => trans('cms.notification.error.all_added_images_exists')
                ]);
            }


            $images = Image::find($images_id);
            foreach($images as $image){
                $attached = $model->images()->save($image);
                $id = DB::getPdo()->lastInsertId();
                if($attached){
                    $true[$id] = $image->id;
                }
            }
        }

        //if all saved saccesful
        if(count($true) == count($images_id)){
            DB::commit();
            $to_main = $this->setMainImage($namespace, $model_key);

            //create view each image for insert to body
            $model = app()->make($namespace)->find($model_key);
            foreach($true as $attach_id => $image_id){
                $items .= view($request->view)
                    ->with('image', $model->images()->where('image_id', $image_id)->first())
                    ->with('pivot_id', $attach_id)
                    ->with('model_key', $model_key)
                    ->with('model_name', $model_name);
            }


            $data = [
                'status' => 'ok',
                'notification_primary' => trans('cms.notification.success.create'),
                'items' => $items
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
     * Update main image in model
     *
     * @param Request $request
     * @param $image_morph_id
     * @param $model_key
     * @param $model_name
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $image_morph_id, $model_key, $model_name)
    {
        $namespace = $this->namespace.$model_name;
        $model = app()->make($namespace)->find($model_key);
        $main = $model->images()->wherePivot('main', 1)->first();

        DB::beginTransaction();

        //for create main image
        if($main) {
            $images = $model->images()->allRelatedIds();
            foreach($images as $image){
                $model->images()->updateExistingPivot($image, ['main' => false]);
            }
        }
        $image = $model->images()->wherePivot('id', $image_morph_id)->first();
        $to_main = $model->images()->updateExistingPivot($image->id, ['main' => true]);

        $data = [];
        //$to_disable=false;
        if($to_main) {
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
     * Remove the image from model.
     *
     * @param Request $request
     * @param $image_morph_id
     * @param $model_key
     * @param $model_name
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $image_morph_id, $model_key, $model_name)
    {
        $namespace = $this->namespace.$model_name;
        $model = app()->make($namespace)->find($model_key);
        DB::beginTransaction();
        $image_d = $model->images()->wherePivot('id', $image_morph_id)->first();
        //dd($image_d);
        $morph = $model->images()->detach($image_d->id);
        $data = [];
        if($morph) {
            DB::commit();
            $data = [
                'status' => 'ok',
                'notification_primary' => trans('cms.notification.success.delete'),
            ];
            $to_main = $this->setMainImage($namespace, $model_key);
            //dd($to_main);
            if($to_main){
                $data['to_main_id'] = $to_main->id;
            }
            $data['count'] = $model->images()->count();

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

    private function setMainImage($namespace, $model_key)
    {
        $model = app()->make($namespace)->find($model_key);
        $main = $model->images()->wherePivot('main', 1)->first();
        //for create main image
        if(!$main) {
            $main = $model->images()->first();
            if($main) {
                $model->images()->updateExistingPivot($main->id, ['main' => 1]);
                $main = $model->images()->wherePivot('main', 1)->first();
            }
            else{
                return false;
            }
        }
        return $main->pivot;
    }
}
