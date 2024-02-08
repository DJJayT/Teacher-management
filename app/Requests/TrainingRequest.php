<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'area_id' => ['required', 'exists:areas,id'],
            'provider_id' => ['required', 'exists:providers,id'],
        ];
    }
}
