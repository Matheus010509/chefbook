<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('receitas_prontas');
});
