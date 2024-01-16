<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'abbreviation' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
