<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Console\Commands;

use Illuminate\Console\Command;

class CmsVendorPublish extends Command
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

        $name_action = [
            'Publish config' => 'publishConfig',
			'Publish data' => 'publishData',
			'Create queue table migration' => 'createQueueTable',
            'Run migration' => 'runMigration',
            'Seeding test data' => 'seedingData',
			'Composer dump-autoload' => 'dumpAutoload',
			'Config cache' => 'configCache',
			'Exit' => 'Exit'
        ];

		$action = [];
		$functions = [];
		foreach($name_action as $name => $function){
			$action[] = $name;
			$functions[] = $function;
		}

		again:
        $question = $this->choice('What should be done? For speed, enter the key from the list.',$action);
        $key = array_flip($action)[$question];

		if(($key + 1) == count($functions)){
			goto finished;
		}

		//call function
		$this->{$functions[$key]}();
		$this->infoDone();


        if($this->confirm('Show menu?')){
            goto again;
        }

		finished:
		$this->info('Finished');
		$this->info('Bye bye!!!');

    }

	private function publishConfig(){
		$this->call('vendor:publish', [
			'--tag' => [
				'tphpdeveloper_backend_config',
				'datagrid_config',
			],
            '--provider' => [
                'Lavary\Menu\ServiceProvider'
            ]
		]);
	}

	private function publishData(){


		$this->call('vendor:publish', [
			'--provider' => 'Themsaid\Multilingual\MultilingualServiceProvider',
		]);

		$this->call('vendor:publish', [
			'--tag' => [
				'tphpdeveloper_backend_public',
				'tphpdeveloper_backend_routes',
				'tphpdeveloper_backend_views',
				'laravel-pagination',
				'datagrid_view',
				]
		]);

	}

	private function createQueueTable(){
		$this->info('> php artisan queue:table');
		$this->call('queue:table');
		$this->info('> php artisan queue:failed-table');
		$this->call('queue:failed-table');
	}

	private function runMigration(){
		 $this->call('migrate');
	}

	private function seedingData(){
		$this->info('> php artisan db:seed');
		$this->call('db:seed');
	}

	private function dumpAutoload(){
		$this->info('> composer dump-autoload');
		$res_shel = shell_exec('composer dump-autoload');
		$this->info($res_shel);
	}

	private function configCache(){
		$this->call('config:cache');
	}

	private function infoDone(){
		$this->info('Done!!!');
	}


}
