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

        $this->checkMembresia();

        $usercosmika = Cosmikausers::orderby('id','desc')->get();
        $clientes = User::orderby('name','desc')->get();

        return view('cosmica.distribuidoras.index',compact('usercosmika', 'clientes'));
    }

    public function index_distribuidoras(){

        $distribuidora = Cosmikausers::where('membresia','=','Estelar')->get();

        return view('user.distribuidoras', compact('distribuidora'));
    }

    public function store(Request $request){

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_webpage = base_path('../public_html/plataforma.imnasmexico.com/utilidades');
        }else{
            $ruta_webpage = public_path() . '/utilidades';
        }

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

        if ($request->hasFile("direccion_foto")) {
            $file = $request->file('direccion_foto');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $usercosmika->direccion_foto = $fileName;
        }

        $usercosmika->direccion_rs_face = $request->get('direccion_rs_face');
        $usercosmika->direccion_rs_insta = $request->get('direccion_rs_insta');
        $usercosmika->direccion_rs_whats = $request->get('direccion_rs_whats');
        $usercosmika->save();


        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');
    }

    public function update(Request $request,$id){

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_webpage = base_path('../public_html/plataforma.imnasmexico.com/utilidades');
        }else{
            $ruta_webpage = public_path() . '/utilidades';
        }

        $usercosmika =  Cosmikausers::findorfail($id);
        $usercosmika->membresia = $request->get('membresia');
        $usercosmika->membresia_estatus = $request->get('membresia_estatus');
        $usercosmika->puntos_acomulados = $request->get('puntos_acomulados');
        $usercosmika->membresia_inicio = $request->get('membresia_inicio');
        $usercosmika->membresia_fin = $request->get('membresia_fin');
        $usercosmika->meses_acomulados = $request->get('meses_acomulados');
        $usercosmika->consumido_totalmes = $request->get('consumido_totalmes');

        if ($request->hasFile("direccion_foto")) {
            $file = $request->file('direccion_foto');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $usercosmika->direccion_foto = $fileName;
        }

        $usercosmika->direccion_local = $request->get('direccion_local');
        $usercosmika->direccion_rs_face = $request->get('direccion_rs_face');
        $usercosmika->direccion_rs_insta = $request->get('direccion_rs_insta');
        $usercosmika->direccion_rs_whats = $request->get('direccion_rs_whats');
        $usercosmika->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Actualizado exitoso.');
    }

    protected function checkMembresia()
    {
        $users = Cosmikausers::all();

        foreach ($users as $user) {
            $this->handleUserMembresia($user);
            $user->save();
        }
    }

    protected function handleUserMembresia($user)
    {
        $membresiaFin = Carbon::parse($user->membresia_fin);
        $diasRestantes = Carbon::now()->diffInDays($membresiaFin, false);
        $meta = $user->membresia === 'Cosmos' ? 1500 : ($user->membresia === 'Estelar' ? 2500 : 0);

        if ($diasRestantes == 0 && $user->consumido_totalmes >= $meta) {
            $this->createBitacora($user);
            $user->membresia_fin = $membresiaFin->addMonth()->format('Y-m-d');
            $user->consumido_totalmes = 0;
            $user->meses_acomulados += 1;
        } elseif ($diasRestantes < 0 && $diasRestantes >= -5) {
            if ($user->consumido_totalmes < $meta && $diasRestantes == -5) {
                $this->createBitacora($user);
                $user->puntos_acomulados = 0;
                $user->meses_acomulados = 0;
                $user->membresia_estatus = 'Inactiva';
            }
        } elseif ($diasRestantes < -5) {
            $this->createBitacora($user);
            $user->puntos_acomulados = 0;
            $user->meses_acomulados = 0;
            $user->membresia_estatus = 'Inactiva';
        }
    }

    protected function createBitacora($user)
    {
        $bitacora = new Bitacora_cosmikausers;
        $bitacora->id_cliente = $user->id_cliente;
        $bitacora->membresia = $user->membresia;
        $bitacora->puntos_acomulados = $user->puntos_acomulados;
        $bitacora->membresia_inicio = $user->membresia_inicio;
        $bitacora->membresia_fin = $user->membresia_fin;
        $bitacora->meses_acomulados = $user->meses_acomulados;
        $bitacora->consumido_totalmes = $user->consumido_totalmes;
        $bitacora->claves_protocolo = $user->claves_protocolo;
        $bitacora->save();
    }
}
