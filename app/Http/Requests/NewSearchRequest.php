<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewSearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'search_value' => 'string|nullable|max:250'
        ];
    }
}
