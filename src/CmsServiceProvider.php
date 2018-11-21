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
use Tphpdeveloper\Cms\App\Scopes\WithoutDisabledScope;
use Tphpdeveloper\Cms\Providers\EventListenersProvider;
use View;
use File;
use Form;
use Html;
use Log;
use Schema;

class CmsServiceProvider extends ServiceProvider
{

    private $folder_path = '';
    private $prefix = '';

    /**
     * List provider for register
     *
     * @var array
     */
    private $providers = [
        EventListenersProvider::class,
    ];

    /**
     *  Register application services.
     */
    public function register()
    {
		$this->registerFactory();
        $this->registerProviders();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->folder_path = config('cms.folder');
        $this->prefix = config('cms.prefix').'::';

        $this->registerMiddleware();
        $this->registerResources();
        $this->registerViewComposerData();
        $this->registerCommands();
        $this->publishesFile();
        $this->makeComponentsForm();
        $this->shareGlobalVariables();
        $this->closureBootedForCommands();


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

        if(File::exists(  config('cms.routes').'/web.php' ) ) {
            $this->loadRoutesFrom(  config('cms.routes').'/web.php' );
        }
        $this->loadMigrationsFrom( __DIR__ . '/database/migrations' );
        $this->loadViewsFrom( config('cms.views'), config('cms.prefix') );
        //$this->loadTranslationsFrom( base_path( 'resources/lang/' . $this->folder_path ), config('cms.prefix') );

    }

    /**
     * Registering Class Based View Composer
     *
     * @return void
     */
    private function registerViewComposerData(): void
    {

        View::composer([
            $this->prefix.'layout.sidebar'
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
            __DIR__.'/config/cms.php' => config_path('cms.php')
        ], 'tphpdeveloper_backend_config');

		$this->publishes([
            __DIR__.'/public' => config_path('cms.public')
        ], 'tphpdeveloper_backend_public');

        $this->publishes([
            __DIR__.'/resources/views' => config('cms.views')
        ], 'tphpdeveloper_backend_views');

		$this->publishes([
            __DIR__.'/routes' => config('cms.routes')
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
        Form::component('bsFormGroup', $this->prefix.'components.form.helpers.form_group',[
            'content' => '',
            'attribute' => [],
        ]);

        Form::component('bsLabel', $this->prefix.'components.form.helpers.label',[
            'name' => '',
            'alias' => '',
            'attributes' => [],
            'entities' => true,
        ]);

        Form::component('bsErrors', $this->prefix.'components.form.helpers.errors',[
            'name' => '',
        ]);

        /********* Group components form BEGIN *********/
        Form::component('bsText', $this->prefix.'components.form.text', [
            'name',
            'alias' => '',
            'value' => '',
            'multiple_lang' => false,
            'attributes' => [],
            'textarea'=> false,
            'form_group_attributes' => []
        ]);

        Form::component('bsTextarea', $this->prefix.'components.form.text', [
            'name',
            'alias' => '',
            'value' => '',
            'multiple_lang' => false,
            'attributes' => [],
            'textarea'=> true,
            'form_group_attributes' => []
        ]);

        Form::component('bsNumber', $this->prefix.'components.form.number', [
            'name',
            'alias' => '',
            'value' => '',
            'attributes' => [],
        ]);

        Form::component('bsCheckbox', $this->prefix.'components.form.checkbox', [
            'name',
            'alias' => '',
            'checked' => 0,
            'attributes' => [],
        ]);

        Form::component('bsSelect', $this->prefix.'components.form.select', [
            'name',
            'alias' => '',
            'list' => [],
            'selected' => null,
            'attributes' => [],
        ]);
        /******** Group components form END ************/

        /********* Group components form BEGIN *********/
        /******** Group components form END ************/

    }

    /**
     * Share global variables
     */
    private function shareGlobalVariables(): void
    {
        if(Schema::hasTable('settings')) {
            $settings = Setting::withoutGlobalScope(WithoutDisabledScope::class)->get();
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

        View::share('prefix', $this->prefix);
        View::share('folder_path', $this->folder_path);

        if( count( config('multilingual.locales') ) == 1  && Schema::hasTable('langs')) {
            config(['multilingual.locales' => Lang::all(['id', 'name'])->pluck('name', 'id')->toArray()]);
        }
    }

    /**
     * Schedule a command running
     */
    private function closureBootedForCommands(){
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('view:clear')->name('view_clear')->withoutOverlapping()->daily() ;
            $schedule->command('config:cache')->name('config_cache')->withoutOverlapping()->daily();
            $schedule->command('queue:work')->name('queue_work')->withoutOverlapping();
            $schedule->command('queue:restart');
        });
    }

    /**
     * Register service provider the package
     */
    private function registerProviders(){
        if(count($this->providers)){
            foreach ($this->providers as $provider) {
                App::register($provider);
            }
        }
    }
}
