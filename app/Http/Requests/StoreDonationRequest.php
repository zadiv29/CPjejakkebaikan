<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    protected function prepareForValidation()
    {
        if ($this->has('amount')) {
            $this->merge([
                'amount' => (int) str_replace('.', '', $this->amount),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [
            //
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string'],
            'payment_channel' => ['required', 'string'],
            'email' => ['required', 'string'],
            'notes' => ['required', 'string', 'max:65535'],
            'amount' => ['integer'],
            'verify_token' => ['string']
        ];
    }
}
