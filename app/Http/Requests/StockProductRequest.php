<?php

namespace App\Http\Requests;

use App\Http\Enumerations\CategoryType;
use App\Rules\ProductQuantity;
use Illuminate\Foundation\Http\FormRequest;

class StockProductRequest extends FormRequest
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
            "product_id"  => "required|numeric|exists:products,id",
            "sku" => "nullable|max:10|min:3",
            "manage_stock" => "required|in:0,1",
            "in_stock" => "required|in:0,1",
//            "quantity" => "required_if:manage_stock,==,1",
            "quantity" => [new ProductQuantity($this->manage_stock)],
            // value ==>   nameInput ex => quantity
        ];
    }
}
