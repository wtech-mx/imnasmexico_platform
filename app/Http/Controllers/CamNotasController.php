<?php

namespace App\Http\Controllers;

use App\Models\Cam\CamChecklist;
use App\Models\Cam\CamCitas;
use App\Models\Cam\CamDocumentosUsers;
use App\Models\Cam\CamNotas;
use App\Models\Cam\CamVideosUser;
use App\Models\CamContrato;
use App\Models\CarpetasEstandares;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Hash;
use App\Models\Cam\CamNotEstandares;

class CamNotasController extends Controller
{
    public function index(){
        $notas_cam = CamNotas::where('nota', '=', 'CAM Nuevo')->get();

        return view('admin.notas_cam.cam_users.index', compact('notas_cam'));
    }

    public function store(Request $request){
        $code = Str::random(8);
        if (User::where('telefono', $request->celular)->exists() || User::where('email', $request->email)->exists()) {
            if (User::where('telefono', $request->celular)->exists()) {
                $user = User::where('telefono', $request->celular)->first();
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
            $notas_cam = CamNotas::where('id_cliente', $user->id)->first();
        } else {
            $payer = new User();
            $payer->name = $request->get('name');
            $payer->email = $request->get('email');
            $payer->username = $request->get('celular');
            $payer->telefono = $request->get('celular');
            $payer->code = $code;
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

            $notas_cam = new CamNotas;
            $notas_cam->id_cliente = $payer->id;
            $notas_cam->tipo = $request->get('tipo');
            $notas_cam->fecha = date('Y-m-d');
            $notas_cam->membresia = $request->get('membresia');
            $notas_cam->id_usuario = auth()->user()->id;
            $notas_cam->nota = 'CAM Nuevo';
            $notas_cam->save();

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
        }

        $contrato = new CamContrato;
        $contrato->id_nota = $notas_cam->id;
        $contrato->save();

        return redirect()->back()->with('success', 'Creado con exito.');
    }

    public function edit_citas(Request $request, $code){
        $cliente = User::where('code', $code)->first();
        $notas_cam = CamNotas::where('id_cliente', '=', $cliente->id)->first();
        $cita_cam = CamCitas::where('id_nota', '=', $notas_cam->id)->first();

        return view('admin.notas_cam.cam_users.independiente.citas', compact('cita_cam', 'cliente'));
    }

    public function citas_independiente(Request $request, $id){
        $notas_cam = CamNotas::where('id_cliente', '=', $id)->first();
        $cita_cam = CamCitas::where('id_nota', '=', $notas_cam->id)->first();

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_estandar = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $request->get('telefono') .'/');
        }else{
            $ruta_estandar = public_path() . '/documentos/' .$request->get('telefono').'/';
        }

        $cita = CamCitas::find($cita_cam->id);
            $cita->evaluacion_ec0076 = $request->get('evaluacion_ec0076');
            $cita->check1 = 1;

            $cita->evaluacion_afines = $request->get('evaluacion_afines');
            $cita->check2 = 1;

            $cita->refuerzo_conocimiento = $request->get('refuerzo_conocimiento');
            $cita->check3 = 1;

            $cita->refuerzo_formatos = $request->get('refuerzo_formatos');
            $cita->check4 = 1;

            $cita->coaching_empresarial = $request->get('coaching_empresarial');
            $cita->check5 = 1;

            $cita->carpeta_cam = $request->get('carpeta_cam');
            $cita->check6 = 1;

            if (!file_exists($ruta_estandar)) {
                mkdir($ruta_estandar, 0777, true); // Crear el directorio con permisos de escritura
            }

            $image_parts = explode(";base64,", $request->signed);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $ruta_estandar . $signature;
            file_put_contents($file, $image_base64);
            $cita->firma = $signature;
        $cita->update();

