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


    Route::get('login', 'loginController@showLoginForm')->name('login');
    Route::post('login', 'loginController@login')->name('login');
    Route::get('logout', 'loginController@logout')->name('logout');


    Route::middleware([
        //'admin:admin',
        'admin_menu'
        ])
        ->group(function(){

        Route::get('/', 'DashboardController@show')->name('dashboard');
        Route::get('map', 'MapController@show')->name('map');
        Route::get('main-lang/update', 'SettingController@updateMainLang')->name('main_lang.update');


        Route::get('image_global', 'ImageGlobalController@index')->name('image_global.index');
        Route::put('image_global/{id}/model_key/{key}/model/{model}', 'ImageGlobalController@update')->name('image_global.update');
        Route::delete('image_global/{id}/model_key/{key}/model/{model}', 'ImageGlobalController@destroy')->name('image_global.destroy');

        Route::resources([
            'setting' => 'SettingController',
            'lang-static' => 'LangStaticController',
            'page' => 'PageController',
            'image' => 'ImageController',
            'slider' => 'SliderController',
        ]);

    });

});
