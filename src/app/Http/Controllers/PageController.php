<?php

namespace Tphpdeveloper\Cms\App\Http\Controllers;

use Tphpdeveloper\Cms\App\Http\Requests\PageRequest;
use Tphpdeveloper\Cms\App\Models\Page;
use Illuminate\Http\Request;
use Datagrid;
use Form;
use Html;

class PageController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Page $page)
    {

        $settings = Page::query()->paginate($this->getAdminElementOnPage());

        $grid = Datagrid::setData($settings)
            ->setColumn('', [
                'label' => '#',
            ])
            ->setColumn('title', [
                'label' => trans('cms.page.name'),
            ])
            ->setColumn('', [], function($model){
                $html = Form::bsButtonEdit(route('admin.page.edit', $model->id));
                $html .= Html::nbsp();
                $html .= Form::open(['route' => ['admin.page.destroy', $model->id], 'method' => 'DELETE']);
                $html .= Form::bsButtonDelete();
                $html .= Form::close();

                return $html;

            })
        ;
        return view($this->getFolderPath().'page.index')
            ->with('grid', $grid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->getFolderPath().'page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PageRequest $request)
    {

        $data = $request->except(['_method', '_token']);

        if(array_sum(array_map('is_null', $data['meta_title'])) == count($data['meta_title'])) {
            $data['meta_title'] = $request->input('title');
        }
        if(array_sum(array_map('is_null', $data['meta_description'])) == count($data['meta_description'])) {
            $data['meta_description'] = $request->input('title');
        }
        //dd($data);
        $page = Page::firstOrCreate($data);
        $redirect = redirect()->route('admin.page.index');
        if($page) {
            $redirect->with('notification_primary', $page->title.'.<br>'.trans('cms.notification.success.create'));
        }
        else{
            $redirect->with('notification_danger', $page->title.'.<br>'.trans('cms.notification.error'));
        }
        return $redirect;
    }

    /**
     * Display the specified resource.
     *
     * @param Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Page $page
     * @return $this
     */
    public function edit(Page $page)
    {
        return view($this->getFolderPath().'page.edit')
            ->with('page', $page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PageRequest $request
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PageRequest $request, Page $page)
    {
//        dd($request->all());

        $page->update($request->all());
        $redirect = redirect()->route('admin.page.index');
        if($page) {
            $redirect->with('notification_primary', $page->title.'.<br>'.trans('cms.notification.success.update'));
        }
        else{
            $redirect->with('notification_danger', $page->title.'.<br>'.trans('cms.notification.error'));
        }
        return $redirect;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Page $page)
    {
        $title = $page->title;
        $page->delete();
        $redirect = redirect()->route('admin.page.index');
        if($page) {
            $redirect->with('notification_primary', $title.'.<br>'.trans('cms.notification.success.delete'));
        }
        else{
            $redirect->with('notification_danger', $title.'.<br>'.trans('cms.notification.error'));
        }
        return $redirect;
    }
}
