<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Http\Controllers;

use Illuminate\Http\Request;
use Tphpdeveloper\Cms\App\Http\Requests\ImageRequest;
use Tphpdeveloper\Cms\App\Models\Image as ImageModel;
use Image;
use File;
use DB;

class ImageController extends BackendController
{

    public function index(Request $request)
    {
        $images = ImageModel::orderBy('id', 'desc')->paginate($this->getAdminElementOnPage());
//        $img_path = substr($this->getFolderPath(), 0, -1).'/img/no_image.jpg';
//        $w = 400;
//        $h = 200;
//        $img = Image::canvas($w, $h, '#e3e3e3');
//        // use callback to define details
//        $img->text("NO IMAGE", $w/2, ($h/5 * 2), function($font)  {
//            $font->file(public_path(substr($this->getFolderPath(), 0, -1).'/fonts/Monoton-Regular.ttf') );
//            $font->color('#d35f7a');
//            $font->size(50);
//            $font->align('center');
//            $font->valign('top');
////            $font->angle(45);
//        })->save(public_path($img_path));


        return view($this->getFolderPath().'image.content')
            ->with('images', $images)
            ;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param ImageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ImageRequest $request)
    {
        $data = $request->except(['_method', '_token', 'route', 'preview_image']);

        $image = $request->file('preview_image');
        $suffix = '.'.$image->getClientOriginalExtension();
        $name = str_slug(basename($image->getClientOriginalName(), $suffix)).$suffix;
        $data['name'] = $name;
        $image->move(public_path('uploads/images'), $name);

        $image = ImageModel::where('name', 'LIKE', $name)->first();
        if($image){
            $data = [
                'notification_info' => $image->title.'.<br>'.trans('cms.notification.error.image_exists'),
            ];
        }
        else {
            $image = ImageModel::create($data);
            $data = [];
            if ($image) {
                $data = [
                    'status' => 'ok',
                    'notification_primary' => $image->title . '.<br>' . trans('cms.notification.success.create'),
                    'form' => view($this->getFolderPath() . 'image.single_card')->render(),
                    'item' => view($this->getFolderPath() . 'image.item')->with('image', $image)->render(),
                ];
            } else {
                $data = [
                    'status' => 'error',
                    'notification_danger' => $image->title . '.<br>' . trans('cms.notification.error.something_wrong')
                ];
            }
        }

        //dd($data);

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param ImageModel  $image
     * @return \Illuminate\Http\Response
     */
    public function show(ImageModel $image)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ImageModel $image
     * @return $this
     */
    public function edit(ImageModel $image)
    {
        return view($this->getFolderPath().'image.single_card')
            ->with('image', $image)
            ;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ImageRequest $request
     * @param ImageModel $setting
     * @return \Illuminate\Http\Response
     */
    public function update(ImageRequest $request, ImageModel $image)
    {
        //dd($image);

        $res = $image->update($request->except(['_method', '_token']));
        $data = [];
        if($res) {
            $data = [
                'status' => 'ok',
                'notification_primary' => $image->title.'.<br>'.trans('cms.notification.success.update'),
                'form' => view($this->getFolderPath().'image.single_card')->render(),
                'item' => view($this->getFolderPath().'image.item')->with('image', $image)->render(),
            ];
        }
        else{
            $data = [
                'status' => 'error',
                'notification_danger' => $image->title.'.<br>'.trans('cms.notification.error.something_wrong')
            ];
        }

        //dd($data);

        return response()->json($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ImageModel $setting
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, ImageModel $image)
    {
        $name = $image->title;
        DB::beginTransaction();
        $res = $image->delete();
        $data = [];
        if($res) {
            $data = [
                'status' => 'ok',
                'notification_primary' => $name.'.<br>'.trans('cms.notification.success.delete'),
            ];
            File::delete(public_path('uploads/images/'.$image->name));
            DB::commit();
        }
        else{
            $data = [
                'status' => 'error',
                'notification_danger' => $name.'.<br>'.trans('cms.notification.error.something_wrong')
            ];
            DB::rollBack();
        }
        return response()->json($data);

    }
}
