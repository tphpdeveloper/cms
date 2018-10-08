<?php

use Illuminate\Database\Seeder;

use Tphpdeveloper\Cms\Database\Seeds\TabsSeeder;
use Tphpdeveloper\Cms\Database\Seeds\LabelSeeder;
use Tphpdeveloper\Cms\Database\Seeds\SettingsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         $this->call(TabsSeeder::class);
         $this->call(LabelSeeder::class);
         $this->call(SettingsSeeder::class);

    }
}
