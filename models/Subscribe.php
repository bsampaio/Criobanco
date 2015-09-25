<?php

/**
 * Created by PhpStorm.
 * User: criativa
 * Date: 24/09/15
 * Time: 14:12
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Subscribe extends Eloquent
{

    protected $table = 'criobanco_inscricao';
    protected $fillable = [
        'evento_id',
        'nome_pai',
        'telefone_pai',
        'email_pai',
        'nome_mae',
        'telefone_mae',
        'email_mae',
        'filhos'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'evento_id');
    }
}