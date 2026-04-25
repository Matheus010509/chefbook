<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receita extends Model
{
    use HasFactory; 

    protected $fillable = [
        'titulo',
        'ingredientes',
        'modo_preparo',
        'imagem',
        'favorito',
        'categorias',
        'users_id',
    ];
}