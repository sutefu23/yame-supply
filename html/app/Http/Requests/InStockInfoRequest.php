<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class InStockInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'produce_user_id'   =>  ['required', 'numeric',
                Rule::exists('User.id')->where(function($query){
                    return $query->where('user_category_id', 1);//製材所のみ
                })],
            'import_date'   =>  ['required', 'date'],
            'reason'   =>  ['string', 'max:255'],
            'InStockDetails' => ['required', 'array'],
            'InStockDetails.*.item_id' => ['required', 'numeric','exists:Item,id'],
            'InStockDetails.*.item_quantity' => ['required', 'numeric', 'min:0'],
        ];
    }
}
