<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bancos;
use MercadoPago\SDK;
use Carbon\Carbon;
use App\Services\Bancos\TransactionServiceFactory;

class BancosController extends Controller
{

    public function index(){
        $bancos = Bancos::get();

        return view('rh.bancos.index', compact('bancos'));
    }


    public function store(Request $request){

        $banco = new Bancos;
        $banco->nombre_beneficiario = $request->get('nombre_beneficiario');
        $banco->nombre_banco = $request->get('nombre_banco');
        $banco->cuenta_bancaria = $request->get('cuenta_bancaria');
        $banco->clabe = $request->get('clabe');
        $banco->saldo = $request->get('saldo_inicial');
        $banco->save();

        return redirect()->back();
    }

    public function edit($id)
    {
        $banco = Bancos::findOrFail($id);
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $fecha = date('Y-m-d');

        // Obtén la colección ya ordenada y mezclada
        $transacciones = TransactionServiceFactory::make($banco)
                            ->fetchTransactions();

        return view('rh.bancos.show', compact('banco', 'transacciones', 'startOfWeek', 'endOfWeek', 'fecha'));
    }

}
