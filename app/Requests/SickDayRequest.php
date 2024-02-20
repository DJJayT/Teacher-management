<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SickDayRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'from' => ['required', 'date'],
            'until' => ['required', 'date'],
            'teaching_days' => ['nullable', 'numeric'],
            'total_days' => ['nullable', 'integer'],
            'reason_type_id' => ['required', 'integer', 'exists:sick_time_reasons,id'],
            'certificate' => ['boolean'],
            'certificate_from' => ['nullable', 'date'],
            'hospital' => ['boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'certificate' => $this->certificate === "on",
            'hospital' => $this->hospital === "on",
        ]);
    }
}
