<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materiais';

    protected $fillable = [
        'codigo',
        'nome',
        'descricao',
        'id_categoria',
        'id_localizacao',
        'quantidade',
        'quantidade_disponivel',
        'quantidade_minima',
        'estado',
        'tipo_material',
    ];
}