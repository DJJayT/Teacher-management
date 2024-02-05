<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'abbreviation' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'role' => ['required', 'string'],
            'password' => [
                'nullable',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
            ],
        ];
    }
}
