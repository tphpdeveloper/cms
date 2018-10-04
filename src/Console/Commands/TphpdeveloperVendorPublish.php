<?php

namespace Tphpdeveloper\Cms\Console\Commands;

use Illuminate\Console\Command;

class TphpdeveloperVendorPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tphpdeveloper_vendor:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Group publication of module files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'tphpdeveloper_backend_config',
        ]);
		
		$this->call('vendor:publish', [
            '--provider' => 'Themsaid\Multilingual\MultilingualServiceProvider',
        ]);

		$this->call('vendor:publish', [
            '--provider' => 'Aginev\Datagrid\DatagridServiceProvider',
			'--tag' => 'views',
        ]);

        $this->call('config:cache');

        $this->call('vendor:publish', [
            '--tag' => [
                'tphpdeveloper_backend_controllers',
                'tphpdeveloper_backend_models',
                'tphpdeveloper_backend_public',
                'tphpdeveloper_backend_routes',
                'tphpdeveloper_backend_factories',
                'tphpdeveloper_backend_migrations',				
                'tphpdeveloper_backend_seeds',
                'tphpdeveloper_backend_views',
                ]
        ]);


		$this->call('config:cache');

        $this->call('migrate');

        $this->info('> composer dump-autoload');
        $res_shel = shell_exec('composer dump-autoload');
        $this->info($res_shel);
		$this->call('config:cache');
		
		if($this->confirm('Do you want to fill the table with test data?')){
		
			$this->info('> php artisan db:seed --class=SettingsSeeder');		
			$this->call('db:seed', [
				'--class' => 'SettingsSeeder'
			]);
			$this->info('> php artisan db:seed --class=TabsSeeder');		
			$this->call('db:seed', [
				'--class' => 'TabsSeeder'
			]);
		}
		
		$this->info('Finished!!!');

    }
}
