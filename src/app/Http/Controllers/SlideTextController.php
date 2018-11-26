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
use Tphpdeveloper\Cms\App\Models\Slider;

class SlideTextController extends BackendController
{

    /**
     * Update the specified resource in storage.
     *
     * @param SliderRequest $request
     * @param Slider $slider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Slider $slider)
    {

        $data = $request->except('_method', '_token', 'image_id');
        $res = $slider->images()->updateExistingPivot($request->image_id, $data);

        $data = [];
        if($res) {
            $data = [
                'status' => 'ok',
                'notification_primary' => trans('cms.notification.success.update'),
            ];
        }
        else{
            $data = [
                'status' => 'error',
                'notification_danger' => trans('cms.notification.error.something_wrong')
            ];
        }

        return response()->json($data);
    }
}
