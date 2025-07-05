<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreTopListRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'brand_id' => 'required|exists:brands,id',
            'position' => 'required|integer|min:1',
        ];
    }
}
