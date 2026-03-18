<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer', 'min:1', 'max:6'],
            'email' => ['required', 'email', 'max:255', 'unique:students,email'],
            'dni' => ['required', 'string', 'max:20', 'unique:students,dni'],
        ];
    }
}
