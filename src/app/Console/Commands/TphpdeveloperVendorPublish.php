<?php

/**
 * Tphpdeveloper/Cms
 *
 * @author    Igor <kutsani@gmail.com>
 * @copyright 2018 Tphpdeveloper/Cms
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Console\Commands;

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
        again:

        $action = [
            '1' => 'Publish data',
            '2' => 'Run migration',
            '3' => 'Seeding test data',
			'4' => 'Exit'
        ];

        $question = $this->choice('What should be done? For speed, enter the key from the list.',$action);

        switch(array_flip($action)[$question]){
            case 1:

                $this->call('vendor:publish', [
                    '--tag' => 'tphpdeveloper_backend_config',
                ]);

                $this->call('vendor:publish', [
                    '--provider' => 'Themsaid\Multilingual\MultilingualServiceProvider',
                ]);

				/*
                $this->call('vendor:publish', [
                    '--provider' => 'Aginev\Datagrid\DatagridServiceProvider',
                    '--tag' => 'views',
                ]);
				*/

                $this->call('config:cache');

                $this->call('vendor:publish', [
                    '--tag' => [
                        'tphpdeveloper_backend_public',
                        'tphpdeveloper_backend_routes',
                        'tphpdeveloper_backend_views',
                        'tphpdeveloper_backend_seeds',
                        ]
                ]);

                $this->call('config:cache');

                $this->info('> composer dump-autoload');
                $res_shel = shell_exec('composer dump-autoload');
                $this->info($res_shel);
                break;
            case 2:
				$this->info('> php artisan queue:table');
				$this->call('queue:table');
				$this->info('> php artisan queue:failed-table');
				$this->call('queue:failed-table');
                break;
			case 3:
                $this->call('migrate');
                break;
            case 4:
				
				$this->info('> php artisan db:seed');
				$this->call('db:seed');
                break;
			case 5:
				goto finished;
				break;
        }

        $this->call('config:cache');
		$this->info('Done!!!');
        if($this->confirm('Show menu?')){
            goto again;
        }
		
		finished:
		$this->info('Finished');
		$this->info('Bye bye!!!');

    }
}
