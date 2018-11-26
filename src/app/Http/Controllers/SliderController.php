<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Http\Controllers;

use Tphpdeveloper\Cms\App\Http\Requests\SliderRequest;
use Tphpdeveloper\Cms\App\Models\Slider;
use Tphpdeveloper\Cms\App\Models\Image;
use Illuminate\Http\Request;
use Datagrid;
use Form;
use Html;
use DB;

class SliderController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $slider = Slider::query()->paginate($this->getAdminElementOnPage());

        $grid = Datagrid::setData($slider)
            ->setColumn('', [
                'label' => '#',
            ])
            ->setColumn('name', [
                'label' => trans('cms.page.name'),
            ])
            ->setColumn('', ['attributes' => [
                'class' => 'd-flex flex-nowrap justify-content-end'
            ]], function($model){
                $html = Html::link(route('admin.slider.edit', $model->id), Html::tag('i', '', ['class' => 'fa fa-edit']), [
                            'class' => 'btn btn-sm btn-success btn-simple',
                            'title' => trans('cms.helpers.button.edit')
                        ], null, false);
                $html .= Html::nbsp();
                $html .= Form::open(['route' => ['admin.slider.destroy', $model->id], 'method' => 'DELETE']);
                $html .= Form::button( Html::tag('i', '', ['class' => 'fa fa-remove']), [
                            'class' => 'btn btn-sm btn-danger btn-simple',
                            'title' =>  trans('cms.helpers.button.delete'),
                            'type' => 'submit'
                        ]);
                $html .= Form::close();

                return $html;

            })
        ;

        //for after update, return to needed page
        $this->setPageToSession();

        return view($this->getPrefix().'slider.index')
            ->with('grid', $grid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->getPrefix().'slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SliderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SliderRequest $request)
    {

        $data = $request->except(['_method', '_token']);

        //dd($data);
        $slider = Slider::create($data);
        $redirect = redirect()->route('admin.slider.index', $this->getPageFromSession());
        if($slider) {
            $redirect->with('notification_primary', $slider->name.'.<br>'.trans('cms.notification.success.create'));
        }
        else{
            $redirect = back()
            ->with('notification_danger', $request->name.'.<br>'.trans('cms.notification.error.something_wrong'))
            ->withInput();
        }
        return $redirect;
    }

    /**
     * Display the specified resource.
     *
     * @param Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Slider $slider
     * @return $this
     */
    public function edit(Slider $slider)
    {
        return view($this->getPrefix().'slider.edit')
            ->with('slider', $slider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SliderRequest $request
     * @param Slider $slider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        $res = $slider->update($request->all());
        $redirect = redirect()->route('admin.slider.index', $this->getPageFromSession());

        if($res) {
            $redirect->with('notification_primary', $slider->name.'.<br>'.trans('cms.notification.success.update'));
        }
        else{
            $redirect = back()
            ->with('notification_danger', $slider->name.'.<br>'.trans('cms.notification.error.something_wrong'))
            ->withInput();
        }
        return $redirect;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Slider $slider
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Slider $slider)
    {
        $name = $slider->name;
        DB::beginTransaction();
        $images_id = $slider->images->pluck('id')->toArray();
        $image_del = $slider->images()->detach($images_id);
        $res = $slider->delete();
        $redirect = redirect()->route('admin.slider.index', $this->getPageFromSession());
        if($res) {
            DB::commit();
            $redirect->with('notification_primary', $name.'.<br>'.trans('cms.notification.success.delete'));
        }
        else{
            DB::rollBack();
            $redirect->with('notification_danger', $name.'.<br>'.trans('cms.notification.error.something_wrong'));
        }
        return $redirect;
    }
}
