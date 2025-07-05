<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTopListRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'list' => 'nullable|array',
            'list.*.brand_id' => 'exists:brands,brand_id',
            'list.*.country_id' => 'exists:countries,id',
            'list.*.position' => 'integer',
        ];
    }
}
