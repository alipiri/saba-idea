<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'mobile' => ['required','regex:/^(\+98|0|0098)?9\d{9}$/i','unique:sellers,mobile,'.$this?->seller],
            'products' => 'nullable|array',
            'products.*' => 'exists:products,id',
        ];
    }

    public function messages(): array
    {
        return [
            'mobile.regex' => 'Mobile number format is wrong'
        ];
    }
}
