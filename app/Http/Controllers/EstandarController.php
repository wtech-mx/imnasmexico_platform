<?php

namespace App\Http\Controllers;
use App\Models\Estandar;
use Illuminate\Http\Request;
use Session;

class EstandarController extends Controller
{
    public function index(Request $request)
    {
        $estandares = Estandar::orderBy('id','DESC')->get();

        return view('admin.webpage.estandares', compact('estandares'));
    }
    public function store(Request $request)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_estandar = base_path('../public_html/plataforma.imnasmexico.com/estandares');
        }else{
            $ruta_estandar = public_path() . '/estandares';
        }

        $estandar = new Estandar;
        $estandar->name = $request->get('name');
        $estandar->num_estandar = $request->get('num_estandar');

        if ($request->hasFile("image")) {
            $file = $request->file('image');
            $path = $ruta_estandar;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $estandar->image = $fileName;
        }


        $estandar->save();
        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');
    }

    public function update(Request $request, $id)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_estandar = base_path('../public_html/plataforma.imnasmexico.com/estandares');
        }else{
            $ruta_estandar = public_path() . '/estandares';
        }

        $estandar = Estandar::find($id);
        $estandar->name = $request->get('name');
        $estandar->num_estandar = $request->get('num_estandar');

        if ($request->hasFile("image")) {
            $file = $request->file('image');
            $path = $ruta_estandar;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $estandar->image = $fileName;
        }

        $estandar->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');
    }

}
