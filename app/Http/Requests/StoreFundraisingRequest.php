<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFundraisingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['fundraiser']);
    }

    protected function prepareForValidation()
    {
        if ($this->has('target_amount')) {
            $this->merge([
                'target_amount' => (int) str_replace('.', '', $this->target_amount),
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
            'category_id' => ['required', 'integer'],
            'target_amount' => ['required', 'integer'],
            'about' => ['required', 'string', 'max:65535'],
            'thumbnail' => ['required', 'image', 'mimes:png,jpg,jpeg'],
        ];
    }
}
