<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //Funciones publicas del controlador

    public function index(){
        $nombre = "Francisco";
        $numero = rand(1,100);
        return view('main', ['nombre' => $nombre, 'numero' => $numero]);
    }



}
