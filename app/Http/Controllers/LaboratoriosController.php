<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaboratoriosController extends Controller
{
    public function index_nas(){



        return view('admin.laboratorio.index_nas');
    }

    public function index_cosmica(){



        return view('admin.laboratorio.index_cosmica');

    }


}
