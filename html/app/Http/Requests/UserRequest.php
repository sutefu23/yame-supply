<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
        if ($this->method() == 'POST') {
            return [
                'id' => ['required', 'unique:users,id','string'],
                'email' => ['required', 'string', 'email:rfc,dns'],
                'password' => ['required', 'string', 'min:8'],
                'user_category_id' => ['required', 'numeric','exists:UserCategory,id'],
            ];
        }else{
            return [
                'id' => ['unique:users,id','string'],
                'email' => ['string', 'email:rfc,dns'],
                'password' => ['string', 'min:8'],
                'user_category_id' => ['numeric','exists:UserCategory,id'],
            ];

        }
    }
}
