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
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Tphpdeveloper\Cms\App\Console\Commands\CmsVendorPublish;
use Tphpdeveloper\Cms\App\Http\ViewComposer\ColorSidebarComposer;
use Tphpdeveloper\Cms\App\Http\ViewComposer\LangComposer;
use Tphpdeveloper\Cms\App\Models\Setting;
use View;
use File;
use Form;


class CmsServiceProvider extends ServiceProvider
{

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
        $this->registerMiddleware();
        $this->registerResources();
        $this->registerViewComposerData();
        $this->registerCommands();
        $this->publishesFile();
        $this->makeComponentsForm();
        $this->shareGlobalVariables();
    }

    /**
     * Registering middleware
     *
     * @return void
     */
    private function registerMiddleware(): void
    {
        $router = $this->app['router'];
//        $router->aliasMiddleware('main_lang', SetMainLanguage::class);
    }

    /**
     * Registering resource
     * e.g. Route, View, Database path & Translation
     *
     * @return void
     */
    private function registerResources(): void
    {

        if(File::exists( base_path( 'routes/'.config('myself.folder').'/web.php' ) ) ) {
            $this->loadRoutesFrom( base_path( 'routes/' . config('myself.folder') . '/web.php' ) );
        }
        $this->loadMigrationsFrom( __DIR__ . '/database/migrations' );
        //$this->loadTranslationsFrom( base_path( 'resources/lang/'.config('myself.folder') ), config('myself.prefix') );
        //$this->loadViewsFrom( base_path( 'resources/views/'.config('myself.folder') ), config('myself.prefix') );

    }

    /**
     * Registering Class Based View Composer
     *
     * @return void
     */
    private function registerViewComposerData(): void
    {
		View::composer([
            config('myself.folder').'.helpers.lang_switch',
            config('myself.folder').'.components.form.*',
		], LangComposer::class);

        View::composer([
            config('myself.folder').'.layout.sidebar'
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
            __DIR__.'/public' => public_path( config('myself.folder') )
        ], 'tphpdeveloper_backend_public');

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/'.config('myself.folder') )
        ], 'tphpdeveloper_backend_views');

		$this->publishes([
            __DIR__.'/routes' => base_path('routes/'.config('myself.folder') )
        ], 'tphpdeveloper_backend_routes');


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
        Form::component('bsText', config('myself.folder').'.components.form.text', [
            'name',
            'alias' => '',
            'value' => null,
            'attributes' => [],
            'languages' => false,
            'class' => '',
        ]);

        Form::component('bsNumber', config('myself.folder').'.components.form.number', [
            'name',
            'alias' => '',
            'value' => null,
            'attributes' => [],
            'class' => '',
        ]);

        Form::component('bsToggle', config('myself.folder').'.components.form.checkbox', [
            'name',
            'alias' => '',
            'value' => null,
            'checked' => null,
            'attributes' => [],
            'class' => null,
        ]);
    }

    /**
     * Share global variables
     */
    private function shareGlobalVariables(): void
    {
        $settings = Setting::all();
        foreach($settings as $setting){
            switch($setting->key){
                case 'lang':
                    app()->setLocale($setting->value);
                    break;
                case 'multiple_languages':
                    View::share('multiple_lang', $setting->value);
                    break;

            }
        }
    }
}
