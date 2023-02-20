<?php

namespace App\Http\Requests;

use App\Models\Item;
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
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->where('user_category_id', 2);//工務店のみ
                })],
            'export_date'   =>  ['required', 'date'],
            'warehouse_id'   =>  ['required', 'numeric', 'exists:Warehouse,id'],
            'reason'   =>  ['string', 'nullable','max:255'],
            'building_info_id'  => ['exists_or_null:BuildingInfo,id'],
            'out_stock_details' => ['required', 'array'],
            'out_stock_details.*.item_id' => ['required', 'numeric','exists:Item,id'],
            'out_stock_details.*.item_quantity' => ['required', 'numeric', 'min:0',
                function ($attribute, $value, $fail) {
                    [, $index, ] = explode(".", $attribute); // 例：out_stock_details.0.item_quantity
                    $item_id = $this->input('out_stock_details.'. $index .'.item_id');
                    $target = Item::find($item_id);
                    if ($target->quantity - $value < 0) {
                        return $fail("在庫を0以下にする処理はできません。\n" . $target->length . "×". $target->width . "×" . $target->thickness . "\n現在庫数:" . $target->quantity);
                    }
                },
            ],
        ];
    }
}
