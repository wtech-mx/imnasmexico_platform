<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Cosmikausers;
use App\Models\Bitacora_cosmikausers;
use App\Models\Productosregaloscosmika;

use Illuminate\Support\Str;
use Session;
use Hash;
use DB;
use Carbon\Carbon;


class CosmicaDistribuidoraController extends Controller
{
    public function index(){

        $usercosmika = Cosmikausers::orderby('id','desc')->get();
        $clientes = User::orderby('name','desc')->get();

        return view('cosmica.distribuidoras.index',compact('usercosmika', 'clientes'));
    }


    public function store(Request $request){

        $code = Str::random(8);
        $fechaActual = date('Y-m-d');

        if (User::where('telefono', $request->telefono)->exists() || User::where('email', $request->email)->exists()) {
            if (User::where('telefono', $request->telefono)->exists()) {
                $user = User::where('telefono', $request->telefono)->first();
                $user->name = $request->get('name') . " " . $request->get('apellido');
                $user->update();
            } else {
                $user = User::where('email', $request->email)->first();
                $user->name = $request->get('name') . " " . $request->get('apellido');
                $user->update();
            }
            $payer = $user;
        } else {
            $payer = new User();
            $payer->name = $request->get('name') . " " . $request->get('apellido');
            $payer->email = $request->get('email');
            $payer->username = $request->get('telefono');
            $payer->code = $code;
            $payer->telefono = $request->get('telefono');
            $payer->cliente = '1';
            $payer->password = Hash::make($request->get('telefono'));
            $payer->save();
        //    Mail::to($payer->email)->send(new PlantillaNuevoUser($datos));
        }

        $usercosmika = new Cosmikausers;
        $usercosmika->id_cliente = $payer->id;
        $usercosmika->membresia = $request->get('membresia');
        $usercosmika->membresia_estatus = $request->get('membresia_estatus');
        $usercosmika->puntos_acomulados = $request->get('puntos_acomulados');
        $usercosmika->membresia_inicio = $request->get('membresia_inicio');
        $usercosmika->membresia_fin = $request->get('membresia_fin');
        $usercosmika->meses_acomulados = $request->get('meses_acomulados');
        $usercosmika->consumido_totalmes = $request->get('consumido_totalmes');
        $usercosmika->direccion_local = $request->get('direccion_local');
        $usercosmika->direccion_foto = $request->get('direccion_foto');
        $usercosmika->direccion_rs_face = $request->get('direccion_rs_face');
        $usercosmika->direccion_rs_insta = $request->get('direccion_rs_insta');
        $usercosmika->direccion_rs_whats = $request->get('direccion_rs_whats');
        $usercosmika->save();


        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');
    }

    public function update(Request $request,$id){

        $usercosmika =  Cosmikausers::findorfail($id);
        $usercosmika->membresia = $request->get('membresia');
        $usercosmika->membresia_estatus = $request->get('membresia_estatus');
        $usercosmika->puntos_acomulados = $request->get('puntos_acomulados');
        $usercosmika->membresia_inicio = $request->get('membresia_inicio');
        $usercosmika->membresia_fin = $request->get('membresia_fin');
        $usercosmika->meses_acomulados = $request->get('meses_acomulados');
        $usercosmika->consumido_totalmes = $request->get('consumido_totalmes');
        $usercosmika->direccion_local = $request->get('direccion_local');
        $usercosmika->direccion_foto = $request->get('direccion_foto');
        $usercosmika->direccion_rs_face = $request->get('direccion_rs_face');
        $usercosmika->direccion_rs_insta = $request->get('direccion_rs_insta');
        $usercosmika->direccion_rs_whats = $request->get('direccion_rs_whats');
        $usercosmika->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Actualizado exitoso.');
    }
}
