<?php

namespace App\Http\Requests\Backend\Blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
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
            'blog_post_category_id' => 'required',
            'title_en' => 'required',
            'title_hin' => 'required',
            'image' => 'image',
            'content_en' => 'required',
            'content_hin' => 'required',
        ];
    }
}
