## Laravel Informix Database Package

Laravel-ifx is an Informix Database Driver package for [Laravel Framework](http://laravel.com/) - thanks @taylorotwell. Laravel-ifx is an extension of [Illuminate/Database](https://github.com/illuminate/database) that uses either the PDO extension wrapped into the PDO namespace.

**Please report any bugs you may find.**

- [Installation](#installation)
- [License](#license)

### Installation

Require the package:

```terminal
$ composer require poyii/laravel-ifx
```

Skip below step if you are running Laravel newer than 5.6.

Once Composer has installed or updated your packages you need to register Informix DB. Open up `config/app.php` and find
the `providers` key and add:

```php
Poyii\Informix\InformixDBServiceProvider::class,
```

Finally, add the following in `config/database.php`, in `connections` key.

```php
'informix' => [
    'driver'          => 'informix',
    'host'            => env('DB_HOST', 'localhost'),
    'database'        => env('DB_DATABASE', 'forge'),
    'username'        => env('DB_USERNAME', 'forge'),
    'password'        => env('DB_PASSWORD', ''),
    'service'         => env('DB_SERVICE', '11143'),
    'server'          => env('DB_SERVER', ''),
    'db_locale'       => 'en_US.819',
    'client_locale'   => 'en_US.819',
    'db_encoding'     => 'GBK',
    'initSqls'        => false,
    'client_encoding' => 'UTF-8',
    'prefix'          => '',
],
```

This will copy the configuration file to `config/informix.php`

### Set Informix DB `.env`

You may need to add the following in the `.env` file if you are not have it in your environment setup.

```
INFORMIXDIR=/opt/IBM/informix
INFORMIXSERVER=ol-your-server
LD_LIBRARY_PATH=/opt/IBM/informix/lib/:/opt/IBM/informix/lib/cli:/opt/IBM/informix/lib/esql
PATH=/usr/local/bin:/usr/bin:/usr/local/sbin:/usr/sbin:/opt/IBM/informix/bin:/opt/IBM/informix/lib
```

### License

Licensed under the [MIT License](http://cheeaun.mit-license.org/).
