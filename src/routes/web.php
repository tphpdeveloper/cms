<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

Route::middleware('web')
    ->namespace('Tphpdeveloper\Cms\App\Http\Controllers')
    ->prefix('admin')
    ->name('admin.')
    ->group(function(){

        Route::get('dashboard', 'DashboardController@show')->name('dashboard');
        Route::get('map', 'MapController@show')->name('map');

        Route::resources([
            'setting' => 'SettingController',
            'lang-static' => 'LangStaticController'
        ]);

    });
