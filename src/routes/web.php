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


    Route::group([],function(){

        Route::get('login', 'loginController@showLoginForm')->name('login');
        Route::post('login', 'loginController@login')->name('login');
        Route::get('logout', 'loginController@logout')->name('logout');

    });

    Route::middleware('admin:admin')->group(function(){
//    Route::group([], function(){

        Route::get('/', 'DashboardController@show')->name('dashboard');
        Route::get('map', 'MapController@show')->name('map');

        Route::resources([
            'setting' => 'SettingController',
            'lang-static' => 'LangStaticController',
            'page' => 'PageController'
        ]);

    });

});
