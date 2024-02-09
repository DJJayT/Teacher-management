<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherTrainingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'training_id' => ['required', 'integer', 'exists:trainings,id'],
            'from' => ['required', 'date'],
            'until' => ['required', 'date'],
            'duration' => ['nullable', 'numeric'],
        ];
    }
}
