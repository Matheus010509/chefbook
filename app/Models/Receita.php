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
    

    public function categoria() //relacao
    {
        return $this->belongsTo(Categoria::class);
    }

    public function user() //
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}