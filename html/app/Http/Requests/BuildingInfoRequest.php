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
                Rule::exists('User.id')->where(function($query){
                    return $query->where('user_category_id', 2);//工務店のみ
                })],
            'time_limit'   =>  ['required', 'date'],
        ];
    }
}