<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Tipodocumentos;


class TipodocumentosController extends Controller
{
    public function index(Request $request)
    {
        $tipo_documento = Tipodocumentos::get();

        return view('admin.tipo_documentos.index',compact('tipo_documento'));
    }


    public function store(Request $request)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/tipos_documentos');
        }else{
            $ruta_manual = public_path() . '/tipos_documentos';
        }

        $tipo_documento = new Tipodocumentos;
        $tipo_documento->tipo = $request->get('tipo');
        $tipo_documento->nombre = $request->get('nombre');

        if ($request->hasFile("img_portada")) {
            $file = $request->file('img_portada');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->img_portada = $fileName;
        }

        if ($request->hasFile("img_reverso")) {
            $file = $request->file('img_reverso');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->img_reverso = $fileName;
        }

        $tipo_documento->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {

        $dominio = $request->getHost();


        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/tipos_documentos');
        }else{
            $ruta_manual = public_path() . '/tipos_documentos';
        }

        $tipo_documento = Tipodocumentos::find($id);
        $tipo_documento->tipo = $request->get('tipo');
        $tipo_documento->nombre = $request->get('nombre');

        $tipo_documento->leyenda1_cp = $request->get('leyenda1_cp');
        $tipo_documento->fecha_expedicion_cp = $request->get('fecha_expedicion_cp');
        $tipo_documento->leyenda2_cp = $request->get('leyenda2_cp');
        $tipo_documento->tipo_vigencia_cp = $request->get('tipo_vigencia_cp');
        $tipo_documento->tipo_vigencia_abrev_cp = $request->get('tipo_vigencia_abrev_cp');
        $tipo_documento->aviso_privacidad_cp = $request->get('aviso_privacidad_cp');
        $tipo_documento->aviso_privacidad_cp2 = $request->get('aviso_privacidad_cp2');

        $tipo_documento->leyenda_auth_qr_cp = $request->get('leyenda_auth_qr_cp');

        if ($request->hasFile("logo_cp")) {
            $file = $request->file('logo_cp');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->logo_cp = $fileName;
        }

        if ($request->hasFile("logo_otra_institucion_cp")) {
            $file = $request->file('logo_otra_institucion_cp');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->logo_otra_institucion_cp = $fileName;
        }

        if ($request->hasFile("firma1_cp")) {
            $file = $request->file('firma1_cp');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->firma1_cp = $fileName;
        }

        if ($request->hasFile("firma2_cp")) {
            $file = $request->file('firma2_cp');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->firma2_cp = $fileName;
        }

        if ($request->hasFile("firma3_cp")) {
            $file = $request->file('firma3_cp');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->firma3_cp = $fileName;
        }

        if ($request->hasFile("img_izq_cp")) {
            $file = $request->file('img_izq_cp');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->img_izq_cp = $fileName;
        }

        if ($request->hasFile("img_der_cp")) {
            $file = $request->file('img_der_cp');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->img_der_cp = $fileName;
        }

        if ($request->hasFile("fondo_cp")) {
            $file = $request->file('fondo_cp');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->fondo_cp = $fileName;
        }

        if ($request->hasFile("qr_cp")) {
            $file = $request->file('qr_cp');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->qr_cp = $fileName;
        }

        // =============== T E R M I N A  C E D U L A  D E  P A P E L ===============================

        $tipo_documento->titulo_dip = $request->get('titulo_dip');
        $tipo_documento->subtitulo_dip = $request->get('subtitulo_dip');
        $tipo_documento->leyenda1_dip = $request->get('leyenda1_dip');
        $tipo_documento->otorga_dip = $request->get('otorga_dip');
        $tipo_documento->nombramiento_dip = $request->get('nombramiento_dip');
        $tipo_documento->leyenda2_dip = $request->get('leyenda2_dip');
        $tipo_documento->horas_dip = $request->get('horas_dip');
        $tipo_documento->leyenda_footer1_dip = $request->get('leyenda_footer1_dip');
        $tipo_documento->titulo_hoja2_dip = $request->get('titulo_hoja2_dip');
        $tipo_documento->subtitulo_hoja2_dip = $request->get('subtitulo_hoja2_dip');
        $tipo_documento->aviso_priv_hoja2_dip = $request->get('aviso_priv_hoja2_dip');
        $tipo_documento->leyenda3_hoja2_dip = $request->get('leyenda3_hoja2_dip');
        $tipo_documento->leyenda_footer_uno_dip = $request->get('leyenda_footer_uno_dip');
        $tipo_documento->leyenda_footer_dos_dip = $request->get('leyenda_footer_dos_dip');

        if ($request->hasFile("logo_registro_dip")) {
            $file = $request->file('logo_registro_dip');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->logo_registro_dip = $fileName;
        }

        if ($request->hasFile("logo_otra_institucion_dip")) {
            $file = $request->file('logo_otra_institucion_dip');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->logo_otra_institucion_dip = $fileName;
        }

        if ($request->hasFile("logo_imnas_dip")) {
            $file = $request->file('logo_imnas_dip');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->logo_imnas_dip = $fileName;
        }

        if ($request->hasFile("firma1_dip")) {
            $file = $request->file('firma1_dip');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->firma1_dip = $fileName;
        }

        if ($request->hasFile("firma2_dip")) {
            $file = $request->file('firma2_dip');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->firma2_dip = $fileName;
        }

        if ($request->hasFile("sello_constancia_hoja2_dip")) {
            $file = $request->file('sello_constancia_hoja2_dip');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->sello_constancia_hoja2_dip = $fileName;
        }

        if ($request->hasFile("sello_reristro_hoja2_dip")) {
            $file = $request->file('sello_reristro_hoja2_dip');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->sello_reristro_hoja2_dip = $fileName;
        }

        if ($request->hasFile("tira_imagenes_hoja2_dip")) {
            $file = $request->file('tira_imagenes_hoja2_dip');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->tira_imagenes_hoja2_dip = $fileName;
        }

        if ($request->hasFile("fondo_dip")) {
            $file = $request->file('fondo_dip');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->fondo_dip = $fileName;
        }
        // =============== T E R M I N A  D I P L O M A ===============================

        $tipo_documento->titulo1_credencial = $request->get('titulo1_credencial');
        $tipo_documento->folio_credencial = $request->get('folio_credencial');
        $tipo_documento->vigencia_credencial = $request->get('vigencia_credencial');
        $tipo_documento->tipo_credencial = $request->get('tipo_credencial');
        $tipo_documento->nacionalidad_credencial = $request->get('nacionalidad_credencial');
        $tipo_documento->leyenda_qr_credencial = $request->get('leyenda_qr_credencial');
        $tipo_documento->leyenda1_hoja_credencial = $request->get('leyenda1_hoja_credencial');
        $tipo_documento->leyenda2_hoja_credencial = $request->get('leyenda2_hoja_credencial');
        $tipo_documento->leyenda3_hoja_credencial = $request->get('leyenda3_hoja_credencial');
        $tipo_documento->leyenda4_hoja_credencial = $request->get('leyenda4_hoja_credencial');

        if ($request->hasFile("logo_registro_credencial")) {
            $file = $request->file('logo_registro_credencial');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->logo_registro_credencial = $fileName;
        }

        if ($request->hasFile("logo_otra_institucion_credencial")) {
            $file = $request->file('logo_otra_institucion_credencial');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->logo_otra_institucion_credencial = $fileName;
        }

        if ($request->hasFile("qr_credencial")) {
            $file = $request->file('qr_credencial');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->qr_credencial = $fileName;
        }

        if ($request->hasFile("firma_credencial")) {
            $file = $request->file('firma_credencial');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->firma_credencial = $fileName;
        }

        if ($request->hasFile("fonda_credencial")) {
            $file = $request->file('fonda_credencial');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->fonda_credencial = $fileName;
        }
        // =============== T E R M I N A  C R E D E N C I A L ===============================

        $tipo_documento->titulo_titulo = $request->get('titulo_titulo');
        $tipo_documento->subtitulo_titulo = $request->get('subtitulo_titulo');
        $tipo_documento->subsubtitulo_titulo = $request->get('subsubtitulo_titulo');
        $tipo_documento->leyenda1_titulo = $request->get('leyenda1_titulo');
        $tipo_documento->leyenda_qr_titulo = $request->get('leyenda_qr_titulo');
        $tipo_documento->tipo_vigencia_abrev_titulo = $request->get('tipo_vigencia_abrev_titulo');
        $tipo_documento->leyenda1_hoja2_titulo = $request->get('leyenda1_hoja2_titulo');
        $tipo_documento->leyenda2_hoja2_titulo = $request->get('leyenda2_hoja2_titulo');
        $tipo_documento->leyenda3_hoja2_titulo = $request->get('leyenda3_hoja2_titulo');
        $tipo_documento->leyenda4_hoja2_titulo = $request->get('leyenda4_hoja2_titulo');
        $tipo_documento->leyenda5_hoja2_titulo = $request->get('leyenda5_hoja2_titulo');
        $tipo_documento->leyenda6_hoja2_titulo = $request->get('leyenda6_hoja2_titulo');

        if ($request->hasFile("logo_registro_titulo")) {
            $file = $request->file('logo_registro_titulo');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->logo_registro_titulo = $fileName;
        }

        if ($request->hasFile("logo_otra_institucion_titulo")) {
            $file = $request->file('logo_otra_institucion_titulo');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->logo_otra_institucion_titulo = $fileName;
        }

        if ($request->hasFile("firma1_titulo")) {
            $file = $request->file('firma1_titulo');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->firma1_titulo = $fileName;
        }

        if ($request->hasFile("firma2_titulo")) {
            $file = $request->file('firma2_titulo');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->firma2_titulo = $fileName;
        }

        if ($request->hasFile("firma3_titulo")) {
            $file = $request->file('firma3_titulo');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->firma3_titulo = $fileName;
        }

        if ($request->hasFile("qr_credencial_titulo")) {
            $file = $request->file('qr_credencial_titulo');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->qr_credencial_titulo = $fileName;
        }

        if ($request->hasFile("tira_imagenes_hoja2_titulo")) {
            $file = $request->file('tira_imagenes_hoja2_titulo');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->tira_imagenes_hoja2_titulo = $fileName;
        }

        if ($request->hasFile("sello_realimg_")) {
            $file = $request->file('sello_realimg_');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->sello_realimg_ = $fileName;
        }

        if ($request->hasFile("firma1_hoja2_titulo")) {
            $file = $request->file('firma1_hoja2_titulo');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->firma1_hoja2_titulo = $fileName;
        }
        // =============== T E R M I N A  T I T U L O ===============================

        $tipo_documento->titulo1_tm = $request->get('titulo1_tm');
        $tipo_documento->leyenda1_tm = $request->get('leyenda1_tm');
        $tipo_documento->leyenda2_tm = $request->get('leyenda2_tm');
        $tipo_documento->leyenda3_tm = $request->get('leyenda3_tm');
        $tipo_documento->leyenda4_tm = $request->get('leyenda4_tm');
        $tipo_documento->leyenda5_tm = $request->get('leyenda5_tm');
        $tipo_documento->optativos_tm = $request->get('optativos_tm');
        $tipo_documento->totales_tm = $request->get('totales_tm');
        $tipo_documento->materias_aprov_tm = $request->get('materias_aprov_tm');
        $tipo_documento->promedio_tm = $request->get('promedio_tm');
        $tipo_documento->fecha_expedicion_tm = $request->get('fecha_expedicion_tm');
        $tipo_documento->tira_materias_aparatologia_tm = $request->get('tira_materias_aparatologia_tm');
        $tipo_documento->tira_materias_alasiados_tm = $request->get('tira_materias_alasiados_tm');
        $tipo_documento->tira_materias_cosmetologia_tm = $request->get('tira_materias_cosmetologia_tm');
        $tipo_documento->tira_materias_cosmeatria_tm = $request->get('tira_materias_cosmeatria_tm');
        $tipo_documento->tira_materias_auxiliar_tm = $request->get('tira_materias_auxiliar_tm');
        $tipo_documento->tira_materias_masoterapia_tm = $request->get('tira_materias_masoterapia_tm');
        $tipo_documento->tira_materias_cosmetologia_fc_tm = $request->get('tira_materias_cosmetologia_fc_tm');
        $tipo_documento->leyenda_footer_hoja1_tm = $request->get('leyenda_footer_hoja1_tm');
        $tipo_documento->leyenda1_hoja2_tm = $request->get('leyenda1_hoja2_tm');
        $tipo_documento->leyenda2_hoja2_tm = $request->get('leyenda2_hoja2_tm');
        $tipo_documento->leyenda3_hoja2_tm = $request->get('leyenda3_hoja2_tm');
        $tipo_documento->leyenda4_hoja2_tm = $request->get('leyenda4_hoja2_tm');
        $tipo_documento->leyenda5_hoja2_tm = $request->get('leyenda5_hoja2_tm');
        $tipo_documento->leyenda6_hoja2_tm = $request->get('leyenda6_hoja2_tm');
        $tipo_documento->leyenda_qr_credencial_tm = $request->get('leyenda_qr_credencial_tm');
        $tipo_documento->tipo_vigencia_abrev_tm = $request->get('tipo_vigencia_abrev_tm');
        $tipo_documento->leyenda_footer_hoja2_tm = $request->get('leyenda_footer_hoja2_tm');

        if ($request->hasFile("logo_tm")) {
            $file = $request->file('logo_tm');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->logo_tm = $fileName;
        }

        if ($request->hasFile("logo_otra_institucion_tm")) {
            $file = $request->file('logo_otra_institucion_tm');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->logo_otra_institucion_tm = $fileName;
        }

        if ($request->hasFile("qr_credencial_tm")) {
            $file = $request->file('qr_credencial_tm');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->qr_credencial_tm = $fileName;
        }

        if ($request->hasFile("firma1_hoja2_tm")) {
            $file = $request->file('firma1_hoja2_tm');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->firma1_hoja2_tm = $fileName;
        }

        if ($request->hasFile("firma2_hoja2_tm")) {
            $file = $request->file('firma2_hoja2_tm');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->firma2_hoja2_tm = $fileName;
        }

        if ($request->hasFile("firma3_hoja2_tm")) {
            $file = $request->file('firma3_hoja2_tm');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->firma3_hoja2_tm = $fileName;
        }

        if ($request->hasFile("img_izq_tm")) {
            $file = $request->file('img_izq_tm');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->img_izq_tm = $fileName;
        }

        if ($request->hasFile("img_der_tm")) {
            $file = $request->file('img_der_tm');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->img_der_tm = $fileName;
        }
        // =============== T E R M I N A  T I R A  D E  M A T E R I A S ===============================

        if ($request->hasFile("img_portada")) {
            $file = $request->file('img_portada');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->img_portada = $fileName;
        }

        if ($request->hasFile("img_reverso")) {
            $file = $request->file('img_reverso');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->img_reverso = $fileName;
        }

        $tipo_documento->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back();

    }}
