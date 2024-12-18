<?php

namespace App\Http\Controllers\Cam;

use App\Http\Controllers\Controller;
use App\Models\Cam\CamCarpetaDocumentos;
use App\Models\Cam\CamCedulas;
use App\Models\Cam\CamCertificados;
use App\Models\Cam\CamChecklist;
use App\Models\Cam\CamCitas;
use App\Models\Cam\CamDiplomas;
use App\Models\Cam\CamDocExp;
use App\Models\Cam\CamDocuemntos;
use App\Models\Cam\CamDocumentosUsers;
use App\Models\Cam\CamEstandares;
use App\Models\Cam\CamMiniExp;
use App\Models\Cam\CamMiniExpDiplomas;
use App\Models\Cam\CamNombramiento;
use App\Models\Cam\CamNotas;
use App\Models\Cam\CamNotEstandares;
use App\Models\Cam\CamPagosEmision;
use App\Models\Cam\CamPagosEstandar;
use App\Models\Cam\CamPagosRenovacion;
use App\Models\Cam\CamRenoEstandares;
use App\Models\Cam\CamVideosUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Cam\CamVideos;
use App\Models\CarpetasEstandares;

class CamExpedientesController extends Controller
{

    public function index_ind(){

        $expedientes = CamNotas::where('tipo', 'Evaluador Independiente')->get();
        return view('cam.admin.expedientes.index', compact('expedientes'));
    }

    public function update_estatus_expedientes(Request $request,$id){

        $user = User::find($id);
        $user->estatus_exp = $request->get('estatus_exp');

        $user->update();

        return redirect()->back()->with('success', 'Datos actualizados exitosamente');

    }

    public function edit($id_nota){

        $expediente = CamCitas::where('id_nota', $id_nota)->first();
        $documentos = CamDocumentosUsers::where('id_nota', $id_nota)->firstOrFail();
        $check = CamChecklist::where('id_nota', $id_nota)->firstOrFail();
        $estandares_usuario = CamNotEstandares::where('id_nota', $id_nota)->where('estatus_renovacion', '=', 'renovo')->get();
        $video = CamVideosUser::where('id_nota', $id_nota)->first();
        $estandares_cam_user = CamNotEstandares::where('id_nota', $id_nota)->where('estatus_renovacion', '=', 'renovo')->where('estatus', '=', 'Entregado')->get();
        $estandares_cam = CarpetasEstandares::where('nombre', 'not like', '%Formulario%')
        ->where('nombre', 'not like', '%Carta%')
        ->orderBy('nombre', 'asc')
        ->get();
        $minis_exps = CamMiniExp::where('id_nota', $id_nota)->get();
        $videos_dinamicos = CamVideos::where('tipo','=',$video->tipo)->orderBy('orden','ASC')->get();
        $pagos_emision = CamPagosEmision::where('id_nota', $id_nota)->get();
        $pagos_estandar = CamPagosEstandar::where('id_nota', $id_nota)->get();
        $pagos_renovacion = CamPagosRenovacion::where('id_nota', $id_nota)->get();
        $estandares_cam_comprados = CamNotEstandares::where('id_nota', $id_nota)->where('estatus_renovacion', '=', 'renovo')->get();
        $estandares_cam_reno = CamNotEstandares::where('id_nota', $id_nota)->get();
        $estandares_renovacion = CamRenoEstandares::where('id_nota', $id_nota)->get();

        return view('cam.admin.expedientes.exp_ind', compact('estandares_renovacion','estandares_cam_reno','estandares_cam_comprados','pagos_renovacion','pagos_emision', 'pagos_estandar', 'estandares_cam_user','expediente', 'estandares_usuario', 'documentos', 'check', 'video', 'estandares_cam', 'minis_exps','videos_dinamicos'));
    }

    public function index_centro(){
        $expedientes = CamNotas::where('tipo', 'Centro Evaluación')->get();
        return view('cam.admin.expedientes.index_centro', compact('expedientes'));
    }

