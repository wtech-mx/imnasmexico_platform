<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTemplateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'status' => 'required|string',
            'category' => 'required|string',
            'language' => 'required|string',
            'type' => 'required|string|in:GENERIC',
            'template_id' => 'required|string',
            'content' => 'required|json',
        ];
    }
}
