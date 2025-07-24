<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bancos;
use App\Models\Proveedor;
use App\Models\CuentasBancarias;
use App\Models\NominaSolicitudes;
use App\Models\NominaTareas;
use App\Models\NominaTareasAsignaciones;
use App\Models\User;
use App\Models\UserSession;

class RhController extends Controller
{
    public function index(){

        $bancos = Bancos::get();
        $proveedores = Proveedor::orderBy('created_at', 'desc')->get();
        $cuentas = CuentasBancarias::orderBy('created_at', 'desc')->get();

        return view('rh.index',compact('bancos','proveedores','cuentas'));
    }

    public function index_nominas(){

        $users = User::where('cliente','=',null)->where('nomina_estatus', '=', '1')->orderBy('id','DESC')->get();
        $sessions = UserSession::with('user')->latest('login_at')->paginate(50);
        
        return view('rh.nominas.index', compact('users', 'sessions'));
    }

    public function show_nomina($id){

        $user = User::findOrFail($id);
        $solicitudes = NominaSolicitudes::where('id_users', $id)->orderBy('created_at', 'desc')->get();

        return view('rh.nominas.show', compact('user', 'solicitudes'));
    }

    public function store_nominas_solicitudes(Request $request){

        $solicitud = new NominaSolicitudes();
        $solicitud->id_users = $request->get('id_users');
        $solicitud->tipo_permiso = $request->get('tipo_permiso');
        $solicitud->fecha_inicio = $request->get('fecha_inicio');
        $solicitud->fecha_fin = $request->get('fecha_fin');
        $solicitud->motivo = $request->get('motivo');
        $solicitud->autorizado_por = $request->get('autorizado_por');
        $solicitud->save();

        return redirect()->back();
    }

    public function store_nominas_avisos(Request $request){

        $aviso = new NominaTareas();
        $aviso->id_users = auth()->user()->id;
        $aviso->fecha = date('Y-m-d');
        $aviso->titulo = $request->get('titulo');
        $aviso->descripcion = $request->get('descripcion');
        $aviso->fecha_programada = $request->get('fecha_programada');
        $aviso->url = $request->get('url');
        $aviso->tipo = $request->get('tipo');
        $aviso->tipo_prioridad = $request->get('tipo_prioridad');
        $aviso->estatus = 'Pendiente';
        $aviso->save();

        $empleados = $request->input('empleados');

        for ($count = 0; $count < count($empleados); $count++) {
            $data = array(
                'id_tareas' => $aviso->id,
                'id_users' => $empleados[$count],
            );
            $insert_data[] = $data;
        }
        NominaTareasAsignaciones::insert($insert_data);

        return redirect()->back();
    }

    public function clic(Request $request, NominaTareas $aviso){
        $user = $request->user();

        // Crea o actualiza registro pivote con timestamp de clic
        $user->avisos()->syncWithoutDetaching([
            $aviso->id => ['clic_en' => now()]
        ]);

        return response()->json(['ok'=>true]);
    }
}
