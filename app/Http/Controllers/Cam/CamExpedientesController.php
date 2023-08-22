<?php

namespace App\Http\Controllers\Cam;

use App\Http\Controllers\Controller;
use App\Models\Cam\CamChecklist;
use App\Models\Cam\CamCitas;
use App\Models\Cam\CamDocumentosUsers;
use App\Models\Cam\CamNotEstandares;
use Illuminate\Http\Request;

class CamExpedientesController extends Controller
{

    public function index_ind(){

        $expedientes = CamCitas::get();
        return view('cam.admin.expedientes.index', compact('expedientes'));
    }

    public function edit($id_nota){
        $expediente = CamCitas::where('id_nota', $id_nota)->first();
        $documentos = CamDocumentosUsers::where('id_nota', $id_nota)->firstOrFail();
        $check = CamChecklist::where('id_nota', $id_nota)->firstOrFail();
        $estandares_usuario = CamNotEstandares::where('id_nota', $id_nota)->get();

        return view('cam.admin.expedientes.exp_ind', compact('expediente', 'estandares_usuario', 'documentos', 'check'));
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

        return redirect()->back()->with('success', 'curso actualizado con exito.');
    }

    public function update_check(Request $request, $id){
        $dominio = $request->getHost();

        $doc = CamDocumentosUsers::where('id_nota', $id)->first();

        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_recursos = base_path('../public_html/plataforma.imnasmexico.com/cam/doc' . $doc->Nota->Cliente->telefono);
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

        return redirect()->back()->with('success', 'curso actualizado con exito.');
    }
}
