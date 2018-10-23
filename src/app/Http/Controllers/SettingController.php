<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Http\Controllers;

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
//        $settings = Setting::all();
        $grid = Datagrid::setData($settings)
            ->setColumn('', [
                'label' => '#',
                'sort' => true
            ])
            ->setColumn('name', [
                'label' => trans('settings.title.name'),
                'filter' => true,
                'sort' => true
            ])
            ->setColumn('key', [
                'label' => trans('settings.title.key'),
                'filter' => true,
                'sort' => true
            ])
            ->setColumn('value_translate', [
                'label' => trans('settings.title.value'),
                'filter' => true
            ])
            ->setColumn('', [], function($model){
                $html = Html::link(route('admin.setting.edit', $model->id), Html::tag('i', '', ['class' => 'fa fa-edit']),
                    ['class' => 'btn text-success'],
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Tphpdeveloper\Cms\App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tphpdeveloper\Cms\App\Models\Setting  $setting
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
     * @param  \Illuminate\Http\Request  $request
     * @param  Tphpdeveloper\Cms\App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tphpdeveloper\Cms\App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        dd($setting);
    }
}
