<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReceitasFavoritasController extends Controller
{
    public function receitasFavoritas()
    {
        return view('receitas_favoritas');
    }
}
