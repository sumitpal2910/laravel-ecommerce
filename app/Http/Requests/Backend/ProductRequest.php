<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'sub_subcategory_id' => 'required',
            'name_en' => 'required',
            'name_hin' => 'required',
            'qty' => 'required',
            'tags_en' => 'required',
            'tags_hin' => 'required',
            'size_en' => '',
            'size_hin' => '',
            'color_en' => '',
            'color_hin' => '',
            'selling_price' => 'required',
            'discount_price' => '',
            'short_descp_en' => 'required',
            'short_descp_hin' => 'required',
            'long_descp_en' => 'required',
            'long_descp_hin' => 'required',
            'hot_deals' => '',
            'featured' => '',
            'special_offer' => '',
            'special_deals' => '',

        ];
    }
}
