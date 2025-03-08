<?php

namespace App\Http\Controllers;

use App\Models\DocumenotsGenerador;
use App\Models\OrdersTickets;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\Tipodocumentos;
use App\Models\RegistroImnas;
use App\Models\RegistroImnasEscuela;
use App\Models\RegistroImnasEspecialidad;
use App\Models\RegistroImnasTemario;
use App\Models\User;

class FoliosController extends Controller
{
    public function index(){

        $registros_imnas = Orders::where('registro_imnas', '=', '1')->Orderby('id','ASC')->get();
        return view('cam.auth.login',compact('registros_imnas'));
    }

    public function index_registro(){

        $registros_imnas = Orders::where('registro_imnas', '=', '1')->Orderby('id','ASC')->get();
        return view('user.registro.inicio',compact('registros_imnas'));
    }

    public function index_nosotros(){

        $registros_imnas = Orders::where('registro_imnas', '=', '1')->Orderby('id','ASC')->get();
        return view('user.registro.nosotros',compact('registros_imnas'));
    }

    public function index_afiliados(){

        $registros_imnas = Orders::where('registro_imnas', '=', '1')->Orderby('id','ASC')->get();
        return view('user.registro.afiliados',compact('registros_imnas'));
    }

    public function index_afiliate(){

        $registros_imnas = Orders::where('registro_imnas', '=', '1')->Orderby('id','ASC')->get();
        return view('user.registro.afiliate',compact('registros_imnas'));
    }

    public function buscador(Request $request){

        $folio = $request->get('folio');

            if($folio == 'EFDFGVOA-16620'){

                $folio = 'EFDFOAGV-16620';

            }else if($folio == 'EFDFMRHA-16264'){
                $folio = 'EFDFHAMR-16264';

            }else if($folio == 'EDPEAARD-16689'){
                $folio = 'EDPERDAA-16689';

            }else if($folio == 'EDPEBAG-16619'){
                $folio = 'EDPEGBA-16619';
            }else if($folio == 'MPMCD-16697'){
                $folio = 'MCDPM-16697';
            }else if($folio == 'MSPMI-16697'){
                $folio = 'MMISP-16697';
            }else if($folio == 'MCRM-16697'){
                $folio = 'MMCR-16697';
            }


        $tickets = OrdersTickets::where('folio', '=', $folio)->first();

            if (!$tickets) {

                $tickets_generador = RegistroImnas::where('folio', $folio)->first();

                // Si tampoco se encuentra en RegistroImnas, busca en DocumentosGenerador
                if (!$tickets_generador) {
                    $tickets_externo = DocumenotsGenerador::where('folio', $folio)->first();
                }else{
                    $tickets_externo = '';
                }

            }else{
                $tickets_generador = '';
                $tickets_externo = '';

            }

            $registros_imnas = Orders::where('registro_imnas', '=', '1')->get();


        return view('user.folio',compact('tickets', 'folio', 'tickets_generador','tickets_externo','registros_imnas'));

    }

    public function buscador_registro(Request $request){
        $tickets = OrdersTickets::where('folio', '=', $request->get('folio'))->first();

            if (!$tickets) {

                $tickets_generador = RegistroImnas::where('folio', $request->get('folio'))->first();

                // Si tampoco se encuentra en RegistroImnas, busca en DocumentosGenerador
                if (!$tickets_generador) {
                    $tickets_externo = DocumenotsGenerador::where('folio', $request->get('folio'))->first();
                }else{
                    $tickets_externo = '';
                }

            }else{
                $tickets_generador = '';
                $tickets_externo = '';

            }

        $folio = $request->get('folio');
        $registros_imnas = Orders::where('registro_imnas', '=', '1')->get();

        return view('admin.registro_imnas.resultado_registro',compact('tickets', 'folio', 'tickets_generador','tickets_externo','registros_imnas'));
    }

    public function update_docDigital(Request $request, $id){

        $registroimnas = RegistroImnas::where('id', $id)->first();
        $registroimnas->tam_letra_especialidad_th = $request->get('tam_letra_especialidad_th');
        $registroimnas->tam_letra_credencial_especialidad = $request->get('tam_letra_credencial_especialidad');
        $registroimnas->tam_letra_nombre_th = $request->get('tam_letra_nombre_th');
        $registroimnas->tam_letra_folio_th = $request->get('tam_letra_folio_th');
        $registroimnas->tam_letra_especialidad_cedula = $request->get('tam_letra_especialidad_cedula');
        $registroimnas->tam_letra_folio_cedula = $request->get('tam_letra_folio_cedula');
        $registroimnas->tam_letra_folioTrasero_cedula = $request->get('tam_letra_folioTrasero_cedula');
        $registroimnas->tam_letra_lista_tira_materias = $request->get('tam_letra_lista_tira_materias');
        $registroimnas->texto_firma_personalizada = $request->get('texto_firma_personalizada');
        $registroimnas->texto_firma_personalizada2 = $request->get('texto_firma_personalizada2');
        $registroimnas->capitalizar_nombre = $request->get('capitalizar_nombre');
        $registroimnas->texto_director = $request->get('texto_director');
        $registroimnas->firma_director = $request->get('firma_director');
        $registroimnas->promedio = $request->get('promedio');
        $registroimnas->curp_escrito = $request->get('curp');
        $registroimnas->fecha_curso = $request->get('fecha');
        $registroimnas->logo_cedula = $request->get('logo_cedula');
        $registroimnas->logo_diploma = $request->get('logo_diploma');
        $registroimnas->logo_titulo = $request->get('logo_titulo');

        $registroimnas->update();

        return redirect()->back()->with('success', 'datos actualizado con exito.');

    }

