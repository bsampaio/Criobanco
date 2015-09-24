<?php
/**
 * Created by PhpStorm.
 * User: criativa
 * Date: 24/09/15
 * Time: 13:52
 */


require_once 'vendor/autoload.php';
require_once 'config/database.php';

exec("php --version > version.txt");

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;

Manager::schema()->create('criobanco_evento', function(Blueprint $table){

    $table->increments('id');
    $table->timestamps();
    $table->string('horario');
    $table->integer('vagas')->unsigned();
});

Manager::schema()->create('criobanco_inscricao', function(Blueprint $table){

    $table->increments('id');
    $table->timestamps();
    $table->integer('evento_id')->unsigned();
    $table->foreign('evento_id')->references('id')->on('criobanco_evento');
    $table->string('email_pai',150);
    $table->string('name_pai', 200);
    $table->string('telefone_pai', 30);
    $table->string('email_mae',150);
    $table->string('name_mae', 200);
    $table->string('telefone_mae', 30);
    $table->integer('filhos')->unsigned();
});