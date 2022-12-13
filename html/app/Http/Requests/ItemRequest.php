<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ItemRequest extends FormRequest
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
                'length' => ['required', 'numeric'],
                'width' => ['required', 'numeric'],
                'thickness' => ['required', 'numeric'],
                'raw_wood_size' => ['required', 'string', 'max:100'],
                'warehouse_id' => ['required', 'numeric', 'exists:Warehouse,id'],
                'memo' => ['string', 'max:255'],
                'quantity' => ['required', 'numeric', 'min:0'],
                'essential_quantity' => ['required', 'numeric', 'min:0'],
                'unit_id' => ['required', 'numeric', 'exists:Unit,id'],
                'wood_species_id' => ['required', 'numeric', 'exists:WoodSpecies,id'],
            ];
        }else {
            return [
                'items.*.id' => ['required','numeric', 'exists:Item,id'],
                'items.*.essential_quantity' => ['required','numeric', 'min:0'],
            ];
        }
    }

}
