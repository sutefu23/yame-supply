<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class UserRequest extends FormRequest
{
    private mixed $email;

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
                'id'    => 'unique:users,id',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'user_category_id' => ['required', 'numeric', 'exists:UserCategory,id'],
            ];
        } else {
            return [
                'id' => ['numeric', 'exists:users,id'],
                'name'  => ['string'],
                'email' => ['string', 'email'],
                'password' => ['string', 'nullable','confirmed', Rules\Password::defaults()],
                'user_category_id' => ['numeric','exists:UserCategory,id'],
            ];
        }
    }
}
