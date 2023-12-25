<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderSendStoreRequest extends FormRequest
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
        return [
            'type' => 'required',
            'user_id' => 'required|exists:users,id',
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|between:10,11',
            'delivery_district_id' => 'required',
            'address' => 'required|string|max:255',
            'guide' => 'required',
            'note' => 'required|string|max:255',
            'products' => 'required|array',
            'products.*.name' => 'required|string|max:255',
            'products.*.quanlity' => 'required',
            'products.*.price' => 'required',
            'products.*.note' => 'nullable|string|max:255',             
            'products.*.weight' => 'required|numeric',             
            'products.*.sum_price' => 'required',             
        ];
    }
    public function messages()
    {
        return [
            'phone_number.between' => 'Số điện thoại phải có định dạng là :min hoặc :max số'
        ];
    }
}
