<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReceitasProntasController extends Controller
{
    public function receitasProntas()
    {
        return view('receitas_prontas');
    }
}