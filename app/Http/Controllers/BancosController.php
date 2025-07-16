<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bancos;

class BancosController extends Controller
{
    public function store(Request $request){

        $banco = new Bancos;
        $banco->nombre_beneficiario = $request->get('nombre_beneficiario');
        $banco->nombre_banco = $request->get('nombre_banco');
        $banco->cuenta_bancaria = $request->get('cuenta_bancaria');
        $banco->clabe = $request->get('clabe');
        $banco->saldo = $request->get('saldo');
        $banco->save();

        return redirect()->back();

    }

}
