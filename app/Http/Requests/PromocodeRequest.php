<?php

namespace App\Http\Requests;

use App\Rules\Price;
use Illuminate\Foundation\Http\FormRequest;

class PromocodeRequest extends FormRequest
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
            'code'=> 'required|string|unique:promocodes,code',
            'description' => 'nullable|string',
            'min_price' => ['nullable', new Price],
            // 'min_qty' => 'nullable|integer|min:1',
            'every_item' => 'nullable|integer|min:1',
            'percentage_discount' => 'nullable|integer|min:1',
            // 'fixed_discount' => 'nullable|integer|min:1',
            // 'free_delivery' => 'required|boolean',
            'gift_item_id' => 'nullable|integer|min:1',
            'starts_at' => 'required|date',
            'ends_at' => 'nullable|date',
            'active' => 'required|boolean',
        ];
    }
}
