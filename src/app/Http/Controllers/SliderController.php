<?php

namespace Tphpdeveloper\Cms\App\Http\Controllers;

use Tphpdeveloper\Cms\App\Http\Requests\SliderRequest;
use Tphpdeveloper\Cms\App\Models\Slider;
use Tphpdeveloper\Cms\App\Models\Image;
use Illuminate\Http\Request;
use Datagrid;
use Form;
use Html;

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
                'name' => trans('cms.page.name'),
            ])
            ->setColumn('', [], function($model){
                $html = Form::bsButtonEdit(route('admin.slider.edit', $model->id));
                $html .= Html::nbsp();
                $html .= Form::open(['route' => ['admin.slider.destroy', $model->id], 'method' => 'DELETE']);
                $html .= Form::bsButtonDelete();
                $html .= Form::close();

                return $html;

            })
        ;
        return view($this->getFolderPath().'slider.index')
            ->with('grid', $grid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->getFolderPath().'slider.create');
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
        $slider = Slider::firstOrCreate($data);
        $redirect = redirect()->route('admin.slider.index');
        if($slider) {
            $redirect->with('notification_primary', $slider->name.'.<br>'.trans('cms.notification.success.create'));
        }
        else{
            $redirect->with('notification_danger', $slider->name.'.<br>'.trans('cms.notification.error.something_wrong'));
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
        return view($this->getFolderPath().'slider.edit')
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
//        dd($request->all());

        $slider->update($request->all());
        $redirect = redirect()->route('admin.slider.index');
        if($slider) {
            $redirect->with('notification_primary', $slider->name.'.<br>'.trans('cms.notification.success.update'));
        }
        else{
            $redirect->with('notification_danger', $slider->name.'.<br>'.trans('cms.notification.error.something_wrong'));
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
        $slider->delete();
        $redirect = redirect()->route('admin.slider.index');
        if($slider) {
            $redirect->with('notification_primary', $name.'.<br>'.trans('cms.notification.success.delete'));
        }
        else{
            $redirect->with('notification_danger', $name.'.<br>'.trans('cms.notification.error.something_wrong'));
        }
        return $redirect;
    }
}
