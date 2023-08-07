<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Documentos;
class DocumentosController extends Controller
{
    public function index(){

        $documentos = Documentos::get();

        return view('admin.documentos.index',compact('documentos'));
    }

    public function store(){

    }
}
