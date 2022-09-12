<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OutStockInfoRequest extends FormRequest
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
            'builder_user_id'   =>  ['numeric',
                Rule::exists('User.id')->where(function($query){
                    return $query->where('user_category_id', 2);//工務店のみ
                })],
            'export_date'   =>  ['required', 'date'],
            'reason'   =>  ['string', 'max:255'],
            'OutStockDetails' => ['required', 'array'],
            'OutStockDetails.*.item_id' => ['required', 'numeric','exists:Item,id'],
            'OutStockDetails.*.item_quantity' => ['required', 'numeric', 'min:0'],
        ];
    }
}
