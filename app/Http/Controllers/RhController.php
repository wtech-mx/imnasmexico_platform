<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bancos;

class RhController extends Controller
{
    public function index(){

        $bancos = Bancos::get();

        return view('rh.index',compact('bancos'));
    }

}
