<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() != null;
    }

    public function rules()
    {
        return [
            'date' => ['nullable','date'],
            'items' => ['required','array','min:1'],
            'items.*.medicine_id' => ['required','exists:medicines,id'],
            'items.*.quantity' => ['required','integer','min:1'],
            'items.*.price' => ['required','numeric','min:0'],
            'payment' => ['nullable','numeric','min:0'],
        ];
    }
}
