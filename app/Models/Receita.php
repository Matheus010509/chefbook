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
        'imagem_public_id',
        'favorito',
        'categoria_id',
        'users_id',
    ];
      protected $appends = ['imagem_url'];

    public function getImagemUrlAttribute()
    {
        if (!$this->imagem) {
            return null;
        }

        return $this->imagem;   //  URL completa do Cloudinary
    }

    public function scopeDoUsuario($query, $userId) //Criei um scope para nn repetir o where('users_id') em todo lugar
    {
    return $query->where('users_id', $userId);
}
    

    public function categoria() //relacão de receita com categoria, uma receita pertence a uma categoria
    {
        return $this->belongsTo(Categoria::class);
    }

    public function user() //relacão de receita com usuario, uma receita pertence a um usuario
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}