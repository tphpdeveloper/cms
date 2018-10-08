<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

Route::middleware('web')
    ->namespace('App\Http\Controllers\Backend')
    ->prefix('admin')
    ->group(function(){

        Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@show']);
        Route::get('map', ['as' => 'admin.map', 'uses' => 'MapController@show']);
        Route::get('setting', ['as' => 'admin.setting', 'uses' => 'SettingController@show']);

    });
