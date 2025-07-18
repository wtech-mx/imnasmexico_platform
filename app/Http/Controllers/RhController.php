<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bancos;
use App\Models\Proveedor;

class RhController extends Controller
{
    public function index(){

        $bancos = Bancos::get();
        $proveedores = Proveedor::orderBy('created_at', 'desc')->get();

        return view('rh.index',compact('bancos','proveedores'));
    }

}
