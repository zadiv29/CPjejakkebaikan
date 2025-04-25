<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVoluntripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['fundraiser']);
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
            'thumbnail' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'name' => ['required', 'string', 'max:255'],
            'target_amount' => ['required', 'integer'],
            'about' => ['required', 'string', 'max:65535'],
            'start_date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i'],
            'ticket_price' => ['required', 'integer'],
        ];
    }
}
