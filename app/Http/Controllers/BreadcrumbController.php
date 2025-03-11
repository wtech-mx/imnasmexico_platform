<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BreadcrumbController extends Controller
{
    public function showBreadcrumb()
    {
        return view('ajax.breadcrumb');
    }
}
