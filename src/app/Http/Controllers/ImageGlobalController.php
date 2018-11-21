<?php

namespace Tphpdeveloper\Cms\App\Http\Controllers;

use Illuminate\Http\Request;
use Tphpdeveloper\Cms\App\Models\Image;
use Tphpdeveloper\Cms\App\Models\ImageMorph;
use Carbon\Carbon;
use DB;

class ImageGlobalController extends BackendController
{
    private $namespace = '';

    public function __construct(Request $request)
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
    public function store(Request $request, $model_id, $model_name)
    {
        $namespace = $this->namespace.$model_name;
        $model = app()->make($namespace)->find($model_id);
        $items = '';
        $true = [];
        if(count($images_id = $request->images)){
            DB::beginTransaction();
            $images = Image::find($images_id);
            foreach($images as $image){
                $inserted = ImageMorph::create([
                    'image_id' => $image->id,
                    'image_morph_type' => $namespace,
                    'image_morph_id' => $model_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                if($inserted){
                    $true[] = 1;
                    $items .= view($this->getPrefix().'image.global_usage.page_item')
                    ->with('image', $image)
                    ->with('pivot_id', $inserted->id)
                    ->with('model_key', $model_id)
                    ->with('model_name', $model_name);
                }
            }


        }
        //if all saved saccesful
        if(count($true) == count($images_id)){
            DB::commit();
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
        DB::beginTransaction();
        $to_disable = ImageMorph::where([
            ['image_morph_type', $namespace],
            ['image_morph_id', $model_key],
        ])->update(['main' => false]);
        $to_main = ImageMorph::find($image_morph_id)->update(['main' => true]);
        $data = [];
        //$to_disable=false;
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
