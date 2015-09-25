<?php
/**
 * Created by PhpStorm.
 * User: criativa
 * Date: 24/09/15
 * Time: 13:50
 */

require_once 'vendor/autoload.php';
require_once 'config/database.php';

use App\Models\Event;

require_once 'migrate.php';

$events = [
    [
        "dia"     => "24/10",
        "horario" => "9:00 ~ 12:00",
        "vagas"   => 300
    ],
    [
        "dia"     => "24/10",
        "horario" => "14:00 ~ 17:00",
        "vagas"   => 300
    ],
    [
        "dia"     => "25/10",
        "horario" => "9:00 ~ 12:00",
        "vagas"   => 300
    ],
    [
        "dia"     => "25/10",
        "horario" => "14:00 ~ 17:00",
        "vagas"   => 300
    ]
];

if(Event::all()->count() < count($events)){
    createEvents($events);
}
    
function createEvents($events){
    foreach ($events as $event) {
        Event::create($event);
    }
}
