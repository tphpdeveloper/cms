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
use Datagrid;
use Form;
use Html;
use Tphpdeveloper\Cms\App\Http\Requests\LangRequest;
use Tphpdeveloper\Cms\App\Models\Lang;

class LangController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $langs = Lang::all();

        $grid = Datagrid::setData($langs)
            ->setColumn('', [
                'label' => '#',
            ])
            ->setColumn('name', [
                'label' => trans('cms.page.name'),
            ])
            ->setColumn('', ['attributes' => [
                'class' => 'd-flex flex-nowrap justify-content-end'
                ]], function($model){
                $html = Html::link(route('admin.lang.edit', $model->id), Html::tag('i', '', ['class' => 'fa fa-edit']), [
                            'class' => 'btn btn-sm btn-success btn-simple',
                            'title' => trans('cms.helpers.button.edit')
                        ], null, false);
                $html .= Html::nbsp();
                $html .= Form::open(['route' => ['admin.lang.destroy', $model->id], 'method' => 'DELETE']);
                $html .= Form::button( Html::tag('i', '', ['class' => 'fa fa-remove']), [
                            'class' => 'btn btn-sm btn-danger btn-simple',
                            'title' =>  trans('cms.helpers.button.delete'),
                            'type' => 'submit'
                        ]);
                $html .= Form::close();

                return $html;

            });

        //for after update, return to needed page
        $this->setPageToSession();

        return view($this->getPrefix().'lang.index')
            ->with('grid', $grid)
            ;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->getPrefix().'.lang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\LangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LangRequest $request)
    {
        $data = $request->except('_token', '_method');
        $lang = Lang::create($data);
        $redirect = redirect()->route('admin.lang.index', $this->getPageFromSession());

        if($lang) {
            $redirect->with('notification_primary', $lang->name.'.<br>'.trans('cms.notification.success.create'));
        }
        else{
            $redirect = redirect()->route('admin.lang.create')
                ->with('notification_danger', $request->name.'.<br>'.trans('cms.notification.error.something_wrong'))
                ->withInput();
        }
        return $redirect;
    }

    /**
     * Display the specified resource.
     *
     * @param  Tphpdeveloper\Cms\App\Models\Lang  $lang
     * @return \Illuminate\Http\Response
     */
    public function show(Lang $lang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tphpdeveloper\Cms\App\Models\Lang  $lang
     * @return \Illuminate\Http\Response
     */
    public function edit(Lang $lang)
    {
        return view($this->getPrefix().'.lang.edit')
            ->with('lang', $lang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Tphpdeveloper\Cms\App\Models\Lang  $lang
     * @return \Illuminate\Http\Response
     */
    public function update(LangRequest $request, Lang $lang)
    {
        $data = $request->except(['_token', '_method']);
        $res = $lang->update($data);

        $redirect = redirect()->route('admin.lang.index', $this->getPageFromSession());
        if($res) {
            $redirect->with('notification_primary', $lang->name.'.<br>'.trans('cms.notification.success.update'));
        }
        else{
            $redirect = redirect()->route('admin.lang.edit', $lang->id)
                ->with('notification_danger', $lang->name.'.<br>'.trans('cms.notification.error.something_wrong'))
                ->withInput();
        }
        return $redirect;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tphpdeveloper\Cms\App\Models\Lang  $lang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lang $lang)
    {
        $name = $lang->name;
        $res = $lang->delete();
        $redirect = redirect()->route('admin.lang.index', $this->getPageFromSession());
        if($res) {
            $redirect->with('notification_primary', $name.'.<br>'.trans('cms.notification.success.delete'));
        }
        else{
            $redirect->with('notification_danger', $name.'.<br>'.trans('cms.notification.error.something_wrong'));
        }
        return $redirect;
    }
}
