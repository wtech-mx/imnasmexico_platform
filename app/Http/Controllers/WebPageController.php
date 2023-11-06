<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\WebPage;
use App\Models\Estandar;
use App\Models\Revoes;
use App\Models\Comentarios;
use App\Models\User;
use App\Models\Votos;
use App\Models\Cursos;
use App\Models\CursosTickets;
use App\Models\Noticias;


class WebPageController extends Controller
{
    public function index(Request $request)
    {
        // $webpage = WebPage::get();
        // return view('admin.webpage.index', compact('webpage'));
    }

    public function instalaciones(Request $request){
        $webpage = WebPage::first();

        return view('user.instalaciones', compact('webpage'));
    }

    public function nosotros(Request $request){
        $webpage = WebPage::first();
        $concursantes = Votos::get();

        return view('user.nosotros', compact('webpage', 'concursantes'));
    }

    public function reality(Request $request){
        $webpage = WebPage::first();
        $concursantes = Votos::get();

        return view('user.reality', compact('webpage', 'concursantes'));
    }

    public function videos(Request $request){

        $DateAndTime = date('h:i', time());
        $fechaActual = date('Y-m-d');
        $cursos = Cursos::where('estatus','=', '1')->orderBy('fecha_inicial','asc')->get();
        $cursos_slide = Cursos::where('estatus','=', '1')->orderBy('fecha_inicial','asc')->get();

        $tickets = CursosTickets::where('fecha_inicial','<=', $fechaActual)->where('fecha_final','>=', $fechaActual)->get();

        $titulo = 'Calendario General Online y Presencial';

        $webpage = WebPage::first();

        $noticias_producto = Noticias::where('seccion','=', 'Videos_Productos')->get();
        $noticias_alumnas = Noticias::where('seccion','=', 'Videos_Alumnas')->get();

        return view('user.videos', compact('cursos', 'tickets', 'cursos_slide', 'fechaActual', 'titulo','noticias_producto','noticias_alumnas'));

    }

    public function avales(Request $request){
        $webpage = WebPage::first();

        return view('user.avales', compact('webpage'));
    }

    public function realitystore(Request $request){

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_webpage = base_path('../public_html/plataforma.imnasmexico.com/reality');
        }else{
            $ruta_webpage = public_path() . '/reality';
        }

        $reality = new Votos;
        $reality->nombre = $request->get('nombre');
        $reality->facebook = $request->get('facebook');
        $reality->instagram = $request->get('instagram');
        $reality->tiktok = $request->get('tiktok');
        $reality->estatus = $request->get('estatus');

        if ($request->hasFile("foto_perfil")) {
            $file = $request->file('foto_perfil');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $reality->foto_perfil = $fileName;
        }

