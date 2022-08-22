<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends ApiFormRequest
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }

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
            'title' => 'required|string|max:255|unique:posts,title,'. $this->post->id,
            'seo_keywords' => 'string|nullable',
            'slug' => 'string|max:255|nullable|unique:posts,slug,'. $this->post->id,
            'small_description' => 'string|nullable',
            'description' => 'string|nullable',
            'image' => 'mimes:png,jpg,jpeg,gif|max:2048|nullable',
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
