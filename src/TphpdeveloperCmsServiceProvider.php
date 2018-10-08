<?php

/**
 * Tphpdeveloper/CMS
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/CMS
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms;

use App;
use View;
use File;
use Illuminate\Support\ServiceProvider;
use Tphpdeveloper\Cms\App\Console\Commands\TphpdeveloperVendorPublish;
use Themsaid\Multilingual\MultilingualServiceProvider;
use Collective\Html\HtmlServiceProvider;
use Collective\Html\FormFacade;
use Collective\Html\HtmlFacade;
//use Aginev\Datagrid\DatagridServiceProvider;
use Tphpdeveloper\Cms\App\Http\ViewComposer\LangComposer;

class TphpdeveloperCmsServiceProvider extends ServiceProvider
{

    protected $providers = [
		MultilingualServiceProvider::class,
		//DatagridServiceProvider::class,
		HtmlServiceProvider::class,

    ];
	
	protected $aliases = [
		'Form' => FormFacade::class,
		'Html' => HtmlFacade::class,
		//'Datagrid' => Aginev\Datagrid\Datagrid::class,
	];

    /**
     *  Register application services.
     */
    public function register()
    {
        $this->registerProviders();
		$this->registerAliases();


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

    }

    /**
     * Registering services
     */
    protected function registerProviders()
    {
        if(count($this->providers)) {
            foreach ($this->providers as $provider) {
                App::register($provider);
            }
        }
    }
	
	/**
     * Registering facades
     */
    protected function registerAliases()
    {
        if(count($this->aliases)) {
            foreach ($this->aliases as $alias => $facade) {
                App::alias($alias, $facade);
            }
        }
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
        $this->loadMigrationsFrom( __DIR__ . 'database/migrations' );
        $this->loadTranslationsFrom( base_path( 'resources/lang/'.config('myself.folder') ), config('myself.prefix') );
        $this->loadViewsFrom( base_path( 'resources/views/'.config('myself.folder') ), config('myself.prefix') );

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
		
		

    }

    /**
     * Registration myself artisan commands
     */
    protected function registerCommands()
    {
        if($this->app->runningInConsole()){
            $this->commands([
                TphpdeveloperVendorPublish::class
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
		
		$this->publishes([
            __DIR__.'/database/seeds/DatabaseSeeder.php' => database_path('seeds')
        ], 'tphpdeveloper_backend_seeds');
		
      
    }
}
