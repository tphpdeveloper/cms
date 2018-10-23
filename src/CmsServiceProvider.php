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
use View;
use File;


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

        Form::component('bsText', config('myself.folder').'.components.form.text', [
            'name',
            'alias' => '',
            'value' => '',
            'attributes' => [],
            'd_none' => '',
            'lang' => '',
        ]);
    }

    /**
     * Registering middleware
     *
     * @return void
     */
    protected function registerMiddleware()
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
    protected function registerResources()
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
    protected function registerViewComposerData()
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
    protected function registerCommands()
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
    protected function publishesFile()
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

	public function registerFactory(){
		$this->app->make(Factory::class)->load(__DIR__ . '/database/factories');
	}

}
