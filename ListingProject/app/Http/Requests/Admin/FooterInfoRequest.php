<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class FooterInfoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'short_description' => ['required', 'max:255'],
            'address' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
            'email' => ['required','email', 'max:255'],
            'copyright' => ['required', 'max:255']
        ];
    }
}
