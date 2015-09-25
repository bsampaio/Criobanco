<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'vendor/autoload.php';
require_once 'config/database.php';

use App\Models\Event;

header("Access-Control-Allow-Origin: *");
echo json_encode(Event::all()->toArray());