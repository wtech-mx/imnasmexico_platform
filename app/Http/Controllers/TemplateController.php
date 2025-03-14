<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTemplateRequest;
use App\Http\Requests\SendTemplateRequest;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::all();
        return view('whatsapp.templates', compact('templates'));
    }

    public function store(StoreTemplateRequest $request)
    {
        $template = Template::create($request->validated());

        return response()->json([
            'message' => 'Template created successfully',
            'template' => $template,
        ], 201);
    }

    public function sendTemplate(SendTemplateRequest $request)
    {
        $template = Template::find($request->template_id);
        // Logic to send the template goes here

        return response()->json(['message' => 'Template sent successfully']);
    }

    public function showTemplate()
    {
        return view('whatsapp.template');
    }

    public function createTemplate()
    {
        return view('whatsapp.create');
    }

    public function detailTemplate()
    {
        return view('whatsapp.detail');
    }

    public function indexTemplate()
    {
        return view('whatsapp.index');
    }

    public function updateTemplate()
    {
        return view('whatsapp.update');
    }
}
