<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $medicineId = $this->route('medicine')->id;

        return [
            'code' => 'required|string|unique:medicines,code,' . $medicineId . '|max:50',
            'name' => 'required|string|max:255',
            'medicine_category_id' => 'required|exists:medicine_categories,id',
            'unit' => 'required|string|max:50',
            'price_purchase' => 'required|numeric|min:0',
            'price_sale' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Kode obat harus diisi',
            'code.unique' => 'Kode obat sudah terdaftar',
            'name.required' => 'Nama obat harus diisi',
            'medicine_category_id.required' => 'Kategori obat harus dipilih',
            'medicine_category_id.exists' => 'Kategori obat tidak valid',
            'unit.required' => 'Unit/satuan harus diisi',
            'price_purchase.required' => 'Harga beli harus diisi',
            'price_purchase.numeric' => 'Harga beli harus berupa angka',
            'price_purchase.min' => 'Harga beli tidak boleh negatif',
            'price_sale.required' => 'Harga jual harus diisi',
            'price_sale.numeric' => 'Harga jual harus berupa angka',
            'price_sale.min' => 'Harga jual tidak boleh negatif',
            'stock.required' => 'Stok harus diisi',
            'stock.integer' => 'Stok harus berupa angka bulat',
            'stock.min' => 'Stok tidak boleh negatif',
            'min_stock.required' => 'Stok minimum harus diisi',
            'min_stock.integer' => 'Stok minimum harus berupa angka bulat',
            'min_stock.min' => 'Stok minimum tidak boleh negatif',
        ];
    }
}
