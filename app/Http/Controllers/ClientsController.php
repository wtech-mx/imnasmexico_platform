<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        $cliente = User::find(auth()->user()->id);

        return view('user.profile',compact('cliente'));
    }
}
