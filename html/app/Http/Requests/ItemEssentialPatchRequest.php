<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Support\Facades\Auth;

    class ItemEssentialPatchRequest extends FormRequest
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
                'items.*.id' => ['required', 'numeric','exists:Item,id'],
                'items.*.essential_quantity' => ['required', 'numeric', 'min:0'],
            ];
        }
    }