    public function edit_centro($id){
        $expediente = CamCitas::where('id_nota', $id)->first();
        $documentos = CamDocumentosUsers::where('id_nota', $id)->firstOrFail();
        $check = CamChecklist::where('id_nota', $id)->firstOrFail();
        $estandares_usuario = CamNotEstandares::where('id_nota', $id)->where('estatus_renovacion', '=', 'renovo')->where('id_mini_exp', '=', NULL)->get();
        $video = CamVideosUser::where('id_nota', $id)->first();
        $estandares_cam_user = CamNotEstandares::where('id_nota', $id)->where('estatus_renovacion', '=', 'renovo')->where('estatus', '=', 'Entregado')->get();

        $estandares_cam = CarpetasEstandares::where('nombre', 'not like', '%Formulario%')
        ->where('nombre', 'not like', '%Carta%')
        ->orderBy('nombre', 'asc')
        ->get();

        $minis_exps = CamMiniExp::where('id_nota', $id)->get();
        $videos_dinamicos = CamVideos::where('tipo','=',$video->tipo)->orderBy('orden','ASC')->get();
        $pagos_emision = CamPagosEmision::where('id_nota', $id)->get();
        $pagos_estandar = CamPagosEstandar::where('id_nota', $id)->get();
        $pagos_renovacion = CamPagosRenovacion::where('id_nota', $id)->get();
        $estandares_cam_comprados = CamNotEstandares::where('id_nota', $id)->where('estatus_renovacion', '=', 'renovo')->get();
        $estandares_cam_reno = CamNotEstandares::where('id_nota', $id)->get();
        $estandares_renovacion = CamRenoEstandares::where('id_nota', $id)->get();

        return view('cam.admin.expedientes.exp_centro', compact('estandares_renovacion','estandares_cam_reno','estandares_cam_comprados','pagos_renovacion','pagos_emision', 'pagos_estandar','videos_dinamicos','expediente', 'estandares_usuario', 'estandares_cam_user','documentos', 'check', 'video', 'estandares_cam', 'minis_exps'));
    }

    public function update_estatus(Request $request, $id){

        $estandar = CamNotEstandares::find($id);
        $estandar->evaluador = $request->get('evaluador');
        $estandar->estatus = $request->get('estatus');
        $estandar->fecha_evaluar = $request->get('fecha_evaluar');
        $estandar->update();

        return redirect()->back()->with('success', 'Estatus actualizado exitosamente');
    }

    public function update_exp_user(Request $request, $id){

        $user = User::find($id);
        $user->num_user = $request->get('num_user');
        $user->usuario_eva = $request->get('usuario_eva');
        $user->contrasena_eva = $request->get('contrasena_eva');
        $user->costo_emi = $request->get('costo_emi');
        $user->nomb_centro = $request->get('nomb_centro');

        $user->update();

        return redirect()->back()->with('success', 'Datos actualizados exitosamente');
    }

    public function pago_nueva_emision(Request $request){

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $cam_notas = base_path('../public_html/plataforma.imnasmexico.com/cam_pagos');
        }else{
            $cam_notas = public_path() . '/cam_pagos';
        }

        $notas_cam = new CamPagosEmision;
        $notas_cam->id_nota = $request->get('id_nota');
        $notas_cam->id_cliente = $request->get('id_cliente');
        $notas_cam->id_estandar = $request->get('estandares');
        $notas_cam->nombre = $request->get('nombre');
        $notas_cam->estandar = $request->get('estandares');
        $notas_cam->num_portafolios = $request->get('portafolios');
        $notas_cam->cantidad_total = $request->get('cantidad_total_emision');
        $notas_cam->id_usuario = auth()->user()->id;
        if ($request->hasFile("comprobante_pago")) {
            $file = $request->file('comprobante_pago');
            $path = $cam_notas;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $notas_cam->comprobante_pago = $fileName;
        }
        $notas_cam->save();

