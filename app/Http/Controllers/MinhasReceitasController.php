<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MinhasReceitasController extends Controller
{
 public function minhasReceitas()
    {
        return view('minhas_receitas');
    }
}
