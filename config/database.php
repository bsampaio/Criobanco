<?php
/**
 * Created by PhpStorm.
 * User: criativa
 * Date: 24/09/15
 * Time: 13:50
 */

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();


$heroku_psql = parse_url(getenv('DATABASE_URL'));

$connections = [
    'local' => [
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'criobanco',
        'username'  => 'root',
        'password'  => 'K1ckb0x1ng!@#.',
        'port'      => '5432',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ],
    "heroku" => []
];

if(!empty($heroku_psql['path'])){
    $connections['heroku'] = [
        'driver'    => 'pgsql',
        'host'      => $heroku_psql['host'],
        'database'  => ltrim($heroku_psql["path"],'/'),
        'username'  => $heroku_psql['user'],
        'password'  => $heroku_psql['pass'],
        'port'      => $heroku_psql['port'],
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ];
}

if(!empty($connections['heroku'])){
    $capsule->addConnection($connections['heroku']);
}else{
    $capsule->addConnection($connections['local']);
}

$capsule->setAsGlobal();
$capsule->bootEloquent();