<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Cosmikausers;
use App\Models\Bitacora_cosmikausers;
use App\Models\Productosregaloscosmika;

use Illuminate\Support\Str;
use Session;
use Hash;
use DB;
use Carbon\Carbon;


class CosmicaDistribuidoraController extends Controller
{
    public function index(){

        return view('cosmica.distribuidoras.index');
    }
}
