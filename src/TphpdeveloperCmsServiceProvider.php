<?php

/**
 * Tphpdeveloper/CMS
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/CMS
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Tphpdeveloper\Cms\Console\Commands\TphpdeveloperVendorPublish;
use Collective\Html\HtmlServiceProvider;
use Collective\Html\FormFacade;
use Collective\Html\HtmlFacade;
use Themsaid\Multilingual\MultilingualServiceProvider;
//use Aginev\Datagrid\DatagridServiceProvider;

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
        if(File::exists( base_path( 'routes/'.config('myself.folder').'/web_backend.php' ) ) ) {
            $this->loadRoutesFrom( base_path( 'routes/' . config('myself.folder') . '/web_backend.php' ) );
        }
        $this->loadMigrationsFrom( database_path( 'migrations/'.config('myself.folder') ) );
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
//        View::composer(config('myself.prefix').'::admin.layouts.left-nav', AdminNavComposer::class);
//        View::composer([
//            config('myself.prefix').'::admin.layouts.app',
//            config('myself.prefix').'::admin.order.view'
//        ], AdminAuthComposer::class);

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
            __DIR__.'/publishes/config/myself.php' => config_path('myself.php')
        ], 'tphpdeveloper_backend_config');

        $this->publishes([
            __DIR__.'/publishes/Controllers/Backend' => app_path('Http/Controllers/'.ucfirst(config('myself.folder')) )
        ], 'tphpdeveloper_backend_controllers');

        $this->publishes([
            __DIR__.'/publishes/Models/Backend' => app_path('Models/'.ucfirst(config('myself.folder')) )
        ], 'tphpdeveloper_backend_models');

        $this->publishes([
            __DIR__.'/publishes/public/backend' => public_path( config('myself.folder') )
        ], 'tphpdeveloper_backend_public');

        $this->publishes([
            __DIR__.'/publishes/resources/views/backend' => resource_path('views/'.config('myself.folder') )
        ], 'tphpdeveloper_backend_views');

        $this->publishes([
            __DIR__.'/database/factories/backend' => database_path('factories/'.config('myself.folder'))
        ], 'tphpdeveloper_backend_factories');
		
		$this->publishes([
            __DIR__.'/database/migrations/backend' => database_path('migrations/'.config('myself.folder'))
        ], 'tphpdeveloper_backend_migrations');

        $this->publishes([
            __DIR__.'/database/seeds' => database_path('seeds')
        ], 'tphpdeveloper_backend_seeds');

        $this->publishes([
            __DIR__.'/publishes/routes/backend' => base_path('routes/'.config('myself.folder') )
        ], 'tphpdeveloper_backend_routes');

    }
}
