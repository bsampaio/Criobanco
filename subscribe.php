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

//Aborta o processo, caso não exista o id do evento.
if(!isset($_POST['evento_id'])){
    return;
}

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

//function validate($rules, $data){
//    $valid = true;
//    foreach($rules as $rule){
//        $optional = is_array($rule);
//        if($optional){
//            $valid &= validateOptions($rule, $data);
//        }else{
//            $valid &= (isset($data[$rule]) && $data[$rule] != '');
//        }
//    }
//    return $valid;
//}
//
//function validateOptions($rules, $data){
//    $valid = false;
//    foreach($rules as $rule){
//        $valid |= validate($rule, $data);
//    }
//
//    return $valid;
//}
//
//if(!validate($rules, $_POST)) {
//    echo 'Dados requiridos inválidos ou incompletos!';
//    return;
//}

$id = $_POST['evento_id'];
$event = $eventManager->getEvent($id);
$subscriptionData = [
    'nome_pai'     => $_POST['nome_pai'],
    'telefone_pai' => $_POST['telefone_pai'],
    'email_pai'    => $_POST['email_pai'],
    'nome_mae'     => $_POST['nome_mae'],
    'telefone_mae' => $_POST['telefone_mae'],
    'email_mae'    => $_POST['email_mae'],
    'filhos'       => $_POST['filhos']
];

//Retorna uma string contendo a mensagem de erro, caso tenha atingido o limite
$message = $eventManager->subscribe($event, $subscriptionData);

echo $message;

