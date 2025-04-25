<?php

namespace App\Http\Controllers\Cam;

use App\Http\Controllers\Controller;
use App\Models\Cam\CamEstandares;
use App\Models\Cam\CamNotas;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\PlantillaNuevoUser;
use App\Models\Cam\CamChecklist;
use App\Models\Cam\CamNotEstandares;
use App\Models\Cam\CamCitas;
use App\Models\Cam\CamDocumentosUsers;
use App\Models\Cam\CamVideosUser;
use App\Models\CarpetasEstandares;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DB;

class NotasCamController extends Controller
{
    public function index(){

        $estandares_cam = CarpetasEstandares::orderBy('nombre','asc')->get();

        $estandar_user = CamNotEstandares::get();

        $notas_cam = CamNotas::where('tipo', '!=', 'Compra Estandar')->get();

        $ultimaNota = CamNotas::latest('id')->first();
        $ultimoId = $ultimaNota ? $ultimaNota->id : 0;
        $siguienteId = $ultimoId + 1;

        $fecha = Carbon::now()->locale('es')->isoFormat('D [de] MMMM [del] YYYY');

        return view('cam.admin.notas.index', compact('estandares_cam', 'notas_cam', 'siguienteId', 'fecha','estandar_user'));
    }

    public function crear(Request $request){

        $name = $request->get('name');
        $apellido = $request->get('apellido');
        $celular = $request->get('celular');
        // Obtén las dos primeras letras del nombre
        $primerasDosLetrasNombre = substr($name, 0, 2);
        // Obtén las dos primeras letras del apellido
        $primerasDosLetrasApellido = substr($apellido, 0, 2);
        // Obtén los últimos tres dígitos del número de teléfono
        $ultimosTresDigitosCelular = substr($celular, -3);
        // Concatena las partes para formar la contraseña
        $password = $primerasDosLetrasNombre . $primerasDosLetrasApellido . $ultimosTresDigitosCelular;

        $code = Str::random(8);
        if (User::where('telefono', $request->celular)->exists() || User::where('email', $request->email)->exists()) {
            if (User::where('telefono', $request->celular)->exists()) {
                $user = User::where('telefono', $request->celular)->first();
                $user->razon_social = $request->get('razon_social');
                $user->direccion = $request->get('direccion');
                $user->country = $request->get('country');
                $user->state = $request->get('state');
                $user->postcode = $request->get('postcode');
                $user->city = $request->get('city');
                $user->celular_casa = $request->get('telefono');
                $user->facebook = $request->get('facebook');
                $user->tiktok = $request->get('tiktok');
                $user->instagram = $request->get('instagram');
                $user->pagina_web = $request->get('pagina_web');
                $user->otra_red = $request->get('otra_red');
                $user->puesto = $request->get('puesto');
                $user->curp = $request->get('curp');

                if($request->get('tipo') == 'Centro Evaluación'){
                    $user->user_cam = '4';
                    $user->cam = $request->celular;
                }else if($request->get('tipo') == 'Evaluador Independiente'){
                    $user->user_cam = '3';
                    $user->cam = $request->celular;
                }
                $user->update();
            } else {
                $user = User::where('email', $request->email)->first();
                $user->razon_social = $request->get('razon_social');
                $user->direccion = $request->get('direccion');
                $user->country = $request->get('country');
                $user->state = $request->get('state');
                $user->postcode = $request->get('postcode');
                $user->city = $request->get('city');
                $user->celular_casa = $request->get('telefono');
                $user->facebook = $request->get('facebook');
                $user->tiktok = $request->get('tiktok');
                $user->instagram = $request->get('instagram');
                $user->pagina_web = $request->get('pagina_web');
                $user->otra_red = $request->get('otra_red');
                $user->puesto = $request->get('puesto');
                $user->curp = $request->get('curp');
                if($request->get('tipo') == 'Centro Evaluación'){
                    $user->user_cam = '4';
                    $user->cam = $request->celular;
                }else if($request->get('tipo') == 'Evaluador Independiente'){
                    $user->user_cam = '3';
                    $user->cam = $request->celular;
                }
                $user->update();
            }
            $payer = $user;
        } else {
            $payer = new User();
            $payer->name = $request->get('name');
            $payer->email = $request->get('email');
            $payer->username = $request->get('celular');
            $payer->telefono = $request->get('celular');
            $payer->code = $code;
            $payer->razon_social = $request->get('razon_social');
            $payer->direccion = $request->get('direccion');
            $payer->country = $request->get('country');
            $payer->state = $request->get('state');
            $payer->postcode = $request->get('postcode');
            $payer->city = $request->get('city');
            $payer->celular_casa = $request->get('telefono');
            $payer->facebook = $request->get('facebook');
            $payer->tiktok = $request->get('tiktok');
            $payer->instagram = $request->get('instagram');
            $payer->pagina_web = $request->get('pagina_web');
            $payer->otra_red = $request->get('otra_red');
            $payer->puesto = $request->get('puesto');
            $payer->curp = $request->get('curp');
            $payer->cliente = '1';
            if($request->get('tipo') == 'Centro Evaluación'){
                $payer->user_cam = '4';
                $payer->cam = $request->get('celular');
            }else if($request->get('tipo') == 'Evaluador Independiente'){
                $payer->user_cam = '3';
                $payer->cam = $request->get('celular');
            }
            $payer->membresia = $request->get('membresia');
            $payer->password = Hash::make($request->get('celular'));
            $payer->save();
        }

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $cam_notas = base_path('../public_html/plataforma.imnasmexico.com/cam_notas');
        }else{
            $cam_notas = public_path() . '/cam_notas';
        }

