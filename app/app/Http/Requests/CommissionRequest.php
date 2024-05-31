<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Database\Query\Builder;

class CommissionRequest extends FormRequest
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
            'product_id' => 'required|numeric|exists:products,id',
            'min'        => ['required', 'numeric', Rule::unique('commissions')->ignore($this->commission)->where(fn (Builder $query) => $query->where('product_id', $this->product_id)), 'lt:max'],
            'max'        => ['required', 'numeric', Rule::unique('commissions')->ignore($this->commission)->where(fn (Builder $query) => $query->where('product_id', $this->product_id)), 'gt:min'],
            'percent'    => 'required|numeric'
        ];
    }
}
