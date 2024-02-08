<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherTrainingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'training_id' => ['required', 'integer', 'exists:trainings,id'],
            'training_from' => ['required', 'date'],
            'training_until' => ['required', 'date'],
            'duration' => ['required', 'numeric'],
        ];
    }
}
