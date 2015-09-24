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
        "horario" => "9:50",
        "vagas"   => 300
    ],
    [
        "horario" => "11:50",
        "vagas"   => 300
    ],
    [
        "horario" => "13:00",
        "vagas"   => 300
    ],
    [
        "horario" => "15:00",
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