        $notas_cam = new CamNotas;
        $notas_cam->id_cliente = $payer->id;
        $notas_cam->tipo = $request->get('tipo');
        $notas_cam->fecha = date('Y-m-d');
        $notas_cam->membresia = $request->get('membresia');
        $notas_cam->fecha_concluyo = $request->get('fecha_concluyo');
        $notas_cam->fecha_pago = $request->get('fecha_pago');
        $notas_cam->id_usuario = auth()->user()->id;
        $notas_cam->save();

        $estandares = $request->input('estandares');

        for ($count = 0; $count < count($estandares); $count++) {
            $data = array(
                'id_nota' => $notas_cam->id,
                'id_estandar' => $estandares[$count],
                'estatus' => 'Sin estatus',
                'estatus_renovacion' => 'renovo',
                'id_usuario' => auth()->user()->id,
            );
            $insert_data[] = $data;
        }
        CamNotEstandares::insert($insert_data);

        $estandares_operables = $request->input('estandares_operables');

        for ($count = 0; $count < count($estandares_operables); $count++) {
            $data2 = array(
                'id_nota' => $notas_cam->id,
                'id_estandar' => $estandares_operables[$count],
                'estatus' => 'Sin estatus',
                'estatus_renovacion' => 'renovo',
                'operables' => '1',
                'id_usuario' => auth()->user()->id,
            );
            $insert_data2[] = $data2;
        }
        CamNotEstandares::insert($insert_data2);

        $estandares_afines = $request->input('estandares_afines');

        if($estandares_afines){
            for ($count = 0; $count < count($estandares_afines); $count++) {
                $data3 = array(
                    'id_nota' => $notas_cam->id,
                    'id_estandar' => $estandares_afines[$count],
                    'estatus' => 'Entregado',
                    'estatus_renovacion' => 'renovo',
                    'ya_contaba' => '1',
                    'id_usuario' => auth()->user()->id,
                );
                $insert_data3[] = $data3;
            }
            CamNotEstandares::insert($insert_data3);
        }

        $checklist = new CamChecklist;
        $checklist->id_nota = $notas_cam->id;
        $checklist->save();

        $citas = new CamCitas;
        $citas->id_nota = $notas_cam->id;
        $citas->save();

        $documentos = new CamDocumentosUsers;
        $documentos->id_nota = $notas_cam->id;
        $documentos->save();

        $videos = new CamVideosUser;
        $videos->id_nota = $notas_cam->id;
        $videos->id_cliente = $notas_cam->id_cliente;
        $videos->tipo = $request->get('tipo');
        $videos->save();

        return redirect()->route('index.notas')
            ->with('success', 'Nota CAM creada con exito.');
    }

    public function update(Request $request, $id)
    {
        $CamNotas = CamNotas::findOrFail($id);
        $CamNotas->tipo = $request->get('tipo');
        $CamNotas->membresia = $request->get('membresia');
        $CamNotas->monto1 = $request->get('monto1');
        $CamNotas->metodo_pago = $request->get('metodo_pago');
        $CamNotas->monto2 = $request->get('monto2');
        $CamNotas->metodo_pago2 = $request->get('metodo_pago2');
        $CamNotas->comprobante2 = $request->get('comprobante2');
        $CamNotas->nota = $request->get('nota');
        $CamNotas->referencia = $request->get('referencia');
        $CamNotas->update();

        $CamUser = User::where('id', $CamNotas->id_cliente)->first();
        $CamUser->name = $request->get('name');
        $CamUser->telefono = $request->get('celular');
        $CamUser->celular_casa = $request->get('telefono');
        $CamUser->password = Hash::make($request->get('celular'));
        $CamUser->email = $request->get('email');
        $CamUser->curp = $request->get('curp');
        $CamUser->razon_social = $request->get('razon_social');
        $CamUser->direccion = $request->get('direccion');
        $CamUser->state = $request->get('state');
        $CamUser->postcode = $request->get('postcode');
        $CamUser->country = $request->get('country');
        $CamUser->city = $request->get('city');
        $CamUser->facebook = $request->get('facebook');
        $CamUser->tiktok = $request->get('tiktok');
        $CamUser->instagram = $request->get('instagram');
        $CamUser->pagina_web = $request->get('pagina_web');
        $CamUser->otra_red = $request->get('otra_red');
        $CamUser->puesto = $request->get('puesto');
        $CamUser->rfc = $request->get('rfc');
        $CamUser->update();

        return redirect()->back()->with('success', 'Se edito con exito.');
    }
}
