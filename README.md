***after install laravel package***
 
**env** file
```dotenv
APP_NAME=Name application
APP_DEBUG=fale
APP_URL=set url site
 
LOG_CHANNEL=daily
 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=name database
DB_USERNAME=username
DB_PASSWORD=password
 
QUEUE_CONNECTION=database
 
MAIL_DRIVER=log
MAIL_HOST=null
MAIL_PORT=null
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```

**config/app.php**
```php
'timezone' => 'Europe/Kiev',
'locale' => 'ru',
'fallback_locale' => 'ru',
```

**config/database.php**
```php
'connections' => [
    ...
    'mysql' => [
        ...
        'prefix' => 'name prefix',
    ],
    ...
],
```

**config/filesystems.php**
```php
'disks' => [
    ...
    'lang' => [
        'driver' => 'local',
        'root' => resource_path('lang'),
        'url' => env('APP_URL').'/resources'
    ],
    ...
],
```

```php
php artisan config:cache
```

```php
composer require tphpdeveloper/cms
```

***config/auth.php***
```php
'guards' => [
    ...
    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],
    ...
],
 
'providers' => [
    ...
    'admins' => [
        'driver' => 'eloquent',
        'model' => Tphpdeveloper\Cms\App\Models\Admin::class,
    ],
    ...
],
```

```php
php artisan config:cache
```

```php
then vendor publish myself
```

**after migrate, write to database/seeds/DatabaseSeeder.php**
```php
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(LangSeeder::class);
        $this->call(LangStaticValueSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(AdminMenuSeeder::class);

    }
```

```php
then can seeding data from the vendor publish myself
```
