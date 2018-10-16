<?php

namespace Tphpdeveloper\Cms\App\Http\Controllers;

use Tphpdeveloper\Cms\App\Models\Setting;
use Request;
use Cache;

class SettingController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        dump(Request::get('f', []));

        $setting = Setting::query()->paginate($this->getAdminElementOnPage());
        $grid = new \Datagrid($setting, Request::get('f', []));

        $grid
            ->setColumn('id', '#')
            ->setColumn('name', 'Имя настройки', [
                'sortable'    => true,
                'has_filters' => true,
            ])

            ->setActionColumn([
                'attributes' => [
                    'class' => 'text-right'
                ],
                'wrapper' => function ($value, $row) {
                    return '<a href="' . route('admin.setting.show', $row->id) . '" title="Edit" class="btn">
                                <span class="fa fa-pencil" aria-hidden="true"></span>
                            </a>
					        <a href="' . route('admin.setting.destroy', $row->id) . '" title="Delete" data-method="DELETE" class="btn text-danger" data-confirm="Are you sure?">
					            <span class="fa fa-remove" aria-hidden="true"></span>
                            </a>';
                }
            ]);

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
        //
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
        //
    }
}
