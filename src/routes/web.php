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
->prefix(config('cms.url'))
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
        Route::get('main-lang/update', 'SettingController@updateMainLang')->name('main_lang.update');


        Route::prefix('image_global')
            ->name('image_global.')
            ->group(function(){
            Route::post('/', 'ImageGlobalController@index')->name('index');
            Route::post('model_id/{key}/model/{model_name}', 'ImageGlobalController@store')->name('store');
            Route::put('{id}/model_id/{key}/model/{model_name}', 'ImageGlobalController@update')->name('update');
            Route::delete('{id}/model_id/{key}/model/{model_name}', 'ImageGlobalController@destroy')->name('destroy');
        });

        Route::resources([
            'setting' => 'SettingController',
            'lang-static' => 'LangStaticController',
            'page' => 'PageController',
            'image' => 'ImageController',
            'slider' => 'SliderController',
            'lang' => 'LangController',
        ]);

    });

});
