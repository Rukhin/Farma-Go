<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() != null; // auth middleware should ensure
    }

    public function rules()
    {
        return [
            'supplier_id' => ['nullable','exists:suppliers,id'],
            'date' => ['nullable','date'],
            'items' => ['required','array','min:1'],
            'items.*.medicine_id' => ['required','exists:medicines,id'],
            'items.*.quantity' => ['required','integer','min:1'],
            'items.*.price' => ['required','numeric','min:0'],
        ];
    }
}