        $reality->save();
        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Webpage actualizada');
    }

    public function realityupdate(Request $request, $id){

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_webpage = base_path('../public_html/plataforma.imnasmexico.com/reality');
        }else{
            $ruta_webpage = public_path() . '/reality';
        }

        $reality = Votos::find($id);
        $reality->nombre = $request->get('nombre');
        $reality->facebook = $request->get('facebook');
        $reality->instagram = $request->get('instagram');
        $reality->tiktok = $request->get('tiktok');
        $reality->estatus = $request->get('estatus');

        if ($request->hasFile("foto_perfil")) {
            $file = $request->file('foto_perfil');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $reality->foto_perfil = $fileName;
        }

        $reality->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Webpage actualizada');
    }

    public function edit($id)
    {

        $revoes = Revoes::orderBy('id','DESC')->get();
        $estandares = Estandar::orderBy('id','DESC')->get();
        $webpage = WebPage::find($id);
        $comentarios = Comentarios::orderBy('id','DESC')->get();
        $votos = Votos::get();

        return view('admin.webpage.index', compact('webpage','revoes','estandares','comentarios','votos'));
    }

    public function update(Request $request, $id){

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_webpage = base_path('../public_html/plataforma.imnasmexico.com/webpage');
        }else{
            $ruta_webpage = public_path() . '/webpage';
        }

        $webpage = WebPage::find($id);
        $webpage->stone_home_tittle = $request->get('stone_home_tittle');
        $webpage->stone_home_text = $request->get('stone_home_text');
        $webpage->stfive_home_tittle = $request->get('stfive_home_tittle');
        $webpage->stfive_home_text = $request->get('stfive_home_text');
        $webpage->stone_nosotros_tittle = $request->get('stone_nosotros_tittle');
        $webpage->stone_nosotros_text = $request->get('stone_nosotros_text');
        $webpage->stone_instalaciones_tittle = $request->get('stone_instalaciones_tittle');
        $webpage->stone_instalaciones_text = $request->get('stone_instalaciones_text');
        $webpage->wb_all_pixel = $request->get('wb_all_pixel');
        $webpage->wb_all_analitics = $request->get('wb_all_analitics');
        $webpage->email_admin = $request->get('email_admin');
        $webpage->email_developer = $request->get('email_developer');
        $webpage->email_admin_two = $request->get('email_admin_two');
        $webpage->email_developer_two = $request->get('email_developer_two');
        $webpage->btn_votar = $request->get('btn_votar');

        if ($request->hasFile("stone_home_bg")) {
            $file = $request->file('stone_home_bg');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $webpage->stone_home_bg = $fileName;
        }

        if ($request->hasFile("stpaquetesone_image")) {
            $file = $request->file('stpaquetesone_image');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $webpage->stpaquetesone_image = $fileName;
        }

        if ($request->hasFile("stpaquetestwo_image")) {
            $file = $request->file('stpaquetestwo_image');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $webpage->stpaquetestwo_image = $fileName;
        }

        if ($request->hasFile("stpaquetesthree_image")) {
            $file = $request->file('stpaquetesthree_image');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $webpage->stpaquetesthree_image = $fileName;
        }

        if ($request->hasFile("stpaquetesfour_image")) {
            $file = $request->file('stpaquetesfour_image');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $webpage->stpaquetesfour_image = $fileName;
        }

        if ($request->hasFile("stpaquetesfive_image")) {
            $file = $request->file('stpaquetesfive_image');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $webpage->stpaquetesfive_image = $fileName;
        }

        if ($request->hasFile("stavalesunam_image")) {
            $file = $request->file('stavalesunam_image');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $webpage->stavalesunam_image = $fileName;
        }

        if ($request->hasFile("stavalesconocer_image")) {
            $file = $request->file('stavalesconocer_image');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $webpage->stavalesconocer_image = $fileName;
        }

        if ($request->hasFile("stavalesrevoe_image")) {
            $file = $request->file('stavalesrevoe_image');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $webpage->stavalesrevoe_image = $fileName;
        }

        if ($request->hasFile("stavalesstps_image")) {
            $file = $request->file('stavalesstps_image');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $webpage->stavalesstps_image = $fileName;
        }

        if ($request->hasFile("stavalesregistro_one_image")) {
            $file = $request->file('stavalesregistro_one_image');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $webpage->stavalesregistro_one_image = $fileName;
        }

        if ($request->hasFile("stavalesregistro_two_image")) {
            $file = $request->file('stavalesregistro_two_image');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $webpage->stavalesregistro_two_image = $fileName;
        }

        if ($request->hasFile("stavalesregistro_three_image")) {
            $file = $request->file('stavalesregistro_three_image');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $webpage->stavalesregistro_three_image = $fileName;
        }

        if ($request->hasFile("stavalesregistro_four_image")) {
            $file = $request->file('stavalesregistro_four_image');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $webpage->stavalesregistro_four_image = $fileName;
        }

        if ($request->hasFile("stavalesregistro_five_image")) {
            $file = $request->file('stavalesregistro_five_image');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $webpage->stavalesregistro_five_image = $fileName;
        }

        if ($request->hasFile("stone_nosotros_bg")) {
            $file = $request->file('stone_nosotros_bg');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $webpage->stone_nosotros_bg = $fileName;
        }

        if ($request->hasFile("stone_instalaciones_bg")) {
            $file = $request->file('stone_instalaciones_bg');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $webpage->stone_instalaciones_bg = $fileName;
        }

        if ($request->hasFile("parallax")) {
            $file = $request->file('parallax');
            $path = $ruta_webpage;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $webpage->parallax = $fileName;
        }

        $webpage->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Webpage actualizada');
    }

}
