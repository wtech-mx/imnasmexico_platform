<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendTemplateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'template' => 'required|exists:templates,id',
            'waba_phone' => 'required|exists:waba_phones,id',
            'to' => 'required|string',
            'vars' => 'nullable|array',
        ];
    }
}
