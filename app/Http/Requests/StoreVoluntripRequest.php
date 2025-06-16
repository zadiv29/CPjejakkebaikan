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
        return $this->user()->hasAnyRole(['owner|fundraiser']);
    }

    protected function prepareForValidation()
    {
        if ($this->has('ticket_price')) {
            $this->merge([
                'ticket_price' => (int) str_replace('.', '', $this->ticket_price),
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
            'thumbnail' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'name' => ['required', 'string', 'max:255'],
            // 'start_date' => ['required', 'date'],
            'start_date_day' => 'required|integer|min:1|max:31',
            'start_date_month' => 'required|integer|min:1|max:12',
            // Sesuaikan min tahun dengan rentang yang Anda izinkan di dropdown Blade
            'start_date_year' => 'required|integer|min:1950|max:' . (date('Y') + 10),
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i'],
            'total_ticket' => ['required', 'integer'],
            'about' => ['required', 'string', 'max:65535'],
            'ticket_price' => ['required', 'integer'],
            'event_status' => ['nullable', 'enum'],
        ];
    }
    public function messages(): array
    {
        return [
            'start_date_day.required' => 'Hari tanggal mulai wajib diisi.',
            'start_date_day.integer' => 'Hari tanggal mulai harus berupa angka.',
            'start_date_day.min' => 'Hari tanggal mulai minimal 1.',
            'start_date_day.max' => 'Hari tanggal mulai maksimal 31.',

            'start_date_month.required' => 'Bulan tanggal mulai wajib diisi.',
            'start_date_month.integer' => 'Bulan tanggal mulai harus berupa angka.',
            'start_date_month.min' => 'Bulan tanggal mulai minimal 1.',
            'start_date_month.max' => 'Bulan tanggal mulai maksimal 12.',

            'start_date_year.required' => 'Tahun tanggal mulai wajib diisi.',
            'start_date_year.integer' => 'Tahun tanggal mulai harus berupa angka.',
            'start_date_year.min' => 'Tahun tanggal mulai tidak valid.',
            'start_date_year.max' => 'Tahun tanggal mulai tidak valid.',
        ];
    }
}
