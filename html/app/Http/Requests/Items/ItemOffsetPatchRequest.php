<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Support\Facades\Auth;

    class ItemOffsetPatchRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize()
        {
            return Auth::check() && $this->method() === 'PATCH';
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, mixed>
         */
        public function rules()
        {
            return [
                'items.*.item_id' => ['required', 'numeric','exists:Item,id'],
                'items.*.offset_quantity' => ['required', 'numeric'],
            ];
        }
    }
