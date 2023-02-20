<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class WoodSpeciesRequest extends FormRequest
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
                'id' => ['required', 'numeric', 'unique:WoodSpecies,id'],
                'name' => ['required', 'string', 'unique:WoodSpecies,name'],
            ];
        } else {
            return [
                'name' => ['string'],
            ];
        }
    }
}
