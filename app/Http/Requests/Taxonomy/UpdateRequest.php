<?php

namespace App\Http\Requests\Taxonomy;

use App\Http\Requests\ApiFormRequest;

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
            'user_id' => 'nullable|integer|exists:users,id',
            'taxonomy_type' => 'nullable|string',
            'data' => '',
            'data.*' => '',
        ];
    }

}
