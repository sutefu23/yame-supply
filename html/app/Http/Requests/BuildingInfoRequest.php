<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BuildingInfoRequest extends FormRequest
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
            'field_name'   =>  ['string', 'max:255'],
            'builder_user_id'   =>  ['numeric',
                Rule::exists('users','id')->where(function($query){
                    return $query->where('user_category_id', 2);//工務店のみ
                })],
            'export_expected_date'   =>  ['required', 'date','after_or_equal:today'],
            'building_info_details' => ['required', 'array'],
            'building_info_details.*.item_id' => ['required', 'numeric','exists:Item,id'],
            'building_info_details.*.item_quantity' => ['required', 'numeric', 'min:0'],
        ];
    }
}
