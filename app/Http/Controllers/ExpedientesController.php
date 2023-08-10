<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpedientesController extends Controller
{
    public function view(Request $request){

        return view('cam.expedientes.exp_ind');
    }
}
