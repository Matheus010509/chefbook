<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CadastrarReceitasController extends Controller
{
  public function cadastrarReceitas()
{
    return view('cadastrar_receitas'); 
}
}