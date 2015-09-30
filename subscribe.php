<?php
/**
 * Created by PhpStorm.
 * User: criativa
 * Date: 24/09/15
 * Time: 14:20
 */

require_once 'vendor/autoload.php';
require_once 'config/database.php';

use App\Service\EventManager;

header("Access-Control-Allow-Origin: *");

$eventManager = new EventManager;

$rules = [
    'evento_id',
    [
        [
            'nome_pai',
            'telefone_pai',
            'email_pai'
        ],
        [
            'nome_mae',
            'telefone_mae',
            'email_mae'
        ],
    ],
    'filhos'
];

function validate($rules, $data){
    $valid = true;
    foreach($rules as $rule){
        $optional = is_array($rule);
        if($optional){
            $valid &= validateOptions($rule, $data);
        }else{
            $valid &= (isset($data[$rule]) && $data[$rule] != '');
        }
    }
    return $valid;
}

function validateOptions($rules, $data){
    $valid = false;
    foreach($rules as $rule){
        $valid |= validate($rule, $data);
    }

    return $valid;
}

if(!validate($rules, $_POST)) {
    header('HTTP/1.1 500 Internal Server Error');
    echo 'Dados requiridos inválidos ou incompletos!';
    return;
}

$id = $_POST['evento_id'];
$event = $eventManager->getEvent($id);
$subscriptionData = [
    'nome_pai'     => isset($_POST['nome_pai']) ? $_POST['nome_pai'] : null,
    'telefone_pai' => isset($_POST['telefone_pai']) ? $_POST['telefone_pai'] : null,
    'email_pai'    => isset($_POST['email_pai']) ? $_POST['email_pai'] : null,
    'nome_mae'     => isset($_POST['nome_mae']) ? $_POST['nome_mae'] : null,
    'telefone_mae' => isset($_POST['telefone_mae']) ? $_POST['telefone_mae'] : null,
    'email_mae'    => isset($_POST['email_mae']) ? $_POST['email_mae'] : null,
    'filhos'       => $_POST['filhos']
];

//Retorna uma string contendo a mensagem de erro, caso tenha atingido o limite
$message = $eventManager->subscribe($event, $subscriptionData);

echo $message;

