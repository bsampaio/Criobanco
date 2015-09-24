<?php
/**
 * Created by PhpStorm.
 * User: criativa
 * Date: 24/09/15
 * Time: 13:50
 */

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$capsule->addConnection([
    'driver'    => 'psql',
    'host'      => 'ec2-54-83-205-164.compute-1.amazonaws.com',
    'database'  => 'd6ankflvuh8jcl',
    'username'  => 'hymfeihwiisdcr',
    'password'  => 'Wp1VcdjpPjTzfVVX_JN1LoPeEl',
    'port'      => '5432',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();