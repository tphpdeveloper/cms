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
use Tphpdeveloper\Cms\App\Http\Requests\SettingRequest;
use Tphpdeveloper\Cms\App\Models\Setting;
use Datagrid;
use Form;
use Html;
use Tphpdeveloper\Cms\App\Scopes\WithoutDisabledScope;

class SettingController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $settings = Setting::query()->paginate($this->getAdminElementOnPage());

        $grid = Datagrid::setData($settings)
            ->setColumn('', [
                'label' => '#',
            ])
            ->setColumn('name', [
                'label' => trans('cms.page.name'),
            ])
            ->setColumn('key', [
                'label' => trans('cms.page.key'),
            ])
            ->setColumn('', ['attributes' => [
                'class' => 'd-flex flex-nowrap justify-content-end'
            ]], function($model){
                $html = Html::link(route('admin.setting.edit', $model->id), Html::tag('i', '', ['class' => 'fa fa-edit']), [
                    'class' => 'btn btn-sm btn-success btn-simple',
                    'title' => trans('cms.helpers.button.edit')
                ], null, false);

//                $html .= Html::nbsp();
//                $html .= Form::open(['route' => ['admin.setting.destroy', $model->id], 'method' => 'DELETE']);
//                $html .= Form::button( Html::tag('i', '', ['class' => 'fa fa-remove']), [
//                            'class' => 'btn btn-sm btn-danger btn-simple',
//                            'title' =>  trans('cms.helpers.button.delete'),
//                            'type' => 'submit'
//                        ]);
//                $html .= Form::close();

                return $html;

            });


        //for after update, return to needed page
        $this->setPageToSession();

        return view($this->getPrefix().'setting.index')
            ->with('grid', $grid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->getPrefix().'setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SettingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SettingRequest $request)
    {
        $data = $request->except(['_method', '_token']);
        $setting = Setting::create($data);
        $redirect = redirect()->route('admin.setting.index', $this->getPageFromSession());
        if($setting) {
            $redirect->with('notification_primary', $setting->name.'.<br>'.trans('cms.notification.success.create'));
        }
        else{
            $redirect = back()
            ->with('notification_danger', $request->name[app()->getLocale()].'.<br>'.trans('cms.notification.error.something_wrong'))
            ->withInput();
        }
        return $redirect;
    }

    /**
     * Update main lang site
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMainLang(Request $request)
    {
//        $setting = Setting::where('key', 'lang')->update(['value' => $request->lang]);
        $setting = Setting::withoutGlobalScope(WithoutDisabledScope::class)
            ->where('key', 'lang_back_end')
            ->first();
        $setting->update(['value' => $request->lang]);
        $redirect = redirect()->back();
        if($setting) {
            $redirect->with('notification_primary', $setting->name.'.<br>'.trans('cms.notification.success.update'));
        }
        else{
            $redirect->with('notification_danger', $setting->name.'.<br>'.trans('cms.notification.error.something_wrong'));
        }
        return $redirect;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view($this->getPrefix().'setting.edit')
            ->with('setting', $setting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SettingRequest $request
     * @param Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        $res = $setting->update($request->all());
        $redirect = redirect()->route('admin.setting.index', $this->getPageFromSession());
        if($res) {
            $redirect->with('notification_primary', $setting->name.'.<br>'.trans('cms.notification.success.update'));
        }
        else{
            $redirect = back()
            ->with('notification_danger', $setting->name.'.<br>'.trans('cms.notification.error.something_wrong'))
            ->withInput();
        }
        return $redirect;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Setting $setting
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Setting $setting)
    {
        $name = $setting->name;
        $res = $setting->delete();
        $redirect = redirect()->route('admin.page.index', $this->getPageFromSession());
        if($res) {
            $redirect->with('notification_primary', $name.'.<br>'.trans('cms.notification.success.delete'));
        }
        else{
            $redirect->with('notification_danger', $name.'.<br>'.trans('cms.notification.error.something_wrong'));
        }
        return $redirect;
    }
}
