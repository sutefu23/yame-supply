<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class WarehouseRequest extends FormRequest
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
                'id' => ['required', 'numeric', 'unique:Warehouse,id'],
                'name' => ['required', 'string', 'unique:Warehouse,name'],
            ];
        } else {
            return [
                'name' => ['string'],
            ];
        }
    }
}
