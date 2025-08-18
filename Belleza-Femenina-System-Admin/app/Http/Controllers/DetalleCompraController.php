<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetalleCompraController extends Controller
{
     
    public function show(){
        return view('detalleCompras.show');
    }
}