        return redirect()->back()->with('success', 'Datos actualizado con exito.');
    }

    public function edit_contrato($code){
        $cliente = User::where('code', $code)->first();
        $notas_cam = CamNotas::where('id_cliente', '=', $cliente->id)->first();
        $contrato_cam = CamContrato::where('id_nota', '=', $notas_cam->id)->first();

        $fecha = date('Y-m-d');

        return view('admin.notas_cam.cam_users.independiente.contrato', compact('contrato_cam', 'cliente', 'fecha'));
    }

    public function contrato_independiente(Request $request, $id){
        $cliente = User::where('id', $id)->first();
        $notas_cam = CamNotas::where('id_cliente', '=', $id)->first();
        $contrato_cam = CamContrato::where('id_nota', '=', $notas_cam->id)->first();

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_estandar = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $cliente->telefono .'/');
        }else{
            $ruta_estandar = public_path() . '/documentos/' .$cliente->telefono.'/';
        }

        $contrato = CamContrato::find($contrato_cam->id);
            $contrato->nombre = $request->get('nombre');
            $contrato->dato_general = $request->get('dato_general');
            $contrato->rfc = $request->get('rfc');
            $contrato->identificacion_ofi = $request->get('identificacion_ofi');
            $contrato->domicilio = $request->get('domicilio');
            $contrato->fecha = $request->get('fecha');

            if (!file_exists($ruta_estandar)) {
                mkdir($ruta_estandar, 0777, true); // Crear el directorio con permisos de escritura
            }

            $image_parts = explode(";base64,", $request->signed2);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $ruta_estandar . $signature;
            file_put_contents($file, $image_base64);
            $contrato->firma = $signature;
        $contrato->update();

        return redirect()->back()->with('success', 'Datos actualizado con exito.');
    }

    public function edit_carta($code){
        $cliente = User::where('code', $code)->first();
        $notas_cam = CamNotas::where('id_cliente', '=', $cliente->id)->first();

        $fecha = date('Y-m-d');

        return view('admin.notas_cam.cam_users.independiente.carta_compromiso', compact('notas_cam', 'cliente', 'fecha'));
    }

    public function carta_independiente(Request $request, $id){
        $cliente = User::where('id', $id)->first();
        $cliente->name = $request->get('nombre');
        $cliente->update();

        $notas_cam = CamNotas::where('id_cliente', '=', $id)->first();

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_estandar = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $cliente->telefono .'/');
        }else{
            $ruta_estandar = public_path() . '/documentos/' .$cliente->telefono.'/';
        }

        $nota = CamNotas::find($notas_cam->id);
            $nota->fecha_carta = $request->get('fecha_carta');

            if (!file_exists($ruta_estandar)) {
                mkdir($ruta_estandar, 0777, true); // Crear el directorio con permisos de escritura
            }

            $image_parts = explode(";base64,", $request->signed2);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $ruta_estandar . $signature;
            file_put_contents($file, $image_base64);
            $nota->firma_carta = $signature;
        $nota->update();

        return redirect()->back()->with('success', 'Datos actualizado con exito.');
    }

    public function edit_formato($code){
        $cliente = User::where('code', $code)->first();
        $notas_cam = CamNotas::where('id_cliente', '=', $cliente->id)->first();
        $estandares_cam = CarpetasEstandares::where('nombre', 'LIKE', 'EC%')
        ->orderBy('nombre', 'asc')
        ->get();

        $existeNota = CamNotEstandares::where('id_nota', $notas_cam->id)->exists();
        $estandares_nota = CamNotEstandares::where('id_nota', $notas_cam->id)->get();

        return view('admin.notas_cam.cam_users.independiente.formato', compact('notas_cam', 'cliente', 'estandares_cam', 'existeNota', 'estandares_nota'));
    }

    public function formato_independiente(Request $request, $id){

        $cliente = User::where('id', $id)->first();
        $notas_cam = CamNotas::where('id_cliente', '=', $cliente->id)->first();

        $cliente->fecha_formato = $request->get('fecha_formato');
        $cliente->puesto = $request->get('puesto');
        $cliente->direccion = $request->get('direccion');
        $cliente->city = $request->get('city');
        $cliente->postcode = $request->get('postcode');
        $cliente->state = $request->get('state');
        $cliente->country = $request->get('country');
        $cliente->telefono = $request->get('telefono');
        $cliente->pagina_web = $request->get('pagina_web');
        $cliente->email = $request->get('email');
        $cliente->celular_casa = $request->get('celular_casa');
        $cliente->email_alterno = $request->get('email_alterno');
        $cliente->update();

        $estandares = $request->input('estandares');

        for ($count = 0; $count < count($estandares); $count++) {
            if($estandares[$count] !== null){
                $data = array(
                    'id_nota' => $notas_cam->id,
                    'id_estandar' => $estandares[$count],
                    'estatus' => 'Sin estatus',
                    'estatus_renovacion' => 'renovo',
                );
                $insert_data[] = $data;
            }
        }
        CamNotEstandares::insert($insert_data);

        return redirect()->back()->with('success', 'Datos actualizado con exito.');
    }

    public function edit_checklist($code){
        $cliente = User::where('code', $code)->first();
        $notas_cam = CamNotas::where('id_cliente', '=', $cliente->id)->first();
        $checklist = CamChecklist::where('id_nota', '=', $notas_cam->id)->first();

        return view('admin.notas_cam.cam_users.independiente.programa', compact('notas_cam', 'cliente', 'checklist'));
    }

    public function checklist_independiente(Request $request, $id){

        $cliente = User::where('id', $id)->first();
        $cliente->razon_social = $request->get('razon_social');
        $cliente->fecha_checklist = $request->get('fecha_checklist');
        $cliente->responsable_entrega = $request->get('responsable_entrega');
        $cliente->recibe_verifica = $request->get('recibe_verifica');
        $cliente->update();

        $notas_cam = CamNotas::where('id_cliente', '=', $cliente->id)->first();
        $checklist = CamChecklist::where('id_nota', '=', $notas_cam->id)->first();
        $checklist->c1 = $request->get('solicitud');
        $checklist->c2 = $request->get('contrato');
        $checklist->c3 = $request->get('carta');
        $checklist->c4 = $request->get('identificacion');
        $checklist->c5 = $request->get('curp');
        $checklist->c6 = $request->get('logo');
        $checklist->c7 = $request->get('comproante');
        $checklist->c8 = $request->get('registro_marca');
        $checklist->c9 = $request->get('reconocimiento');
        $checklist->c10 = $request->get('cv');
        $checklist->c11 = $request->get('acta');
        $checklist->c12 = $request->get('firma_contrato');
        $checklist->c13 = $request->get('firma_acuerdo');
        $checklist->c14 = $request->get('firma_nombramiento');
        $checklist->c15 = $request->get('firma_listado');
        $checklist->c16 = $request->get('firma_medios');
        $checklist->c17 = $request->get('firma_redesociales');
        $checklist->c18 = $request->get('firma_lista_precios');
        $checklist->c19 = $request->get('entrega_manuales');
        $checklist->c20 = $request->get('entrega_reglamento');
        $checklist->c21 = $request->get('entrega_manual');
        $checklist->c22 = $request->get('entrega_manual_atencion');
        $checklist->c23 = $request->get('entrega_manual_participante');
        $checklist->c24 = $request->get('entrega_ligas_accesos');
        $checklist->c25 = $request->get('entrega_ligas_video');
        $checklist->c26 = $request->get('entrega_logos');
        $checklist->c27 = $request->get('entrega_especificaciones');
        $checklist->c28 = $request->get('entrega_papeleria');
        $checklist->c29 = $request->get('entrega_triptico');
        $checklist->c30 = $request->get('entregas_formatos');
        $checklist->c31 = $request->get('entrega_formatos_seguimientos');
        $checklist->c32 = $request->get('c32');
        $checklist->update();


        return redirect()->back()->with('success', 'Datos actualizado con exito.');
    }

}
