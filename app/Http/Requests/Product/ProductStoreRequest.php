<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('web')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'article' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'machines' => 'nullable|string|max:550',
            'desc' => 'nullable|json',
            'price' => 'required',
            'images[]' => 'nullable|array|image'
        ];
    }
}
