<?php
/**
 * Created by PhpStorm.
 * User: criativa
 * Date: 24/09/15
 * Time: 13:52
 */


require_once 'vendor/autoload.php';
require_once 'config/database.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

if(!Capsule::schema()->hasTable('criobanco_evento')){
    Capsule::schema()->create('criobanco_evento', function(Blueprint $table){

        $table->increments('id');
        $table->timestamps();
        $table->string('dia');
        $table->string('horario');
        $table->integer('vagas')->unsigned();
    });
}

if(!Capsule::schema()->hasTable('criobanco_inscricao')){
    Capsule::schema()->create('criobanco_inscricao', function(Blueprint $table){

        $table->increments('id');
        $table->timestamps();
        $table->integer('evento_id')->unsigned();
        $table->foreign('evento_id')->references('id')->on('criobanco_evento');
        $table->string('email_pai',150)->nullable();
        $table->string('nome_pai', 200)->nullable();
        $table->string('telefone_pai', 30)->nullable();
        $table->string('email_mae',150)->nullable();
        $table->string('nome_mae', 200)->nullable();
        $table->string('telefone_mae', 30)->nullable();
        $table->integer('filhos')->unsigned();
    });
}