        return redirect()->back()
            ->with('success', 'Nueva emision creada con exito.');
    }

    public function pago_nuevo_estandar(Request $request){

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $cam_notas = base_path('../public_html/plataforma.imnasmexico.com/cam_pagos');
        }else{
            $cam_notas = public_path() . '/cam_pagos';
        }

        $notas_cam = new CamPagosEstandar;
        $notas_cam->id_nota = $request->get('id_nota');
        $notas_cam->id_cliente = $request->get('id_cliente');
        $notas_cam->operatividad = $request->get('operatividad');
        $notas_cam->cantidad_total = $request->get('cantidad_total');
        $notas_cam->id_usuario = auth()->user()->id;
        if ($request->hasFile("comprobante_pago")) {
            $file = $request->file('comprobante_pago');
            $path = $cam_notas;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $notas_cam->comprobante_pago = $fileName;
        }
        $notas_cam->save();

        $estandares = $request->input('estandares');

        if($request->get('operatividad') == 1){
            for ($count = 0; $count < count($estandares); $count++) {
                $data = array(
                    'id_nota' => $request->get('id_nota'),
                    'id_estandar' => $estandares[$count],
                    'estatus' => 'Sin estatus',
                    'operables' => '1',
                    'estatus_renovacion' => 'renovo',
                    'id_usuario' => auth()->user()->id,
                    'id_pago' => $notas_cam->id,
                );
                $insert_data[] = $data;
            }
            CamNotEstandares::insert($insert_data);
        }else{
            for ($count = 0; $count < count($estandares); $count++) {
                $data = array(
                    'id_nota' => $request->get('id_nota'),
                    'id_estandar' => $estandares[$count],
                    'estatus' => 'Sin estatus',
                    'estatus_renovacion' => 'renovo',
                    'id_usuario' => auth()->user()->id,
                    'id_pago' => $notas_cam->id,
                );
                $insert_data[] = $data;
            }
            CamNotEstandares::insert($insert_data);
        }

        return redirect()->back()
            ->with('success', 'Nuevo estandar agregado con exito.');
    }

    public function pago_renovacion(Request $request){

        $fechaActual = date('Y-m-d');
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $cam_notas = base_path('../public_html/plataforma.imnasmexico.com/cam_pagos');
        }else{
            $cam_notas = public_path() . '/cam_pagos';
        }

        $notas_cam = new CamPagosRenovacion;
        $notas_cam->id_nota = $request->get('id_nota');
        $notas_cam->id_cliente = $request->get('id_cliente');
        $notas_cam->cantidad_total = $request->get('cantidad_total');
        $notas_cam->fecha = $fechaActual;
        $notas_cam->id_usuario = auth()->user()->id;
        if ($request->hasFile("comprobante_pago")) {
            $file = $request->file('comprobante_pago');
            $path = $cam_notas;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $notas_cam->comprobante_pago = $fileName;
        }
        $notas_cam->save();

        $estandares = $request->input('estandares_renovacion');

        $registrosNota = CamNotEstandares::where('id_nota', $request->get('id_nota'))->get();

        // Itera sobre todos los registros y actualiza sus estatus
        foreach ($registrosNota as $registro) {
            // Si el ID del registro está en los seleccionados, actualiza con el nuevo estatus_renovacion

            if (in_array($registro->id, $estandares)) {
                $registro->estatus_renovacion = 'renovo';
                $registro->update();
            } else {
                // Si no está seleccionado, actualiza con otro estatus_renovacion
                $registro->estatus_renovacion = 'no renovo';
                $registro->update();
            }
        }

        for ($count = 0; $count < count($estandares); $count++) {
            $data = array(
                'id_nota' => $request->get('id_nota'),
                'id_estandar' => $estandares[$count],
                'id_renovacion' => $notas_cam->id,
            );
            $insert_data[] = $data;
        }
        CamRenoEstandares::insert($insert_data);

        return redirect()->back()
            ->with('success', 'Renovacion con exito.');
    }

    public function update_citas(Request $request, $id){

        $cita = CamCitas::find($id);
        $cita->evaluacion_ec0076 = $request->get('evaluacion_ec0076');
        $cita->check1 = $request->get('check1');
        if($request->get('check1') != NULL){
            $cita->id_usuario_ec = auth()->user()->id;
        }

        $cita->evaluacion_afines = $request->get('evaluacion_afines');
        $cita->check2 = $request->get('check2');
        if($request->get('check2') != NULL){
            $cita->id_usuario_afin = auth()->user()->id;
        }

        $cita->refuerzo_conocimiento = $request->get('refuerzo_conocimiento');
        $cita->check3 = $request->get('check3');
        if($request->get('check3') != NULL){
            $cita->id_usuario_cono = auth()->user()->id;
        }

        $cita->refuerzo_formatos = $request->get('refuerzo_formatos');
        $cita->check4 = $request->get('check4');
        if($request->get('check4') != NULL){
            $cita->id_usuario_form = auth()->user()->id;
        }

        $cita->coaching_empresarial = $request->get('coaching_empresarial');
        $cita->check5 = $request->get('check5');
        if($request->get('check5') != NULL){
            $cita->id_usuario_empr = auth()->user()->id;
        }

        $cita->carpeta_cam = $request->get('carpeta_cam');
        $cita->check6 = $request->get('check6');
        if($request->get('check6') != NULL){
            $cita->id_usuario_carpeta = auth()->user()->id;
        }

        $cita->update();

        return redirect()->back()->with('success', 'Datos actualizado con exito.');
    }

    public function update_check(Request $request, $id){
        $dominio = $request->getHost();

        $doc = CamDocumentosUsers::where('id_nota', $id)->first();

        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_recursos = base_path('../public_html/plataforma.imnasmexico.com/cam/doc/' . $doc->Nota->Cliente->telefono);
        }else{
            $ruta_recursos = public_path() . '/cam/doc/' . $doc->Nota->Cliente->telefono;
        }

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $doc->foto = $fileName;
        }

        if ($request->hasFile("logo")) {
            $file = $request->file('logo');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $doc->logo = $fileName;
        }

        if ($request->hasFile("acuerdo_confidencialidad")) {
            $file = $request->file('acuerdo_confidencialidad');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $doc->acuerdo_confidencialidad = $fileName;
        }

        if ($request->hasFile("comprobante_domicilio")) {
            $file = $request->file('comprobante_domicilio');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $doc->comprobante_domicilio = $fileName;
        }

        if ($request->hasFile("curriculum")) {
            $file = $request->file('curriculum');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $doc->curriculum = $fileName;
        }

        if ($request->hasFile("contrato_individual")) {
            $file = $request->file('contrato_individual');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $doc->contrato_individual = $fileName;
        }

        if ($request->hasFile("ine")) {
            $file = $request->file('ine');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $doc->ine = $fileName;
        }

        if ($request->hasFile("curp")) {
            $file = $request->file('curp');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $doc->curp = $fileName;
        }

        if ($request->hasFile("acta_nacimiento")) {
            $file = $request->file('acta_nacimiento');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $doc->acta_nacimiento = $fileName;
        }

        if ($request->hasFile("estandar_76")) {
            $file = $request->file('estandar_76');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $doc->estandar_76 = $fileName;
        }

        if ($request->hasFile("contrato_general")) {
            $file = $request->file('contrato_general');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $doc->contrato_general = $fileName;
        }

        if ($request->hasFile("solicitud_acreditacion")) {
            $file = $request->file('solicitud_acreditacion');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $doc->solicitud_acreditacion = $fileName;
        }

        if ($request->hasFile("carta_compromiso")) {
            $file = $request->file('carta_compromiso');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $doc->carta_compromiso = $fileName;
        }

        if ($request->hasFile("carta_responsabilidad")) {
            $file = $request->file('carta_responsabilidad');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $doc->carta_responsabilidad = $fileName;
        }

        if ($request->hasFile("nombramiento")) {
            $file = $request->file('nombramiento');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $doc->nombramiento = $fileName;
        }

        if ($request->hasFile("rfc")) {
            $file = $request->file('rfc');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $doc->rfc = $fileName;
        }
        $doc->update();

        $check = CamChecklist::where('id_nota', $id)->first();
        if($request->hasFile('acuerdo_confidencialidad') != NULL){
            $check->c2 = '1';
            $check->id_usuario2 = auth()->user()->id;
        }
        if($request->hasFile('logo') != NULL){
            $check->c1 = '1';
            $check->id_usuario1 = auth()->user()->id;
        }
        if($request->hasFile('comprobante_domicilio') != NULL){
            $check->c3 = '1';
            $check->id_usuario3 = auth()->user()->id;
        }
        if($request->hasFile('contrato_individual') != NULL){
            $check->c4 = '1';
            $check->id_usuario4 = auth()->user()->id;
        }
        if($request->hasFile('curriculum') != NULL){
            $check->c5 = '1';
            $check->id_usuario5 = auth()->user()->id;
        }
        if($request->hasFile('ine') != NULL){
            $check->c6 = '1';
            $check->id_usuario6 = auth()->user()->id;
        }
        if($request->hasFile('curp') != NULL){
            $check->c7 = '1';
            $check->id_usuario7 = auth()->user()->id;
        }
        if($request->hasFile('acta_nacimiento') != NULL){
            $check->c8 = '1';
            $check->id_usuario8 = auth()->user()->id;
        }
        $check->update();

        return redirect()->back()->with('success', 'Datos actualizados con exito.');
    }

    public function update_checklist(Request $request, $id){

        $check = CamChecklist::where('id_nota', $id)->first();
        $data = $request->except(['_token', '_method']);
        $check->update($data);

        return redirect()->back()->with('success', 'Datos actualizados con exito.');
    }

    public function update_check_centro(Request $request, $id){

        $check = CamChecklist::where('id_nota', $id)->first();
        $data = $request->except(['_token', '_method']);
        $check->update($data);

        return redirect()->back()->with('success', 'Datos actualizado con exito.');
    }

    public function crear_nomb(Request $request){
        $dominio = $request->getHost();

            if($dominio == 'plataforma.imnasmexico.com'){
                $ruta_recursos = base_path('../public_html/plataforma.imnasmexico.com/cam_doc_general/');
            }else{
                $ruta_recursos = public_path() . '/cam_doc_general/';
            }

            $id_nota = $request->get('id_nota');
            $id_cliente = $request->get('id_cliente');
            if($request->get('categoria') == 'cedula'){
                if ($request->hasFile('foto')) {
                    $foto = $request->file('foto');
                    foreach ($foto as $archivo) {
                        $path = $ruta_recursos;
                        $fileName = uniqid() . $archivo->getClientOriginalName();
                        $archivo->move($path, $fileName);
                        $nomb = new CamCedulas;
                        $nomb->nombre = $fileName;
                        $nomb->id_nota = $id_nota;
                        $nomb->id_cliente = $id_cliente;
                        $nomb->save();
                    }
                }
            }

            if($request->get('categoria') == 'certificados'){
                if ($request->hasFile('foto')) {
                    $foto = $request->file('foto');
                    foreach ($foto as $archivo) {
                        $path = $ruta_recursos;
                        $fileName = uniqid() . $archivo->getClientOriginalName();
                        $archivo->move($path, $fileName);
                        $nomb = new CamCertificados;
                        $nomb->nombre = $fileName;
                        $nomb->id_nota = $id_nota;
                        $nomb->id_cliente = $id_cliente;
                        $nomb->save();
                    }
                }
            }

            if($request->get('categoria') == 'diplomas'){
                if ($request->hasFile('foto')) {
                    $foto = $request->file('foto');
                    foreach ($foto as $archivo) {
                        $path = $ruta_recursos;
                        $fileName = uniqid() . $archivo->getClientOriginalName();
                        $archivo->move($path, $fileName);
                        $nomb = new CamDiplomas;
                        $nomb->nombre = $fileName;
                        $nomb->id_nota = $id_nota;
                        $nomb->id_cliente = $id_cliente;
                        $nomb->id_usuario = auth()->user()->id;
                        $nomb->save();
                    }
                }
            }

        $nomb->save();

        return redirect()->back()->with('success', 'Archivo subido exitosamente');
    }

    public function obtenerArchivosPorCategoria(Request $request){
        $categoria = $request->input('categoria');
        $expedienteId = intval($request->input('expediente_id'));
        if($categoria == 'certificado'){
            $archivos = CamCertificados::where('id_nota', $expedienteId)->get();
        }elseif($categoria == 'cedula'){
            $archivos = CamCedulas::where('id_nota', $expedienteId)->get();
        }elseif($categoria == 'nombramiento'){
            $archivos = CamNombramiento::where('id_nota', $expedienteId)->get();
        }elseif($categoria == 'diplomas'){
            $archivos = CamDiplomas::where('id_nota', $expedienteId)->get();
        }else{
            $archivos = CamDocuemntos::where('id_carpdoc', $categoria)->get();
        }

        return response()->json($archivos);
    }

    public function obtenerCarpetasCompradas($notaId) {
        $carpetas = CamNotEstandares::where('id_nota', $notaId)->with('Estandar')->get();
        $nombresCarpetas = $carpetas->pluck('Estandar.estandar');
        return response()->json($nombresCarpetas);

    }

    public function obtenerDocumentosPorCarpeta(Request $request) {

        $nombreCarpeta = $request->input('nombre_carpeta');
        $carpdocumentos = CamCarpetaDocumentos::where('nombre', $nombreCarpeta )->first();
        $documentos = CamDocuemntos::where('id_carpdoc', $carpdocumentos->id)->get();

        return response()->json($documentos);
    }

    public function edit_mini($id){
        $mini_exp = CamMiniExp::where('id', $id)->first();
        $mini_exp_diplomas = CamMiniExpDiplomas::where('id_mini', $id)->get();

        $expediente = CamCitas::where('id_nota', $mini_exp->id_nota)->first();
        $estandares_cam = CamEstandares::get();
        $video = CamVideosUser::where('id_nota', $mini_exp->id_nota)->first();
        $documentos = CamDocumentosUsers::where('id_nota', $mini_exp->id_nota)->firstOrFail();
        $minis_exps = CamMiniExp::where('id_nota', $expediente->id_nota)->get();
        $minis_exp_nom = CamNombramiento::where('id_mini_exp', $mini_exp->id)->get();
        $minis_exp_cer = CamCertificados::where('id_mini_exp', $mini_exp->id)->get();
        $estandares_cam_user = CamNotEstandares::where('id_nota', $mini_exp->id_nota)->where('estatus', '=', 'Entregado')->get();
        $estandares_cam_mini = CamNotEstandares::where('id_mini_exp', $mini_exp->id)->get();

        return view('cam.admin.expedientes.mini_exp', compact('estandares_cam_mini','estandares_cam_user','minis_exp_nom','minis_exp_cer','estandares_cam', 'expediente', 'mini_exp', 'video', 'documentos', 'mini_exp_diplomas', 'minis_exps'));
    }

    public function crear_estandar_mini(Request $request){


        $notas_cam = new CamNotEstandares;
        $notas_cam->id_nota = $request->get('id_nota');
        $notas_cam->id_mini_exp = $request->get('id');
        $notas_cam->id_estandar = $request->get('id_estandar');
        $notas_cam->estatus = $request->get('estatus');
        $notas_cam->fecha_evaluar = $request->get('fecha_evaluar');
        $notas_cam->id_usuario = auth()->user()->id;
        $notas_cam->save();

        return redirect()->back()
            ->with('success', 'Nuevo estandar agregado con exito.');
    }

    public function crear_mini(Request $request){
        $dominio = $request->getHost();

        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_recursos = base_path('../public_html/plataforma.imnasmexico.com/cam_mini_exp/' . $request->get('celular'));
        }else{
            $ruta_recursos = public_path() . '/cam_mini_exp/' . $request->get('celular');
        }

        $mini_exp = new CamMiniExp();
        $mini_exp->nombre = $request->get('name');
        $mini_exp->apellido = $request->get('apellido');
        $mini_exp->email = $request->get('email');
        $mini_exp->telefono = $request->get('telefono');
        $mini_exp->celular = $request->get('celular');
        $mini_exp->id_nota = $request->get('id_nota');
        $mini_exp->id_cliente = $request->get('id_client');
        $mini_exp->id_usuario = auth()->user()->id;

        if ($request->hasFile("acta")) {
            $file = $request->file('acta');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $mini_exp->acta = $fileName;
        }

        if ($request->hasFile("curp")) {
            $file = $request->file('curp');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $mini_exp->curp = $fileName;
        }

        if ($request->hasFile("ine")) {
            $file = $request->file('ine');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $mini_exp->ine = $fileName;
        }

        if ($request->hasFile("comprobante")) {
            $file = $request->file('comprobante');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $mini_exp->comprobante = $fileName;
        }
        $mini_exp->save();

        if ($request->hasFile('diplomas')) {
            $foto = $request->file('diplomas');
            foreach ($foto as $archivo) {
                $path = $ruta_recursos;
                $fileName = uniqid() . $archivo->getClientOriginalName();
                $archivo->move($path, $fileName);
                $nomb = new CamMiniExpDiplomas;
                $nomb->diplomas = $fileName;
                $nomb->id_mini = $mini_exp->id;
                $nomb->save();
            }
            $nomb->save();
        }


        return redirect()->back()->with('success', 'Archivo subido exitosamente');
    }

    public function update_mini(Request $request, $id){
        $dominio = $request->getHost();
        $mini = CamMiniExp::where('id', $id)->first();

        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_recursos = base_path('../public_html/plataforma.imnasmexico.com/cam_mini_exp/' . $mini->celular);
        }else{
            $ruta_recursos = public_path() . '/cam_mini_exp/' . $mini->celular;
        }

        if ($request->hasFile("acta")) {
            $file = $request->file('acta');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $mini->acta = $fileName;
        }

        if ($request->hasFile("curp")) {
            $file = $request->file('curp');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $mini->curp = $fileName;
        }

        if ($request->hasFile("ine")) {
            $file = $request->file('ine');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $mini->ine = $fileName;
        }

        if ($request->hasFile("comprobante")) {
            $file = $request->file('comprobante');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $mini->comprobante = $fileName;
        }

        if ($request->hasFile("contrato_individual")) {
            $file = $request->file('contrato_individual');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $mini->contrato_individual = $fileName;
        }

        if ($request->hasFile("confidencialidad")) {
            $file = $request->file('confidencialidad');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $mini->confidencialidad = $fileName;
        }
        $mini->save();

        if ($request->hasFile('diplomas')) {
            $foto = $request->file('diplomas');
            foreach ($foto as $archivo) {
                $path = $ruta_recursos;
                $fileName = uniqid() . $archivo->getClientOriginalName();
                $archivo->move($path, $fileName);
                $nomb = new CamMiniExpDiplomas;
                $nomb->diplomas = $fileName;
                $nomb->id_mini = $mini->id;
                $nomb->save();
            }
            $nomb->save();
        }

        if ($request->hasFile('nombramientos')) {
            $foto = $request->file('nombramientos');
            foreach ($foto as $archivo) {
                $path = $ruta_recursos;
                $fileName = uniqid() . $archivo->getClientOriginalName();
                $archivo->move($path, $fileName);
                $nomb = new CamNombramiento;
                $nomb->nombre = $fileName;
                $nomb->id_mini_exp = $mini->id;
                $nomb->id_cliente = $mini->id_cliente;
                $nomb->save();
            }
            $nomb->save();
        }

        if ($request->hasFile('certificados')) {
            $foto = $request->file('certificados');
            foreach ($foto as $archivo) {
                $path = $ruta_recursos;
                $fileName = uniqid() . $archivo->getClientOriginalName();
                $archivo->move($path, $fileName);
                $nomb = new CamCertificados;
                $nomb->nombre = $fileName;
                $nomb->id_mini_exp = $mini->id;
                $nomb->id_cliente = $mini->id_cliente;
                $nomb->save();
            }
            $nomb->save();
        }

        return redirect()->back()->with('success', 'Archivo subido exitosamente');
    }

    public function crear_docexp(Request $request){
        $dominio = $request->getHost();



            if($request->get('categoria') == 'cedula'){
                if($dominio == 'plataforma.imnasmexico.com'){
                    $ruta_recursos = base_path('../public_html/plataforma.imnasmexico.com/cam_doc_exp/');
                }else{
                    $ruta_recursos = public_path() . '/cam_doc_general/';
                }
                $id_nota = $request->get('id_nota');
                $id_cliente = $request->get('id_cliente');
                $tipo = $request->get('categoria');
                if ($request->hasFile('archivos')) {
                    $foto = $request->file('archivos');
                    foreach ($foto as $archivo) {
                        $path = $ruta_recursos;
                        $fileName = uniqid() . $archivo->getClientOriginalName();
                        $archivo->move($path, $fileName);
                        $nomb = new CamCedulas;
                        $nomb->nombre = $fileName;
                        $nomb->id_nota = $id_nota;
                        $nomb->id_cliente = $id_cliente;
                        $nomb->save();
                    }
                }
            }else{

                if($dominio == 'plataforma.imnasmexico.com'){
                    $ruta_recursos = base_path('../public_html/plataforma.imnasmexico.com/cam_doc_exp/');
                }else{
                    $ruta_recursos = public_path() . '/cam_doc_exp/';
                }
                $id_nota = $request->get('id_nota');
                $id_cliente = $request->get('id_cliente');
                $tipo = $request->get('categoria');
                if ($request->hasFile('archivos')) {
                    $foto = $request->file('archivos');
                    foreach ($foto as $archivo) {
                        $path = $ruta_recursos;
                        $fileName = uniqid() . $archivo->getClientOriginalName();
                        $archivo->move($path, $fileName);
                        $nomb = new CamDocExp;
                        $nomb->nombre = $fileName;
                        $nomb->tipo = $tipo;
                        $nomb->id_nota = $id_nota;
                        $nomb->id_cliente = $id_cliente;
                        $nomb->id_usuario = auth()->user()->id;
                        $nomb->save();
                    }
                }
            }


        return redirect()->back()->with('success', 'Archivo subido exitosamente');
    }

    public function mostrarArchivosSubidos(Request $request){
        $categoria = $request->input('categoria');

        // Recupera archivos según la categoría y el tipo deseado
        $archivos = CamDocExp::where('tipo', $categoria)
            ->where('tipo', $categoria)->get();
        return response()->json($archivos);
    }
}
