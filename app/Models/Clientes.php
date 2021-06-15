<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';
    protected $primarykey = 'id';
    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'telefone'
    ];
    public $timestamps = false;

//

}
