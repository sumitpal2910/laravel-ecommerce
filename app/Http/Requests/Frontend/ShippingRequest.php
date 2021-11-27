<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "state_id" => 'required',
            "district_id" => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric|min:10',
            'alt_phone' => 'nullable|numeric|min:10',
            'address' => 'required',
            'city' => 'required',
            'landmark' => 'nullable',
            'pincode' => 'required|digits:6',
            'notes' => 'nullable',
            'payment_method' => 'required',
        ];
    }

    public function messages()
    {
        return [
            "state_id.required" => 'Select State',
            "district_id.required" => 'Select District',
            'payment_method.required' => 'Select a payment method',
        ];
    }
}
