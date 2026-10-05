<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemEmprestimo extends Model
{
    protected $table = 'itens_emprestimo';

    protected $fillable = [
        'id_emprestimo',
        'id_material',
        'quantidade'
    ];
}