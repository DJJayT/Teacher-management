<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'area' => ['required', 'exists:areas,id'],
            'provider' => ['required', 'exists:providers,id'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'title' => $this->title === "" ? null : $this->title,
            'area_id' => (int) $this->area_id === 0 ? null : (int)$this->area_id,
            'provider_id' => (int) $this->provider_id === 0 ? null : (int)$this->provider_id,
        ]);
    }

}
