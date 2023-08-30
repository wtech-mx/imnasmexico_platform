<?php

namespace App\Http\Controllers;

use App\Models\Cam\CamVideos;
use Session;

use Illuminate\Http\Request;

class CamVideosController extends Controller
{
    public function index(Request $request)
    {
        $revoes = Revoes::orderBy('id','DESC')->get();

        return view('admin.webpage.revoes', compact('revoes'));
    }

    public function store(Request $request)
    {

        Session::flash('success', 'Se ha guardado sus datos con exito');

        return redirect()->back()->with('success', 'Envio de correo exitoso.');

    }

    public function update(Request $request, $id)
    {

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');

    }}
