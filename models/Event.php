<?php

/**
 * Created by PhpStorm.
 * User: criativa
 * Date: 24/09/15
 * Time: 14:12
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Event extends Eloquent
{

    protected $table = 'criobanco_evento';
    protected $fillable = ['horario', 'vagas'];

    public function subscribers()
    {
        return $this->hasMany(Subscribe::class, 'evento_id', 'id');
    }
}