<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nome'];

    public function receitas()
    {
        return $this->hasMany(Receita::class); // Uma receita pode ter apenas uma categoria, mas uma categoria pode ter várias receitas
    }
}
