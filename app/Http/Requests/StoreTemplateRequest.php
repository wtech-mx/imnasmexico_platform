<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'template_id' => 'required|exists:templates,id',
            'waba_phone_id' => 'required|exists:waba_phones,id',
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ];
    }
}
