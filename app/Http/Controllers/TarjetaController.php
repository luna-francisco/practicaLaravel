<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TarjetaController extends Controller
{
    public function show($id)
    {
        return view('tarjeta.show', compact('id'));
    }
}

