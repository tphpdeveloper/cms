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
use Tphpdeveloper\Cms\App\Models\Setting;
use Datagrid;
use Form;
use Html;

class SettingController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $settings = Setting::whereNull('disabled')->paginate($this->getAdminElementOnPage());

        $grid = Datagrid::setData($settings)
            ->setColumn('', [
                'label' => '#',
            ])
            ->setColumn('name', [
                'label' => trans('setting.title.name'),
            ])
            ->setColumn('key', [
                'label' => trans('setting.title.key'),
                'filter' => true,
                'sort' => true
            ])
            ->setColumn('', [], function($model){
                $html = Html::link(route('admin.setting.edit', $model->id),
                    Html::tag('i', '', ['class' => 'fa fa-edit']),
                    ['class' => 'btn btn-sm text-success btn-neutral'],
                    null,
                    false);
//                $html .= Html::nbsp();
//                $html .= Form::open(['route' => ['admin.setting.destroy', $model->id], 'method' => 'DELETE']);
//                $html .= Form::button(
//                        Html::tag('i', '', ['class' => 'fa fa-remove']),
//                        ['type' => 'submit', 'class' => 'btn text-danger']
//                    );
//                $html .= Form::close();

                return $html;

            })
        ;
        return view(config('myself.folder').'.setting.index')
            ->with('grid', $grid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view(config('myself.folder').'.setting.edit')
            ->with('setting', $setting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        dump($request->all());
        //dump($setting);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        dd($setting);
    }
}
