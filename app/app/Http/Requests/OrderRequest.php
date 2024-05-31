<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        $sellerId = $this->seller_id;
        $sellerAvailableProducts = Product::whereHas('sellers', function($query) use($sellerId){
            return $query->where('sellers.id', $sellerId);
        })->pluck('id')->toArray();

        return [
            'seller_id' => 'required|exists:sellers,id',
            'mobile'    => ['nullable','regex:/^(\+98|0|0098)?9\d{9}$/i'],
            'email'     => 'nullable|email',
            'products'  => 'required|array',
            'products.*'  => 'required|array',
            'products.*.0'  => 'required|exists:products,id|in:'.implode(',', $sellerAvailableProducts),
        ];
    }

}