    public function update_externos(Request $request, $id){

        $dominio = $request->getHost();

        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/utilidades_documentos');
        }else{
            $ruta_manual = public_path() . '/utilidades_documentos';
        }

        // $registroimnas = DocumenotsGenerador::where('id', $id)->first();
        $registroimnas = DocumenotsGenerador::find($id);

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $registroimnas->foto = $fileName;
        }

        $registroimnas->update();

        return redirect()->back()->with('success', 'datos actualizado con exito.');
    }

    public function index_cedula(Request $request, $id){

        $tipo_documentos = Tipodocumentos::find(2);

        $tickets = RegistroImnas::where('folio', $id)->first();

        $tickets_externo = DocumenotsGenerador::where('folio', $id)->first();

        if($tickets == null){

        }else{
            $user = User::where('id', $tickets->id_usuario)->first();
        }

        if($tickets == null){
            $tickets = OrdersTickets::where('id', '=', $id)->first();
        }

        if($tickets_externo != null){
            $tickets_externo = DocumenotsGenerador::where('folio', $id)->first();
        }

        if (!empty($tickets) && $tickets->diseno_doc == 'Nuevo') {
            return view('user.components.documentos_imnas.nuevos.index_cedula', compact('tickets', 'tipo_documentos', 'tickets_externo', 'user'));
        } else {
            return view('user.components.documentos_imnas.index_cedula', compact('tickets', 'tipo_documentos', 'tickets_externo'));
        }

    }

    public function index_titulo(Request $request, $id){

        $tipo_documentos = Tipodocumentos::find(3);

        $tickets = RegistroImnas::where('folio', $id)->first();

        $tickets_externo = DocumenotsGenerador::where('folio', $id)->first();

        if($tickets == null){

        }else{
            $user = User::where('id', $tickets->id_usuario)->first();
        }

        if($tickets == null){
            $tickets = OrdersTickets::where('id', '=', $id)->first();
        }

        if($tickets_externo != null){
            $tickets_externo = DocumenotsGenerador::where('folio', $id)->first();
        }

        if (!empty($tickets) && $tickets->diseno_doc == 'Nuevo') {
            return view('user.components.documentos_imnas.nuevos.index_titulo', compact('tickets', 'tipo_documentos', 'tickets_externo','user'));
        } else {
            return view('user.components.documentos_imnas.index_titulo', compact('tickets', 'tipo_documentos', 'tickets_externo'));
        }

    }

    public function index_diploma(Request $request, $id){

        $tipo_documentos = Tipodocumentos::find(4);

        $tickets = RegistroImnas::where('folio', $id)->first();

        $tickets_externo = DocumenotsGenerador::where('folio', $id)->first();

        if($tickets == null){

        }else{
            $user = User::where('id', $tickets->id_usuario)->first();
        }

        if($tickets == null){
            $tickets = OrdersTickets::where('id', '=', $id)->first();
        }

        if($tickets_externo != null){
            $tickets_externo = DocumenotsGenerador::where('folio', $id)->first();
        }

        if (!empty($tickets) && $tickets->diseno_doc == 'Nuevo') {
            return view('user.components.documentos_imnas.nuevos.index_diploma', compact('tickets', 'tipo_documentos', 'tickets_externo','user'));
        } else {
            return view('user.components.documentos_imnas.index_diploma', compact('tickets', 'tipo_documentos', 'tickets_externo'));
        }

    }

    public function index_crednecial(Request $request, $id){

        $tipo_documentos = Tipodocumentos::find(5);

        $tickets = RegistroImnas::where('folio', $id)->first();

        $tickets_externo = DocumenotsGenerador::where('folio', $id)->first();

        if($tickets == null){

        }else{
            $user = User::where('id', $tickets->id_usuario)->first();
        }

        if($tickets == null){
            $tickets = OrdersTickets::where('id', '=', $id)->first();
        }

        if($tickets_externo != null){
            $tickets_externo = DocumenotsGenerador::where('folio', $id)->first();
        }

        if (!empty($tickets) && $tickets->diseno_doc == 'Nuevo') {
            return view('user.components.documentos_imnas.nuevos.index_crednecial', compact('tickets', 'tipo_documentos', 'tickets_externo','user'));
        } else {
            return view('user.components.documentos_imnas.index_crednecial', compact('tickets', 'tipo_documentos', 'tickets_externo'));
        }

    }

    public function index_tira(Request $request, $id){

        $tipo_documentos = Tipodocumentos::find(18);

        $tickets = RegistroImnas::where('folio', $id)->first();

        $tickets_externo = DocumenotsGenerador::where('folio', $id)->first();

        $user = User::where('id', $tickets->id_usuario)->first();


        if($tickets == null){
            $tickets = OrdersTickets::where('id', '=', $id)->first();
        }

        if($tickets_externo != null){
            $tickets_externo = DocumenotsGenerador::where('folio', $id)->first();
        }

        $idMateria = RegistroImnasEspecialidad::where('especialidad', $tickets->nom_curso)->where('id_cliente', $tickets->id_usuario)->first();

        $subtemas = RegistroImnasTemario::
            where('id_materia', $idMateria->id)
            ->orderBy('id')
            ->get();

            if (!empty($tickets) && $tickets->diseno_doc == 'Nuevo') {
                return view('user.components.documentos_imnas.nuevos.index_tira', compact('subtemas','tickets', 'tipo_documentos', 'tickets_externo','user'));
            } else {
                return view('user.components.documentos_imnas.index_tira', compact('subtemas','tickets', 'tipo_documentos', 'tickets_externo'));
            }

    }

}


