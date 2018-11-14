<?php

/**
 * Tphpdeveloper/CMS
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/CMS
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms;

use App;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Tphpdeveloper\Cms\App\Console\Commands\CmsVendorPublish;
use Tphpdeveloper\Cms\App\Http\Middleware\AdminMenuMiddleware;
use Tphpdeveloper\Cms\App\Http\Middleware\AdminMiddleware;
use Tphpdeveloper\Cms\App\Http\ViewComposer\ColorSidebarComposer;
use Tphpdeveloper\Cms\App\Http\ViewComposer\LangComposer;
use Tphpdeveloper\Cms\App\Models\Lang;
use Tphpdeveloper\Cms\App\Models\Setting;
use Tphpdeveloper\Cms\App\Scopes\SettingWithoutDisabledScope;
use View;
use File;
use Form;
use Html;
use Log;
use Schema;

class CmsServiceProvider extends ServiceProvider
{

    private $folder_path = '';

    /**
     *  Register application services.
     */
    public function register()
    {
		$this->registerFactory();

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->folder_path = config('myself.folder');
        $this->registerMiddleware();
        $this->registerResources();
        $this->registerViewComposerData();
        $this->registerCommands();
        $this->publishesFile();
        $this->makeComponentsForm();
        $this->shareGlobalVariables();
        $this->closureBootedForCommangs();

//        dump($this->app);

    }

    /**
     * Registering middleware
     *
     * @return void
     */
    private function registerMiddleware(): void
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('admin', AdminMiddleware::class);
        $router->aliasMiddleware('admin_menu', AdminMenuMiddleware::class);
    }

    /**
     * Registering resource
     * e.g. Route, View, Database path & Translation
     *
     * @return void
     */
    private function registerResources(): void
    {

        if(File::exists( base_path( 'routes/' . $this->folder_path . '/web.php' ) ) ) {
            $this->loadRoutesFrom( base_path( 'routes/' . $this->folder_path . '/web.php' ) );
        }
        $this->loadMigrationsFrom( __DIR__ . '/database/migrations' );
        //$this->loadTranslationsFrom( base_path( 'resources/lang/' . $this->folder_path ), config('myself.prefix') );
        //$this->loadViewsFrom( base_path( 'resources/views/' . $this->folder_path ), config('myself.prefix') );

    }

    /**
     * Registering Class Based View Composer
     *
     * @return void
     */
    private function registerViewComposerData(): void
    {

        View::composer([
            $this->folder_path.'.layout.sidebar'
        ], ColorSidebarComposer::class);


    }

    /**
     * Registration myself artisan commands
     */
    private function registerCommands(): void
    {
        if($this->app->runningInConsole()){
            $this->commands([
                CmsVendorPublish::class
            ]);
        }

    }

    /**
     * Publish file
     */
    private function publishesFile(): void
    {
        $this->publishes([
            __DIR__.'/config/myself.php' => config_path('myself.php')
        ], 'tphpdeveloper_backend_config');

		$this->publishes([
            __DIR__.'/public' => public_path( $this->folder_path )
        ], 'tphpdeveloper_backend_public');

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/'.$this->folder_path )
        ], 'tphpdeveloper_backend_views');

		$this->publishes([
            __DIR__.'/routes' => base_path('routes/'.$this->folder_path )
        ], 'tphpdeveloper_backend_routes');

        $this->publishes([
            base_path('vendor/caouecs/laravel-lang/src/ru') => resource_path('lang/ru')
        ], 'caouecs_lang_tphpdeveloper');


    }

    /**
     * Load factory class to container
     */
    private function registerFactory(): void
    {
		$this->app->make(Factory::class)->load(__DIR__ . '/database/factories');
	}

    /**
     * Create components for Form facade
     */
	private function makeComponentsForm(): void
    {
        Form::component('bsFormGroup', $this->folder_path.'.components.form.helpers.form_group',[
            'content' => '',
            'attribute' => [],
        ]);

        Form::component('bsLabel', $this->folder_path.'.components.form.helpers.label',[
            'name' => '',
            'alias' => '',
            'attributes' => [],
            'entities' => true,
        ]);

        Form::component('bsErrors', $this->folder_path.'.components.form.helpers.errors',[
            'name' => '',
        ]);

        /********* Group components form BEGIN *********/
        Form::component('bsText', $this->folder_path.'.components.form.text', [
            'name',
            'alias' => '',
            'value' => '',
            'multiple_lang' => false,
            'attributes' => [],
            'textarea'=> false
        ]);

        Form::component('bsTextarea', $this->folder_path.'.components.form.text', [
            'name',
            'alias' => '',
            'value' => '',
            'multiple_lang' => false,
            'attributes' => [],
            'textarea'=> true
        ]);

        Form::component('bsNumber', $this->folder_path.'.components.form.number', [
            'name',
            'alias' => '',
            'value' => '',
            'attributes' => [],
        ]);

        Form::component('bsCheckbox', $this->folder_path.'.components.form.checkbox', [
            'name',
            'alias' => '',
            'checked' => 0,
            'attributes' => [],
        ]);

        Form::component('bsSelect', $this->folder_path.'.components.form.select', [
            'name',
            'alias' => '',
            'list' => [],
            'selected' => null,
            'attributes' => [],
        ]);
        /******** Group components form END ************/

        /********* Group components button BEGIN *********/
        Form::component('bsButtonDelete', $this->folder_path.'.components.form.helpers.buttons.button.btn_delete', [
            'btn_delete_name' => null,
            'btn_delete_attributes' => [],
        ]);

        Form::component('bsButtonReset', $this->folder_path.'.components.form.helpers.buttons.input.btn_inp_reset', [
            'btn_reset_name' => null,
            'btn_reset_attributes' => [],
        ]);

        Form::component('bsButtonSave', $this->folder_path.'.components.form.helpers.buttons.input.btn_inp_save', [
            'btn_save_name' => trans('cms.helpers.button.save'),
            'btn_save_attributes' => [],
        ]);

        Form::component('bsButtonUpdate', $this->folder_path.'.components.form.helpers.buttons.input.btn_inp_update', [
            'btn_update_name' => trans('cms.helpers.button.update'),
            'btn_update_attributes' => [],
        ]);

        Form::component('bsButtonCancel', $this->folder_path.'.components.form.helpers.buttons.link.btn_lnk_cancel', [
            'btn_cancel_route' => '#',
            'btn_cancel_name' => trans('cms.helpers.button.cancel'),
            'btn_cancel_attributes' => [],
            'btn_cancel_secure' => null,
            'btn_cancel_escape' => true,
        ]);

        Form::component('bsButtonCreate', $this->folder_path.'.components.form.helpers.buttons.link.btn_lnk_create', [
            'btn_create_route' => '#',
            'btn_create_name' => trans('cms.helpers.button.create'),
            'btn_create_attributes' => [],
            'btn_create_secure' => null,
            'btn_create_escape' => true,
        ]);

        Form::component('bsButtonEdit', $this->folder_path.'.components.form.helpers.buttons.link.btn_lnk_edit', [
            'btn_edit_route' => '#',
            'btn_edit_name' => Html::tag('i', '', ['class' => 'fa fa-edit']),
            'btn_edit_attributes' => [],
            'btn_edit_secure' => null,
            'btn_edit_escape' => false,
        ]);
        /******** Group components button END ************/


        /********* Group components form BEGIN *********/
        /******** Group components form END ************/

    }

    /**
     * Share global variables
     */
    private function shareGlobalVariables(): void
    {
        if(Schema::hasTable('settings')) {
            $settings = Setting::withoutGlobalScope(SettingWithoutDisabledScope::class)->get();
            foreach ($settings as $setting) {
                switch ($setting->key) {
                    case 'lang_back_end':
                        app()->setLocale($setting->value);
                        break;
                    case 'multiple_languages':
                        View::share('multilingual', $setting->value);
                        break;

                }
            }
        }

        View::share('folder_path', $this->folder_path.'.');

        if( count( config('multilingual.locales') ) == 1  && Schema::hasTable('langs')) {
            config(['multilingual.locales' => Lang::all(['id', 'name'])->pluck('name', 'id')->toArray()]);
        }
    }

    /**
     * Schedule a command running
     */
    private function closureBootedForCommangs(){
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('view:clear')->name('view_clear')->withoutOverlapping()->daily() ;
            $schedule->command('config:cache')->name('config_cache')->withoutOverlapping()->daily();
//            $schedule->command('queue:restart')->daily();
//            $schedule->command('queue:work')->withoutOverlapping();
        });
    }
}
