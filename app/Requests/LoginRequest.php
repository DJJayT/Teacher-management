<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }
}
