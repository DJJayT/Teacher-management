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
            'teaching_days' => ['nullable', 'integer'],
            'total_days' => ['nullable', 'integer'],
            'reason_type_id' => ['required', 'integer', 'exists:sick_time_reasons,id'],
            'certificate' => ['boolean'],
            'certificate_from' => ['nullable', 'date'],
            'hospital' => ['boolean'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'certificate' => $this->certificate === "on" ? true : false,
            'hospital' => $this->hospital === "on" ? true : false,
        ]);
    }
}
