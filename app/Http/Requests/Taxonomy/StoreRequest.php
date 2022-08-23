<?php

namespace App\Http\Requests\Taxonomy;
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
            'user_id' => 'required|integer|exists:users,id',
            'taxonomy_type' => 'required|string',
            'data' => '',
            'data.*' => '',
        ];
    }

}
