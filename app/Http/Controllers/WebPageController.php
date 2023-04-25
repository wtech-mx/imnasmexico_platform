<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebPage;

class WebPageController extends Controller
{
    public function index(Request $request)
    {
        $webpage = WebPage::get();
        return view('admin.webpage.index', compact('webpage'));
    }
}
