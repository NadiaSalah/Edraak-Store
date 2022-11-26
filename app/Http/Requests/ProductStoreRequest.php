<?php

namespace App\Http\Requests;

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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required','file','max:512'],
            'description' => ['required', 'string', 'max:1000'],
            'quantity' => ['required','integer','min:0'],
            'price' => ['required', 'numeric','min:1'],
            'discount' => ['required', 'integer','min:0','max:100'],
            'main_category' => ['required'],
            'sub_category' => ['required'], 
        ];
    }
}
