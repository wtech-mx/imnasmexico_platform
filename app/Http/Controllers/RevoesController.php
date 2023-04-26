<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Revoes;
use Session;

class RevoesController extends Controller
{
    public function index(Request $request)
    {
        $revoes = Revoes::orderBy('id','DESC')->get();
        $estandares = Estandar::orderBy('id','DESC')->get();

        return view('admin.webpage.revoes', compact('revoes'));
    }

    public function store(Request $request)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_revoe = base_path('../public_html/plataforma.imnasmexico.com/revoes');
        }else{
            $ruta_revoe = public_path() . '/revoes';
        }

        $revoe = new Revoes;
        $revoe->name = $request->get('name');
        $revoe->num_revoe = $request->get('num_revoe');

        if ($request->hasFile("image")) {
            $file = $request->file('image');
            $path = $ruta_revoe;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $revoe->image = $fileName;
        }


        $revoe->save();
        Session::flash('success', 'Se ha guardado sus datos con exito');

        return redirect()->back()->with('success', 'Envio de correo exitoso.');

    }

    public function update(Request $request, $id)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_revoe = base_path('../public_html/plataforma.imnasmexico.com/revoes');
        }else{
            $ruta_revoe = public_path() . '/revoes';
        }

        $revoe = Revoes::find($id);
        $revoe->name = $request->get('name');
        $revoe->num_revoe = $request->get('num_revoe');

        if ($request->hasFile("image")) {
            $file = $request->file('image');
            $path = $ruta_revoe;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $revoe->image = $fileName;
        }

        $revoe->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');

    }

}
