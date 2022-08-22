<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\ApiFormRequest;

class StoreRequest extends ApiFormRequest
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
            'title' => 'required|string|max:255|unique:posts,title',
            'seo_keywords' => 'string|nullable',
            'slug' => 'string|unique:posts,slug|nullable',
            'small_description' => 'string|nullable',
            'description' => 'string|nullable'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'The Title field cannot be empty',
            'title.unique' => 'This Post already exists',
            'slug.unique' => 'This Slug already exists',
        ];
    }
}
