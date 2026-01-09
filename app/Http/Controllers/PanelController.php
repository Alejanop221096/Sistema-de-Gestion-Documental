<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function inicio(){
         return view('panel');
    }
    public function historico(){
        return view('archivoh');
    }
   
}
