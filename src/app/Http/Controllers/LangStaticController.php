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
use Tphpdeveloper\Cms\App\Http\Requests\LangStaticRequest;
use Tphpdeveloper\Cms\App\Models\LangStatic;
use Tphpdeveloper\Cms\Events\BuildStaticTranslateEvent;
use Datagrid;
use Form;
use Html;
use DB;

class LangStaticController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //event( new BuildStaticTranslateEvent);


        $q = LangStatic::query();

        if($request->has('filter')) {
            $q = $q->where('name->'.app()->getLocale(), 'LIKE', '%'.$request->filter['name'].'%');
        }

        if($request->has('sort')) {
            $q = $q->orderBy('name->'.app()->getLocale(), $request->sort['name']);
        }
        $lang_static = $q->paginate($this->getAdminElementOnPage());

        $grid = Datagrid::setData($lang_static)
            ->setColumn('', [
                'label' => '#',
            ])
            ->setColumn('file', [
                'label' => trans('cms.page.file'),
            ])
            ->setColumn('key', [
                'label' => trans('cms.page.key'),
            ]);
        foreach(config('multilingual.locales') as $co_lang => $lang) {
            if ($this->isMultilingual() || (!$this->isMultilingual() && app()->getLocale() == $lang)) {
                $grid->setColumn('name', [
                    'label' => trans('cms.page.name'),
                    'filter' => (app()->getLocale() != $lang ? false : true),
                    'sort' => (app()->getLocale() != $lang ? false : true),
                    'attributes' => [
                        'class' => 'js_lang_switcher '.(app()->getLocale() != $lang ? 'd-none' : ''),
                        'lang' => $lang
                    ]
                ], function($model) use ($lang){
                    $names = $model->nameTranslations->toArray();
                    return $names[$lang] ?? '';
                });
            }
        }
        $grid->setColumn('', ['attributes' => [
                'class' => 'd-flex flex-nowrap justify-content-end'
                ]], function($model){
                $html = Html::link(route('admin.lang-static.edit', $model->id), Html::tag('i', '', ['class' => 'fa fa-edit']), [
                            'class' => 'btn btn-sm btn-success btn-simple',
                            'title' => trans('cms.helpers.button.edit')
                        ], null, false);
                $html .= Html::nbsp();
                $html .= Form::open(['route' => ['admin.lang-static.destroy', $model->id], 'method' => 'DELETE']);
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

        return view($this->getPrefix().'lang_static.index')
            ->with('grid', $grid)
            ;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->getPrefix().'.lang_static.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LangStaticRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LangStaticRequest $request)
    {

        $data = $request->except('_token', '_method');
        $data['file'] = 'cms';
        $lang_static = LangStatic::create($data);
        $redirect = redirect()->route('admin.lang-static.index', $this->getPageFromSession());

        if($lang_static) {
            $redirect->with('notification_primary', $lang_static->name.'.<br>'.trans('cms.notification.success.create'));
            event( new BuildStaticTranslateEvent);
        }
        else{
            $redirect = redirect()->route('admin.lang-static.create')
            ->with('notification_danger', $request->key.'.<br>'.trans('cms.notification.error.something_wrong'))
            ->withInput();
        }
        return $redirect;
    }

    /**
     * Display the specified resource.
     *
     * @param  Tphpdeveloper\Cms\App\Models\LangStatic  $lang_static
     * @return \Illuminate\Http\Response
     */
    public function show(LangStatic $lang_static)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tphpdeveloper\Cms\App\Models\LangStatic  $lang_static
     * @return \Illuminate\Http\Response
     */
    public function edit(LangStatic $lang_static)
    {
        return view($this->getPrefix().'lang_static.edit')
            ->with('lang_static', $lang_static)
            ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LangStaticRequest $request
     * @param LangStatic $lang_static
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(LangStaticRequest $request, LangStatic $lang_static)
    {

        $data = $request->except(['_token', '_method']);
        $res = $lang_static->update($data);

        $redirect = redirect()->route('admin.lang-static.index', $this->getPageFromSession());
        if($res) {
            $redirect->with('notification_primary', $lang_static->name.'.<br>'.trans('cms.notification.success.update'));
            event( new BuildStaticTranslateEvent);
        }
        else{
            $redirect = redirect()->route('admin.lang-static.edit', $lang_static->id)
            ->with('notification_danger', $lang_static->name.'.<br>'.trans('cms.notification.error.something_wrong'))
            ->withInput();
        }
        return $redirect;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tphpdeveloper\Cms\App\Models\LangStatic  $lang_static
     * @return \Illuminate\Http\Response
     */
    public function destroy(LangStatic $lang_static)
    {
        $name = $lang_static->name;
        $res = $lang_static->delete();
        $redirect = redirect()->route('admin.lang-static.index', $this->getPageFromSession());
        if($res) {
            $redirect->with('notification_primary', $name.'.<br>'.trans('cms.notification.success.delete'));
        }
        else{
            $redirect->with('notification_danger', $name.'.<br>'.trans('cms.notification.error.something_wrong'));
        }
        return $redirect;
    }
}
