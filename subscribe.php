<?php
/**
 * Created by PhpStorm.
 * User: criativa
 * Date: 24/09/15
 * Time: 14:20
 */

use App\Service\EventManager;

$eventManager = new EventManager;

//Aborta o processo, caso não exista o id do evento.
if(!isset($_POST['event_id'])){
    return;
}

$id = $_POST['event_id'];
$event = $eventManager->getEvent($id);
$subscriptionData = [
    'nome_pai'     => $_POST['nome_pai'],
    'telefone_pai' => $_POST['telefone_pai'],
    'email_pai'    => $_POST['email_pai'],
    'nome_mae'     => $_POST['nome_pai'],
    'telefone_mae' => $_POST['telefone_pai'],
    'email_mae'    => $_POST['email_pai'],
    'filhos'       => $_POST['filhos']
];

//Retorna uma string contendo a mensagem de erro, caso tenha atingido o limite
$message = $eventManager->subscribe($event, $subscriptionData);

echo $message;

